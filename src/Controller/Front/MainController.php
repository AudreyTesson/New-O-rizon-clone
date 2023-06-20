<?php

namespace App\Controller\Front;


use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class MainController extends AbstractController
{
    /**
     * Homepage
     * 
     * @Route("/", name="default", methods={"GET", "POST"})
     * 
     * @return Response
     */
    public function home(CityRepository $cityRepository,ImageRepository $imageRepository, Request $request, PaginatorInterface $paginator): Response
    {

    //$images = $imageRepository->findByDistinctCityImage();

    //$images = $cityRepository->findCountryAndImageByCity();

    //dump($images);
    
    /*$cities = $cityRepository->findAll();
        
    $search = $request->query->get('search', "");
    
    $cities = $cityRepository->findByCityName($search);
    dump($cities);
    if ($cities === null) {
        throw $this->createNotFoundException("Cette ville n'est pas répertoriée/n'existe pas");
    } else {
        $this->redirectToroute('cities_list');
    }

    $cities = $paginator->paginate($cities, $request->query->getInt('page', 1),5);*/
   
        return $this->renderForm('front/main/index.html.twig', [
            'images' => $images,
            //'cities' => $cities
            
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
     * @Route("/search", name="app_front_city_search")
     *
     * @return Response
     */
    public function search(Request $request, CityRepository $cityRepository, ImageRepository $imageRepository, PaginatorInterface $paginator): Response
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
            'images' => $images
        ]);
    }

}  