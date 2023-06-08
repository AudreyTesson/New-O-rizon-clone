<?php

namespace App\Controller\Front;

use App\Entity\User;
use App\Form\Front\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * Registration user method
     * @Route("/sign-in", name="sign-in")
     * 
     * @return Response
     */
    public function new(UserPasswordHasherInterface $passwordHasher, Request $request, UserRepository $userRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // get password to hash before setting property
            $plaintextPassword = $user->getPassword();
            $passwordHashed = $passwordHasher->hashPassword($user,  $plaintextPassword);
            $user->setPassword($passwordHashed);
            $userRepository->add($user, true);

            $this->addFlash(
                'success',
                'Félicitations ! ' . $user->getFirstname() . ' vous êtes un membre O\'rizon'
            );

            // redirection expected to login form route
        }

        return $this->renderForm('front/user/sign_in.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

   
}
