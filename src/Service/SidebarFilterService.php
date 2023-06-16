<?php

namespace App\Service;

use App\Data\FilterData;
use App\Form\Front\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SidebarFilterService 
{

    public function filterCitiesHomepage(CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $images = $imageRepository->findByDistinctCityImage();
        $data = new FilterData();
        $form = $this->createForm(FilterDataType::class, $data);
        
        $form->handleRequest($request);
        $citiesFilter = $cityRepository->findByFilter($data);
        if ($citiesFilter === null) {
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