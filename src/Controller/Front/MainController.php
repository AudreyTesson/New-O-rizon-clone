<?php

namespace App\Controller\Front;

use App\Form\CityType;
use App\Entity\City;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * Homepage
     * 
     * @Route("/", name="default", methods={"GET"})
     * 
     * @return Response
     */
    public function home(CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $cities = $cityRepository->findAll();

        $images = $imageRepository->findByDistinctCityImage();
        
        
        $form = $this->createForm(CityType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            
        }

    
        return $this->render('front/main/index.html.twig', [
            'cities' => $cities,
            'images' => $images,
            
         ]);
    }
    
    
}