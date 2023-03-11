<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\User;
use App\Form\EventType;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EventController extends AbstractController
{
    public function index(): JsonResponse
    {
        // $this->denyAccessUnlessGranted('ROLE_USER');
        // Get events for the current user
        $events = $this->getUser()->getContact()->getEvent();
        
        // Convert the events to an array of JSON data
        $data = [];
        foreach($events as $event) {
            $data[] = [
                'id' => $event->getId(),
                'title' => $event->getLabel(),
                'start' => $event->getDateStart()->format('Y-m-d H:i:s'),
                'end' => $event->getDateEnd()->format('Y-m-d H:i:s'),
                'allDay' => $event->isAllDay(),
            ];
        }
        return new JsonResponse($data, 200);
    }

    public function new(Request $request, EventRepository $eventRepository): Response
    {
        $event = new Event();
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $event->addContact($this->getUser()->getContact());
            $eventRepository->save($event, true);

                $data[] = [
                    'id' => $event->getId(),
                    'title' => $event->getLabel(),
                    'start' => $event->getDateStart()->format('Y-m-d H:i:s'),
                    'end' => $event->getDateEnd()->format('Y-m-d H:i:s'),
                    'allDay' => $event->isAllDay(),
                ];

            return new JsonResponse($data, 200);
        }

        //deal with errors later
        return new JsonResponse('error');
    }

    // public function show(Event $event): Response
    // {
    //     return $this->render('event/show.html.twig', [
    //         'event' => $event,
    //     ]);
    // }

    // public function edit(Request $request, Event $event, EventRepository $eventRepository): Response
    // {
    //     $form = $this->createForm(EventType::class, $event);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $eventRepository->save($event, true);

    //         return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('event/edit.html.twig', [
    //         'event' => $event,
    //         'form' => $form,
    //     ]);
    // }

    // public function delete(Request $request, Event $event, EventRepository $eventRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$event->getId(), $request->request->get('_token'))) {
    //         $eventRepository->remove($event, true);
    //     }

    //     return $this->redirectToRoute('app_event_index', [], Response::HTTP_SEE_OTHER);
    // }
}
