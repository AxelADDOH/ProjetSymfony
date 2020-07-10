<?php
namespace App\Controller;

use App\Entity\Auteur;
use App\Entity\Livre;
use App\Repository\AuteurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AuteurController extends  AbstractController{

    /**
     * @var AuteurRepository
     * @var ObjectManager
     */
    private $auteurRepository;
    private $em;

    public function __construct(AuteurRepository $auteurRepository , ObjectManager $em)
    {
            $this->auteurRepository = $auteurRepository;
            $this->em = $em;
    }
    /**
     * @Route("/Auteur",name="auteur.index")
     * @return Response
     */
    public function index():Response{
        return $this->render('auteur.html.twig',[]);
    }
    /**
     * @Route("/Auteur/{slug}-{id}",name="auteur.show",requirements={"slug":"[a-zA-Z0-9\-]*"})
     * @return Response
     */
    public function show(Auteur $auteur,$slug,$id):Response{
        if($auteur->getSlug() !== $slug){
            return $this->redirectToRoute('auteur.show',[
                "id" => $auteur->getId() ,
                "slug" =>$auteur->getSlug()
            ],301);
        }
        $auteur =  $this->auteurRepository->BookByEditeur($id);
        dump($auteur);
        return $this->render('auteur.html.twig',[
            "author"=> $auteur
        ]);

    }

}