<?php
namespace App\Controller;


use App\Repository\AuteurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{


    /**
     * @Route("/",name="home")
     * @param AuteurRepository $auteurRepository
     * @return Response
     */

    public function index(AuteurRepository $auteurRepository):Response{

        $auteur = $auteurRepository->findAll();
        return $this->render('home.html.twig',[
            'auteurs' => $auteur
        ]);
    }


}
