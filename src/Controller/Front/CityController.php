<?php

namespace App\Controller\Front;

use App\Entity\City;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Exception;
use App\Form\CityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class CityController extends AbstractController
{
    /**
     * Cities List
     *
     * @Route("/cities", name="cities_list")
     */
    public function list(CityRepository $cityRepository, ImageRepository $imageRepository)
    {
        $cities = $cityRepository->findAll();

        $images = $imageRepository->findByDistinctCityImage();

        return $this->render('front/cities/list.html.twig', [
            'cities' => $cities,
            "images" => $images,
        ]);
    }

    /**
     * City Page
     * 
     * @Route("/cities/{id}", name="cities_detail", requirements={"id":"\d+"})
     */
    public function show($id, CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $city = $cityRepository->find($id);
        if ($city === null) {
            throw new Exception("Cette ville n'existe pas", 404);
        }

        $images = $imageRepository->findByDistinctCityImage();

        $form = $this->createForm(CityType::class, $city);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            dump($city);
        }


        return $this->render('front/cities/show.html.twig', [
            'cityId' => $id,
            'city' => $city,
            'images' => $images
        ]);
    }

    
}


