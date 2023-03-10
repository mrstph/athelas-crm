<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilePasswordType;
use App\Form\ProfileUserContactType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ProfileController extends AbstractController
{
    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        // verfication if user is allowed to see this profile
        if ($this->getUser()->getId() != $user->getId()){
            return $this->render('bundles/TwigBundle/Exception/error403.html.twig',[], new Response('', 403));    
        };

        $form = $this->createForm(ProfileUserContactType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            $this->addFlash('success', 'Profil mis à jour avec succès');

            return $this->render('profile/show.html.twig', [
                'user' => $user,
            ]);
        }
        
        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
}

    public function editPassword(Request $request, User $user, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        // verfication if user is allowed to see this profile
        if ($this->getUser()->getId() != $user->getId()){

            return $this->render('bundles/TwigBundle/Exception/error403.html.twig',[], new Response('', 403));    
        };
        
        $form = $this->createForm(ProfilePasswordType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $oldPassword = $request->request->get('actual_password');
            $checkPass = $passwordHasher->isPasswordValid($user, $oldPassword);
            
            // compare if actual password matches the request
            if ($checkPass === true) {

                //hash and set new password
                $newPassword =  $passwordHasher->hashPassword($user, $form->get('password')->getdata());
                $user->setPassword($newPassword);

                $userRepository->save($user, true);

                $this->addFlash('success', 'Mot de passe mis à jour avec succès');
    
                return $this->render('profile/show.html.twig', [
                    'user' => $user,
                ]);
            }

            $this->addFlash('error', 'Votre mot de passe actuel ne correspond pas');

            return $this->render('profile/editPassword.html.twig', [
                'user' => $user,
                'form' => $form,
            ]);
 
        }

        return $this->render('profile/editPassword.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
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
}