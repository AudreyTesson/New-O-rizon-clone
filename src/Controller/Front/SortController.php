<?php

namespace App\Controller\Front;

use App\Service\SortService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;

class SortController extends AbstractController
{
    /**
     * @Route("/cities/asc", name="sort_asc")
     */
    public function sortAscAction(SortService $sortService, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $images = $sortService->sortCitiesByName('asc');

        $images = $paginatorInterface->paginate($images, $request->query->getInt('page', 1),9);

        return $this->render('front/cities/list.html.twig', [
            'images' => $images,
            'isSorted' => true,
            'sortOption' => 'asc',
        ]);
    }

    /**
     * @Route("/cities/desc", name="sort_desc")
     */
    public function sortDescAction(SortService $sortService, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $images = $sortService->sortCitiesByName('desc');

        $images = $paginatorInterface->paginate($images, $request->query->getInt('page', 1), 9);
    
        return $this->render('front/cities/list.html.twig', [
            'images' => $images,
            'isSorted' => true,
            'sortOption' => 'desc',
        ]);
    }
}