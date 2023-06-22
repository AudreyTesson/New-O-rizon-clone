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
        PaginatorInterface $paginator): Response
    {
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

    /**
     * Legal Notices page
     * 
     * @Route("/legal-notices", name="legal_notices", methods={"GET"})
     * 
     * @return Reponse
     */

    public function legalNotices()
    {
        return $this->render('front/footer/legal_notices.html.twig', [
            
        ]);
    }

}

