<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class MainController extends AbstractController
{
    /**
     * Default page
     * 
     * @Route("/", name="default", methods={"GET, "POST})
     * 
     * @return Response
     */

     public function home ()
     {

     }


    /**
     * Legal notices page
     * 
     * @Route("/legal-notices", name="app_front_legal_notices", methods={"GET"})  
     * 
     * @return Response
     */ 
    public function legalNotices ()
    {

    }

    /**
     * About us page : List of creators of this website
     * 
     * @Route("/about-us", name="app_front_about_us", methods={"GET"})  
     * 
     * @return Response 
     */
    public function aboutUs()
    {

    }

    /**
     * Contact page 
     * 
     * @Route("/contact", name="app_front_contact", methods={"GET", "POST"})  
     * 
     * @return Response
     */
    public function contact()
    {

    }

}

