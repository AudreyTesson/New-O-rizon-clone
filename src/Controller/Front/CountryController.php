<?php 

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CountryController extends AbstractController
{   
    /**
     * Show the list of countries
     * 
     * @Route("/countries", name="app_front_country_list", methods={"GET"})
     * 
     * @return Response
     */
    public function list()
    {

    }

    /**
     * Show the page of a city
     * 
     * @Route("/countries/{id}", name="app_front_country_show", requirements={"id"="\d+"}, methods={"GET"})
     * 
     * @return Response
     */
    public function show()
    {

    }
}