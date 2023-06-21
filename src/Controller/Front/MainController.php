<?php

namespace App\Controller\Front;

use App\Data\FilterData;
use App\Form\Front\FilterDataType;
use App\Repository\CityRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;


class MainController extends AbstractController
{
    /**
     * Homepage
     * 
     * @Route("/", name="default", methods={"GET", "POST"})
     * 
     * @return Response
     */
    public function home(
        CityRepository $cityRepository, 
        Request $request, 
        PaginatorInterface $paginator,
        EntityManagerInterface $entityManager): Response
    {
        $image = $cityRepository->findByCityName('cityId');
        $cities = $cityRepository->findCountryAndImageByCity('ASC');

        // sidebar filter form
        $criteria = new FilterData();
        $formFilter = $this->createForm(FilterDataType::class, $criteria);
        $formFilter->handleRequest($request);
        

        if ($formFilter->isSubmitted() && $formFilter->isValid()) {

            $citiesFilter = $cityRepository->findByFilter($criteria);
            $citiesFilter = $paginator->paginate($citiesFilter, $request->query->getInt('page', 1),6);

            return $this->render('front/cities/list.html.twig', ["citiesFilter" => $citiesFilter, "cities" => $cities, 'formFilter' => $formFilter->createView(),]);
        }

        return $this->render('front/main/index.html.twig', [
            'formFilter' => $formFilter->createView(),
            'image' => $image,
            'cities' => $cities,
        ]);
    }

    /**
     * page search affiche le résultat de la recherche
     *
     * @Route("/search", name="app_front_city_search")
     *
     * @return Response
     */
   /* public function search(CityRepository $cityRepository, 
        Request $request, ImageRepository $imageRepository,
        PaginatorInterface $paginator, EntityManagerInterface $entityManager): Response
    {
        // $images = $imageRepository->findByDistinctCityImage();
       

        //$images = $paginator->paginate($images, $request->query->getInt('page', 1),5);

        //$cities = $cityRepository->findAll();
        
        $search = $request->query->get('search', "");
        
        $cities = $cityRepository->findByCityName($search);
        dump($cities);
        if ($cities === null) {
            throw $this->createNotFoundException("Cette ville n'est pas répertoriée/n'existe pas");
        } else {
            $this->redirectToroute('cities_list');
        }
         
         dump($search);

         $cities = $paginator->paginate($cities, $request->query->getInt('page', 1),6);
       

        return $this->render("front/cities/list.html.twig",
            [
                'images' => $cities,
                //'images' => $images

            ]
        );
    }*/

     /**
     * page search affiche le résultat de la recherche
     *
     * @Route("/search", name="app_front_city_search", methods={"GET"})
     *
     * @return Response
     */
    public function search(Request $request, CityRepository $cityRepository, PaginatorInterface $paginator): Response
    {
        //$images = $imageRepository->findByDistinctCityImage();

        $images = $cityRepository->findCountryAndImageByCity();
        
        $images = $paginator->paginate($images, $request->query->getInt('page', 1),6);

        $search = $request->query->get('search');

        if ($search) {
            $cities = $cityRepository->findByCityName($search);
        } else {
            $cities = []; 
        }

        dump($cities);

        return $this->render('front/cities/list.html.twig', [

            'cities' => $cities,
        
        ]);
    }

    /**
     * About-us page
     * 
     * @Route("/about-us", name="aboutUs", methods={"GET"})
     * 
     * @return Reponse
     */

    public function aboutUs()
    {
        return $this->render('front/footer/about_us.html.twig', [
            
        ]);
    }

}

