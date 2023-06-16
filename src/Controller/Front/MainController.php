<?php

namespace App\Controller\Front;


use App\Repository\CityRepository;
use App\Repository\ImageRepository;
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
    public function home(CityRepository $cityRepository,ImageRepository $imageRepository): Response
    {

    $images = $imageRepository->findByDistinctCityImage();

   

    
        return $this->renderForm('front/main/index.html.twig', [
            'images' => $images,
            
        ]);
    }

        /**
     * page search affiche le résultat de la recherche
     *
     * @Route("/search", name="app_front_city_search")
     *
     * @return Response
     */
    public function search(CityRepository $cityRepository, 
        Request $request, 
        PaginatorInterface $paginator): Response
    {
        $cities = $cityRepository->findAll();
        
        $search = $request->query->get('search', "");
        
        $cities = $cityRepository->findByCityName($search);

        if ($cities === null) {
            throw $this->createNotFoundException("Cette ville n'est pas répertoriée/n'existe pas");
        } else {
            $this->redirectToroute('cities_list');
        }
        
        $cities = $paginator->paginate($cities, $request->query->getInt('page', 1),5);
        dump($search);
        dump($cities);


        return $this->render("front/cities/list.html.twig",
            [
                'cities' => $cities,

            ]
        );
    }

}  