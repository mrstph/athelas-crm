<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\User;
use App\Form\UserContactType;
use App\Repository\ContactRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends AbstractController
{
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('users/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    public function new(Request $request, UserRepository $userRepository, ContactRepository $contactRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $user = new User();
        $contact = new Contact();

        $form = $this->createForm(UserContactType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {  
            $contact = $form->getData()->getContact();
            $user = $form->getData();

            //store the firstname and lastname with first letter in uppercase in the DB
            //this restriction is not applied in edit to allow more Flexibility (ie with names like 'Jean-Charles')
            $contact->setFirstname( ucfirst(strtolower($form->getData()->getContact()->getFirstname())));
            $contact->setLastname( ucfirst(strtolower($form->getData()->getContact()->getLastname())));

            //assign remaining values
            $user->setConsent(false);
            $user->setPicture('placeholder');
            $user->setRoles(['ROLE_USER']);
            $contact->setCreatedAt(new \DateTimeImmutable());
            $userRepository->save($user, true);
            $contactRepository->save($contact, true);
            
            $this->addFlash('success', 'Nouvel employé créé');

            return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('users/new.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }

    public function show(User $user): Response
    {
        return $this->render('users/show.html.twig', [
            'user' => $user,
        ]);
    }

    public function edit(Request $request, User $user, UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $form = $this->createForm(UserContactType::class, $user);

        $form->remove('password');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userRepository->save($user, true);

            $this->addFlash('success', 'Employé mis à jour avec succès');

            return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('users/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }
    
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        //prevents admin to delete himself
        if($user->getId() === 1){

            $this->addFlash('error', 'Vous ne pouvez pas supprimer ce compte');

            return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user, true);
        }

        $this->addFlash('success', 'Employé supprimé avec succès');

        return $this->redirectToRoute('users_index', [], Response::HTTP_SEE_OTHER);
    }
}
