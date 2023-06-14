<?php

namespace App\Controller;

use App\Service\SortService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortController extends AbstractController
{
    private $sortService;
    
    /**
     * @Route("/cities/asc", name="sort_asc")
     */
    public function sortAscAction(SortService $sortService): Response
    {
        $cities = $sortService->sortCitiesByName('asc');
        
        return $this->render('front/cities/list.html.twig', [
            'cities' => $cities,
        ]);
    }
    
    /**
     * @Route("/cities/desc", name="sort_desc")
     */
    public function sortDescAction(SortService $sortService): Response
    {
        $cities = $sortService->sortCitiesByName('desc');
        
        return $this->render('front/cities/list.html.twig', [
            'cities' => $cities,
        ]);
    }
}