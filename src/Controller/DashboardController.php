<?php

namespace App\Controller;

use App\Repository\CompanyRepository;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

/**
 *  @return Response
 */
class DashboardController extends AbstractController
{
    public function index(CompanyRepository $companyRepository, ContactRepository $contactRepository): Response
    {
        //redirect user if not logged in
        if(!$this->getUser()){
            return $this->redirectToRoute('app_login');
        }

        return $this->render('dashboard/index.html.twig', [
            'contacts' => $contactRepository->getFiveLastContactsAdded(),
            'companies' => $companyRepository->getFiveLastCompaniesAdded(),
        ]);
    }
}
