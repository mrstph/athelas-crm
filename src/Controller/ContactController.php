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
            'contacts' => $contactRepository->findAllContactsThatAreNotUsers(),
        ]);
    }

    public function new(Request $request, ContactRepository $contactRepository): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //store the firstname and lastname with first letter in uppercase in the DB
            //this restriction is not applied in edit to allow more Flexibility (ie with names like 'Jean-Charles')
            $contact->setFirstname( ucfirst(strtolower($form->getData()->getFirstname())));
            $contact->setLastname( ucfirst(strtolower($form->getData()->getLastname())));

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
        // modify contact only if it's not a user
        if($contact->getUser() == null){

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

        } else {

            return $this->render('bundles/TwigBundle/Exception/error403.html.twig',[], new Response('', 403));
        }
    }

    public function delete(Request $request, Contact $contact, ContactRepository $contactRepository): Response
    {
        // delete contact only if it's not a user
        if($contact->getUser() == null){

            if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
                $contactRepository->remove($contact, true);
            }

            $this->addFlash('success', 'Contact supprimé avec succès');

            return $this->redirectToRoute('contacts_index', [], Response::HTTP_SEE_OTHER);

        } else {

        return $this->render('bundles/TwigBundle/Exception/error403.html.twig',[], new Response('', 403));

        }
    }
}