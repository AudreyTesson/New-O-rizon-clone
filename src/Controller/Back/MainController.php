<?php

namespace App\Controller\Back;

use phpDocumentor\Reflection\Types\AbstractList;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{   
     /**
     * Affichage de la page admin
     * 
     * @Route("/back/admin", name="app_back_home", methods={"GET"})
     * 
     * @return Response
     */
    public function home()
    {

    }
}