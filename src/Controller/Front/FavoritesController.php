<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/favorites", name"app_front_favorites_")
 */

class FavoritesController extends AbstractController
{

    /**
     * Favorites page to show all cities on favorites
     * 
     * @Route("/favorites", name="list", methods={"GET, "POST})
     * 
     * @return Response
     */
    public function list()
    {

    }

    /**
     * Add a city on favorites
     * 
     * @Route("/add/{id}", name="add", requirements={"id"="\d+"}, methods={"GET, "POST})
     * 
     * @return Response
     */
    public function add()
    {

    }

    /**
     * Delete a city of the favorites
     * 
     * @Route("/delete/{id}", name="delete", requirements={"id"="\d+"}, methods={"GET, "POST})
     * 
     * @return Response
     */
    public function delete()
    {

    }
    
}