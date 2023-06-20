<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\Front\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        PaginatorInterface $paginatorInterface, 
        Request $request)
    {
        $cities = $cityRepository->findCountryAndImageByCity();

        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {
            
            $citiesFilter = $cityRepository->findByFilter($criteria);
            $citiesFilter = $paginatorInterface->paginate($citiesFilter, $request->query->getInt('page', 1),6);

            return $this->render('front/cities/list.html.twig', ["citiesFilter" => $citiesFilter, "cities" => $cities, 'formFilter' => $formFilter->createView(),]);
        }

        $cities = $paginatorInterface->paginate($cities, $request->query->getInt('page', 1),6);

        return $this->render('front/cities/list.html.twig', [
            'cities' => $cities,
            'formFilter' => $formFilter->createView(),
        ]);
    }



    /**
     * City Page
     * 
     * @Route("/cities/{id}", name="cities_detail", requirements={"id":"\d+"})
     */
    public function show(
        $id, 
        CityRepository $cityRepository, 
        ImageRepository $imageRepository
        ): Response
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
