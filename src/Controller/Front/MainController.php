<?php

namespace App\Controller\Front;

use App\Data\SearchData;
use App\Form\Front\SearchDataType;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function home(CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $cities = $cityRepository->findAll();

        $images = $imageRepository->findByDistinctCityImage();

        $data = new SearchData();
        $form = $this->createForm(SearchDataType::class, $data);
        $form->handleRequest($request);

        return $this->renderForm('front/main/index.html.twig', [
            'cities' => $cities,
            'images' => $images,
            'form' => $form
        ]);
    }
}
