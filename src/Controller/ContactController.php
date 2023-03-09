<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends AbstractController
{
    public function index(ContactRepository $contactRepository): Response
    {     
        return $this->render('contacts/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
        ]);
    }

    public function new(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact->setCreatedAt(new \DateTimeImmutable());
            $contactRepository->save($contact, true);

            $this->addFlash('success', 'Nouveau contact créé avec succès');

            return $this->redirectToRoute('contacts_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contacts/new.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    public function show(Contact $contact): Response
    {
        return $this->render('contacts/show.html.twig', [
            'contact' => $contact,
        ]);
    }

    public function edit(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactRepository->save($contact, true);

            $this->addFlash('success', 'Contact mis à jour avec succès');

            return $this->redirectToRoute('contacts_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('contacts/edit.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);
    }

    public function delete(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $contactRepository->remove($contact, true);
        }

        $this->addFlash('success', 'Contact supprimé avec succès');

        return $this->redirectToRoute('contacts_index', [], Response::HTTP_SEE_OTHER);
    }
}
