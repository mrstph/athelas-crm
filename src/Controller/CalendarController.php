<?php

namespace App\Controller;

use App\Form\EventType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CalendarController extends AbstractController
{
    public function index(): Response
    {
        $form = $this->createForm(EventType::class);
        $formEdit = $this->createForm(EventType::class);

        return $this->render('calendar/index.html.twig', [
            'form' => $form,
            'formEdit' => $formEdit,
        ]);
    }
}