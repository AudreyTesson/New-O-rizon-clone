<?php 

namespace App\Controller\Back;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CityController extends AbstractController
{
    /**
     * Show the list of the cities
     * 
     * @Route("/back/cities", name="app_back_city_list", methods={"GET"})
     * 
     * @return Response
     */
    public function list()
    {

    }

    /**
     * Add a city
     * 
     * @Route("/back/city", name="app_back_city_add", methods={"POST"})
     * 
     * @return Response
     */
    public function add()
    {

    }

    /**
     * Edition of a city's page
     * 
     * @Route("/city/{id}", name="app_back_city_edit", requirements={"id"="\d+"}, methods={"POST"})
     * 
     * @return Response
     */
    public function edit()
    {

    }

    /**
     * Delete a city
     * 
     * @Route("/city/{id}", name="app_back_city_delete", requirements={"id"="\d+"}, methods={"POST"})
     * 
     * @return Response
     */
    public function delete()
    {

    }
}