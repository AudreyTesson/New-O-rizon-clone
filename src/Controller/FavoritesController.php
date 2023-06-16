<?php

namespace App\Controller;

use App\Repository\CityRepository;
use App\Repository\ImageRepository;
use App\Repository\UserRepository;
use App\Service\FavoritesService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @IsGranted("ROLE_USER")
 */
class FavoritesController extends AbstractController
{
    /**
     * @Route("/favorites", name="favorites")
     */
    public function favorites(PaginatorInterface $paginatorInterface, ImageRepository $imageRepository, Request $request): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $favoritesList = $user->getCity();

        // dd($favoritesList);

        $images = $imageRepository->findByDistinctCityImage();

        $images = $paginatorInterface->paginate($images, $request->query->getInt('page', 1),6);

        return $this->render('front/favorites/index.html.twig', [
            "images" => $images,
            "city" => $favoritesList
        ]);
    }

    /**
     * Add city on favorites
     *
     * @Route("/favorites/add/{id}", name="favorites_add", requirements={"id"="\d+"})
     * 
     * @return Response
     */
    public function add($id, CityRepository $cityRepository, EntityManagerInterface $em, Request $request): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $city = $cityRepository->find($id);

        $route = $request->headers->get('referer');

    return $this->redirect($route);

        if ($city === null) { throw new Exception("ce favori n'existe pas.", 201);
        }
        if (!$user) { $this->redirectToRoute('app_login');
        } else {
            $city->addUser($user);
            $name = $city->getName();

            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'success',
                "$name a été ajouté à votre liste de favoris"
            );
        }

        return $this->redirect($route);
    }

    /**
     * Remove one favorite
     * 
     * @Route("/favorites/remove/{id}", name="favorites_remove", requirements={"id"="\d+"})
     *
     * @return Response
     */
    public function remove($id, CityRepository $cityRepository, EntityManagerInterface $em, Request $request):Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $city = $cityRepository->find($id);

        $route = $request->headers->get('referer');

        if ($city === null) { throw new Exception("ce favori n'existe pas.", 201);
        }
        if (!$user) { $this->redirectToRoute('app_login');
        } else {
            $city->removeUser($user);
            $name = $city->getName();

            $em->persist($city);
            $em->flush();

            $this->addFlash(
                'success',
                "$name a été retiré de votre liste de favoris"
            );
        }

        return $this->redirect($route);
    }

    /**
     * Delete all favorites
     *
     * @Route("favorites/clear", name="favorites_clear")
     * @param Request
     * @return Response
     */
    public function removeAll(EntityManagerInterface $em): Response
    {
        /** @var \App\Entity\User */
        $user = $this->getUser();

        $favoritesList = $user->getCity();
        if ($favoritesList === null) { throw new Exception("ce favori n'existe pas.", 201);}

        foreach ($favoritesList as $cityFavorite) {
            $cityFavorite->removeUser($user);
            $em->persist($cityFavorite);
        }

        $em->flush();

        $this->addFlash(
            'success',
            "Les villes ont été supprimées de votre liste de favoris"
        );

        return $this->redirectToRoute("favorites");
    }
}