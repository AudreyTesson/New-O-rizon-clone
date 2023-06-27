<?php

namespace App\Controller\Back;

use App\Entity\City;
use App\Form\Back\CityType;
use App\Repository\CityRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/city", name="app_back_city_")
 */
class CityController extends AbstractController
{
    /**
     * Cities List
     * 
     * @Route("/", name="index", methods={"GET"})
     * 
     * @ IsGranted("ROLE_ADMIN")
     */
    public function index(CityRepository $cityRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $cities = $cityRepository->findCountryAndImageByCity();
        $cities = $paginatorInterface->paginate($cities, 
        $request->query->getInt('page', 1),6);

        return $this->render('back/city/index.html.twig', [
            'cities' => $cities,
        ]);
    }

    /**
     * @Route("/new", name="new", methods={"GET", "POST"})
     */
    public function new(Request $request, CityRepository $cityRepository): Response
    {
        $city = new City();
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cityRepository->add($city, true);

            $this->addFlash(
                'success',
                'La ville a bien été ajoutée'
            );

            return $this->redirectToRoute('app_back_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/city/new.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(City $city): Response
    {
        return $this->render('back/city/show.html.twig', [
            'city' => $city,
            
        ]);
    }

    /**
     * @Route("/{id}/edit", name="edit", methods={"GET", "POST"}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, City $city, CityRepository $cityRepository): Response
    {
        $form = $this->createForm(CityType::class, $city);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $city->setUpdatedAt(new DateTime("now"));
            $cityRepository->add($city, true);

    

            return $this->redirectToRoute('app_back_city_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/city/edit.html.twig', [
            'city' => $city,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="delete", methods={"POST"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, City $city, CityRepository $cityRepository): Response
    {
        if ($city === null){throw $this->createNotFoundException("Cette ville n'existe pas");}
        if ($this->isCsrfTokenValid('delete'.$city->getId(), $request->request->get('_token'))) {
            $cityRepository->remove($city, true);
        }

        return $this->redirectToRoute('app_back_city_index', [], Response::HTTP_SEE_OTHER);
    }
}
