<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\Front\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\CountryRepository;
use App\Repository\ImageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CountryController extends AbstractController
{

    /**
     * Cities list by country
     * 
     * @Route("/cities/country/{id}", name="cities_country", requirements={"id"="\d+"})
     * 
     * @return Response
     */
    public function countryShow($id, CountryRepository $countryRepository, CityRepository $cityRepository, ImageRepository $imageRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $countryId = $countryRepository->find($id);
        $citiesCountry = $cityRepository->findByCountry($countryId);
        dump($citiesCountry);
        $cities = $cityRepository->findCountryAndImageByCity();

        if ($citiesCountry === null) {
            throw $this->createNotFoundException("Ce pays n'a pas de villes enregistrées pour le moment");
        }
        if ($countryId === null) {
            throw $this->createNotFoundException("Ce pays n'est pas répertorié");
        }

        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {
            
            $citiesFilter = $cityRepository->findByFilter($criteria);
            $citiesFilter = $paginator->paginate($citiesFilter, $request->query->getInt('page', 1),6);

            return $this->redirectToRoute('cities_list', ["citiesFilter" => $citiesFilter, "cities" => $cities]);
        }

        $citiesCountry = $paginator->paginate($citiesCountry, $request->query->getInt('page', 1),6);

        return $this->render("front/cities/list.html.twig",
            [
               'citiesCountry' => $citiesCountry,
               'cities' => $cities,
               'formFilter' => $formFilter->createView(),
            ]
        );
    }
}