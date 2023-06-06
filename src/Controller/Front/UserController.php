<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{

    /**
     * Login page 
     * 
     * @Route("/login", name="app_front_login", methods={"GET, "POST})
     * 
     * @return Response
     */
    public function login()
    {

    }

    /**
     * Sign in page 
     * 
     * @Route("/sign-in", name="app_front_sign_in", methods={"GET, "POST})
     * 
     * @return Response
     */
    public function new()
    {
        
    }
}