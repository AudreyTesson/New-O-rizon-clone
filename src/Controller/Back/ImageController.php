<?php

namespace App\Controller\Back;

use App\Entity\Image;
use App\Form\Back\ImageType;
use App\Repository\ImageRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/back/image")
 */
class ImageController extends AbstractController
{
    /**
     * Images list
     * 
     * @Route("/", name="app_back_image_index", methods={"GET"})
     * 
     * @ IsGranted("ROLE_ADMIN")
     */
    public function index(ImageRepository $imageRepository, PaginatorInterface $paginatorInterface, Request $request): Response
    {
        $images = $imageRepository->findAll();
        $images = $paginatorInterface->paginate($images,
        $request->query->getInt('page', 1),6);

        return $this->render('back/image/index.html.twig', [
            'images' => $images,
        ]);
    }

    /**
     * @Route("/new", name="app_back_image_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ImageRepository $imageRepository): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);

            $this->addFlash(
                'success',
                "L'image a bien été ajoutée"
            );

            return $this->redirectToRoute('app_back_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/image/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_image_show", methods={"GET"})
     */
    public function show(Image $image): Response
    {
        return $this->render('back/image/show.html.twig', [
            'image' => $image,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_back_image_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageRepository->add($image, true);

            return $this->redirectToRoute('app_back_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('back/image/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_back_image_delete", methods={"POST"})
     */
    public function delete(Request $request, Image $image, ImageRepository $imageRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->request->get('_token'))) {
            $imageRepository->remove($image, true);
        }

        return $this->redirectToRoute('app_back_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
