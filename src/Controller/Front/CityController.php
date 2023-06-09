<?php

namespace App\Controller\Front;

use App\Repository\CityRepository;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CityController extends AbstractController
{
    /**
     * City Page
     * 
     * @Route("/cities/{id}", name="cities_detail", requirements={"id":"\d+"})
     */
    public function show($id, CityRepository $cityRepository): Response
    {
        $city = $cityRepository->find($id);
        if ($city === null) {
            throw new Exception("Cette ville n'existe pas", 404);
        }


        $cities = $cityRepository->findAll();


        return $this->render('front/cities/show.html.twig', [
            'cityId' => $id,
            'city' => $city,
            'cities' => $cities,
        ]);
    }
}
