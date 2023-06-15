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
     * 
     * 
     * @Route("/cities/filter", name="cities_filter", methods={"GET", "POST"})
     * 
     * @return Response
     */
    public function filterCities(CityRepository $cityRepository, ImageRepository $imageRepository, Request $request): Response
    {
        $images = $imageRepository->findByDistinctCityImage();
        $data = new FilterData();
        $form = $this->createForm(FilterDataType::class, $data);
        // dd($form);
        $form->handleRequest($request);
        $citiesFilter = $cityRepository->findByFilter($data);
        // if ($data === null) {
        //     throw $this->createNotFoundException("Nous n'avons pas trouvé de ville correspondant à votre recherche");
        // }
        // dd($citiesFilter);

        return $this->renderForm('front/filter_menu.html.twig', [
            'form' => $form,
            'citiesFilter' => $citiesFilter,
            'images' => $images
        ]);
    }
}
