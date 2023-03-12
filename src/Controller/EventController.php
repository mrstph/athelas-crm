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
        $this->denyAccessUnlessGranted('ROLE_USER');

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
                'backgroundColor' => $event->getBackgroundColor(),
                'description' => $event->getDescription(),
                'location' => $event->getLocation()
            ];
        }
        return new JsonResponse($data, 200);
    }

    public function new(Request $request, EventRepository $eventRepository): JsonResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

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
                    'backgroundColor' => $event->getBackgroundColor(),
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation()
                ];

            return new JsonResponse($data, 201);
        }

        //deal with errors later
        return new JsonResponse('error');
    }

    public function edit(Request $request, EventRepository $eventRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        // update the calendar events when drag and drop
        $data = json_decode($request->getContent(), true);
        $event = $eventRepository->find($data['id']);

        $formEdit = $this->createForm(EventType::class, $event);
        $formEdit->handleRequest($request);

        if ($formEdit->isSubmitted() && $formEdit->isValid()) {

            // handle form submission
            return new JsonResponse($event, 200);

        } elseif (!$formEdit->isSubmitted()) {

            // no form submission = drag and drop

            $event->setDateStart(new \DateTime($data['start']));
            $event->setDateEnd(new \DateTime($data['end']));
    
            $eventRepository->save($event, true);

            return new JsonResponse($event, 200);
        }

        //deal with errors later
        return new JsonResponse('error');

    }

    public function delete(Request $request, EventRepository $eventRepository): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        $data = json_decode($request->getContent(), true);
        $event = $eventRepository->find($data['id']);

        if (!$event) {
            return $this->json('Pas d\évenement trouvé pour id '. $data['id'], 404);
        }

        $eventRepository->remove($event, true);

        $data = [
            'id' => $data['id']
        ];

        // csrf token security is disable for the demo

        return new JsonResponse($data, 200);

        //deal with errors later
        // return new JsonResponse('error');
    }

}
