<?php

namespace App\Controller\Front;

use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\CityRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReviewController extends AbstractController
{
    /**
     * @Route("/front/reviews/{id}/review/add", name="app_front_review_add", requirements={"id": "\d+"})
     */
    public function index(
        $id,
        CityRepository $cityRepository,
        Request $request,
        EntityManagerInterface $entityManagerInterface,
        ReviewRepository $reviewRepository
    ): Response
    {

        $city = $cityRepository->find($id);
        if ($city === null){ throw $this->createNotFoundException("cette ville n'est pas encore ajoutée");}

        $newReview = new Review();
        $form = $this->createForm(ReviewType::class, $newReview);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newReview->setCity($city);

            $entityManagerInterface->persist($newReview);
            $entityManagerInterface->flush();

            return $this->redirectToRoute("cities_detail", ["id"=> $city->getId()]);
        }

        return $this->renderForm('front/review/index.html.twig', [
            "cityFromBDD" => $city,
            "formulaire" => $form
        ]);
    }
}
