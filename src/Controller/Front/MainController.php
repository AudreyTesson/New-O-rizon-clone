<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use App\Repository\ImageRepository;
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
    public function home(CityRepository $cityRepository, ImageRepository $imageRepository): Response
    {
        $cities = $cityRepository->findAll();

        $images = $imageRepository->findByDistinctCityImage();

        return $this->render('front/main/index.html.twig', [
            'cities' => $cities,
            'images' => $images
        ]);
    }

    /**
     * About-us page
     * 
     * @Route("/about-us", name="aboutUs", methods={"GET"})
     * 
     * @return Reponse
     */

    public function aboutUs()
    {
        return $this->render('front/footer/about_us.html.twig', [
            
        ]);
    }

}

