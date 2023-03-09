<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CompanyController extends AbstractController
{
    public function index(CompanyRepository $companyRepository): Response
    {
        return $this->render('companies/index.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    public function new(Request $request, CompanyRepository $companyRepository): Response
    {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $company->setCreatedAt(new \DateTimeImmutable());
            $companyRepository->save($company, true);
            
            $this->addFlash('success', 'Nouvelle entreprise créée avec succès');

            return $this->redirectToRoute('companies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('companies/new.html.twig', [
            'company' => $company,
            'form' => $form
        ]);
    }

    public function show(Company $company): Response
    {
        return $this->render('companies/show.html.twig', [
            'company' => $company,
        ]);
    }

    public function edit(Request $request, Company $company, CompanyRepository $companyRepository): Response
    {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $companyRepository->save($company, true);

            $this->addFlash('success', 'Entreprise mise à jour avec succès');

            return $this->redirectToRoute('companies_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('companies/edit.html.twig', [
            'company' => $company,
            'form' => $form
        ]);
    }
    
    public function delete(Request $request, Company $company, CompanyRepository $companyRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$company->getId(), $request->request->get('_token'))) {
            $companyRepository->remove($company, true);
        }

        $this->addFlash('success', 'Entreprise supprimée avec succès');

        return $this->redirectToRoute('companies_index', [], Response::HTTP_SEE_OTHER);
    }
}
