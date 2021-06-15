<?php

declare(strict_types=1);

namespace App\Controller\Attendee;

use App\Entity\Attendee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/attendees/{identifier}', name: 'read_attendee', methods: ['GET'])]
final class ReadController
{
    public function __invoke(Attendee $attendee): JsonResponse
    {
        return new JsonResponse($attendee->toArray(), Response::HTTP_OK);
    }
}
