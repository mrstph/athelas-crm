<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserContactType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfileController extends AbstractController
{
    public function edit(): Response
    {
        return new Response('');
    }

    public function show(User $user): Response
    {
        // verfication if user is allowed to see this profile
        if ($this->getUser()->getId() != $user->getId()){
            return $this->render('bundles/TwigBundle/Exception/error403.html.twig',[], new Response('', 403));    
        };

        return $this->render('profile/show.html.twig', [
            'user' => $user,
        ]);
    }

    public function editPassword(): Response
    {
        return new Response('');
    }
}