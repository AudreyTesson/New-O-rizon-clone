<?php

namespace App\Service;

use App\Data\FilterData;
use App\Entity\City;
use App\Form\Front\FilterDataType;
use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;

class SidebarFilterService 
{
    private $formFactoryInterface;
    private $request;

    public function __construct(FormFactoryInterface $formFactoryInterface, RequestStack $request, ManagerRegistry $registry)
    {
        // $this->parent::__construct($registry, YourEntity::class);
        $this->formFactoryInterface = $formFactoryInterface;
        $this->request = $request;
    }

    public function sidebarForm(City $city, Request $request)
    {
        $city = $
        $data = new FilterData();
        $form = $this->formFactoryInterface->create(FilterDataType::class, $data);
        
        $form->handleRequest($this->request);
        $citiesFilter = $cityRepository->findByFilter($data);
        if ($citiesFilter === null) {
            throw new Exception("Nous n'avons pas trouvé de ville correspondant à votre recherche");
        }

        // if ($form->isSubmitted() && $form->isValid()) {
        //     return $this->redirectToRoute('cities_list', ["cities" => $citiesFilter, "images" => $images], Response::HTTP_SEE_OTHER);
        // }
    }

}