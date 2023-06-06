<?php 

namespace App\Controller\Front;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CityController extends AbstractController
{
    /**
     * Affichage de la liste des villes
     * 
     * @Route("/cities", name="app_front_city_list", methods={"GET"})
     * 
     * @return Response
     */
    public function list()
    {

    }

    /**
     * Affichage de la page d'une ville
     * 
     * @Route("/cities/{id}", name="app_front_city_show", methods={"GET"})
     * 
     * @return Response
     */
    public function show()
    {

    }
}