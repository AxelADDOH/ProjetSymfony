<?php
namespace App\Controller;

use App\Repository\ClientRepository;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController{

    /**
     * @Route("",name="")
     * ClientController constructor.
     * @param ObjectManager $em
     * @param ClientRepository $repo
     */
    /*public function __construct(ObjectManager $em,ClientRepository $repo)
    {
        $this->em = $em;
        $this->repo = $repo;
    }*/


}
