<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use App\Service\SortService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * Cities List
     *
     * @Route("/cities", name="cities_list")
     */
    public function list(
        CityRepository $cityRepository, 
        ImageRepository $imageRepository,
        SortService $sortService)
    {
        // $cities = $cityRepository->findAll();

        $images = $imageRepository->findByDistinctCityImage();

        // $isSorted = false;
        $sortedCitiesAsc = [];
        $sortedCitiesDesc = [];
        
        // if (isset($_GET['sort']) && $_GET['sort'] === 'asc') {
        //     $isSorted = true;
        //     $sortedCitiesAsc = $sortService->sortCitiesByName('asc');
        // } elseif (isset($_GET['sort']) && $_GET['sort'] === 'desc') {
        //     $isSorted = true;
        //     $sortedCitiesDesc = $sortService->sortCitiesByName('desc');
        // }

        return $this->render('front/cities/list.html.twig', [
            // 'isSorted' => $isSorted,
            // 'cities' => $cities,
            "images" => $images,
            'sortedCitiesAsc' => $sortedCitiesAsc,
            'sortedCitiesDesc' => $sortedCitiesDesc,
        ]);
    }

    /**
     * City Page
     * 
     * @Route("/cities/{id}", name="cities_detail", requirements={"id":"\d+"})
     */
    public function show($id, CityRepository $cityRepository, ImageRepository $imageRepository): Response
    {
        $city = $cityRepository->find($id);
        if ($city === null) {
            throw new Exception("Nous n'avons pas encore de données sur cette ville", 404);
        }

        $images = $imageRepository->findByDistinctCityImage();

        return $this->render('front/cities/show.html.twig', [
            'cityId' => $id,
            'city' => $city,
            'images' => $images
        ]);
    }
}
