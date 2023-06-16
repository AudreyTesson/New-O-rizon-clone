<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\Front\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FilterController extends AbstractController
{
    /**
     * Filter menu to select criteria from Homepage and render list of cities
     * 
     * @Route("/", name="cities_filter_homepage", methods={"GET", "POST"})
     * 
     * @return Response
     */
    public function filterCitiesHomepage(CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $images = $imageRepository->findByDistinctCityImage();
        $data = new FilterData();
        $form = $this->createForm(FilterDataType::class, $data);
        
        $form->handleRequest($request);
        $citiesFilter = $cityRepository->findByFilter($data);
        if ($data === null) {
            throw $this->createNotFoundException("Nous n'avons pas trouvé de ville correspondant à votre recherche");
        }

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('cities_list', ["cities" => $citiesFilter, "images" => $images], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/main/index.html.twig', [
            'form' => $form,
            'citiesFilter' => $citiesFilter,
            'images' => $images
        ]);
    }

    /**
     * Filter menu to select criteria from Cities List and render actualised list of cities
     * 
     * @Route("/cities", name="cities_filter_list", methods={"GET", "POST"})
     * 
     * @return Response
     */
    public function filterCitiesList(CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $images = $imageRepository->findByDistinctCityImage();
        $data = new FilterData();
        $form = $this->createForm(FilterDataType::class, $data);
        
        $form->handleRequest($request);
        $citiesFilter = $cityRepository->findByFilter($data);
        if ($data === null) {
            throw $this->createNotFoundException("Nous n'avons pas trouvé de ville correspondant à votre recherche");
        }

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('cities_list', ["cities" => $citiesFilter, "images" => $images], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/main/index.html.twig', [
            'form' => $form,
            'citiesFilter' => $citiesFilter,
            'images' => $images
        ]);
    }
}
