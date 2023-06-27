<?php

namespace App\Controller\Back;

use App\Entity\Country;
use App\Form\Back\CountryType;
use App\Repository\CountryRepository;
use DateTime;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/country")
 */
class CountryController extends AbstractController
{
    /**
     * Countries list 
     * 
     * @Route("/", name="app_back_country_index", methods={"GET"})
     * 
     * @ IsGranted("ROLE_ADMIN")
     */
    public function index(CountryRepository $countryRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $countries = $countryRepository->findAll();

        $countries = $paginatorInterface->paginate($countries,
        $request->query->getInt('page', 1),6);

        return $this->render('back/country/index.html.twig', [
            'countries' => $countries,
        ]);
    }

    /**
     * @Route("/new", name="app_back_country_new", methods={"GET", "POST"})
     */
    public function new(Request $request, CountryRepository $countryRepository): Response
    {
        $country = new Country();
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $countryRepository->add($country, true);

            $this->addFlash(
                'success',
                'Le pays a bien été ajouté'
            );

            return $this->redirectToRoute('app_back_country_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/country/new.html.twig', [
            'country' => $country,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_country_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(Country $country): Response
    {
        return $this->render('back/country/show.html.twig', [
            'country' => $country,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_country_edit", methods={"GET", "POST"}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, Country $country, CountryRepository $countryRepository): Response
    {
        $form = $this->createForm(CountryType::class, $country);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $country->setUpdatedAt(new DateTime("now"));
            $countryRepository->add($country, true);

            return $this->redirectToRoute('app_back_country_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/country/edit.html.twig', [
            'country' => $country,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_country_delete", methods={"POST"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, Country $country, CountryRepository $countryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$country->getId(), $request->request->get('_token'))) {
            $countryRepository->remove($country, true);
        }

        return $this->redirectToRoute('app_back_country_index', [], Response::HTTP_SEE_OTHER);
    }
}
