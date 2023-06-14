<?php

namespace App\Controller\Front;

use App\Form\Front\SearchCityType;
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
    public function home(CityRepository $cityRepository,ImageRepository $imageRepository, Request $request): Response
    {

    $images = $imageRepository->findByDistinctCityImage();

    // $dataCity = $request->query->get('city', '');
    // dd($dataCity);

    $city = $cityRepository->findByCityLimit50();

    $form = $this->createForm(SearchCityType::class, $city);

    $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $city = $form->getData();

            dump($city);
        }

        return $this->renderForm('front/main/index.html.twig', [
            'images' => $images,
            'form' => $form
         ]);
    }

}  
