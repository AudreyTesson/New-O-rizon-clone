<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * Homepage
     * 
     * @Route("/", name="default", methods={"GET"})
     * 
     * @return Response
     */
    public function home(CityRepository $cityRepository): Response
    {
        $cities = $cityRepository->findAll();

        return $this->render('front/main/index.html.twig', [
            'cities' => $cities,
        ]);
    }
}
