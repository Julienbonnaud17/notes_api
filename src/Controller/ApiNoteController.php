<?php

namespace App\Controller;

use App\Entity\Note;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/api/notes', name: 'api_notes_')]
class ApiNoteController extends AbstractController
{
    #[Route('', methods: ['GET'])]
    public function list(EntityManagerInterface $em): JsonResponse
    {
        $notes = $em->getRepository(Note::class)->findAll();
        return $this->json($notes, 200, [], ['groups' => 'note']);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(Note $note): JsonResponse
    {
        return $this->json($note, 200, [], ['groups' => 'note']);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em, SerializerInterface $serializer): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $note = new Note();
        $note->setTitle($data['title'] ?? '');
        $note->setContent($data['content'] ?? '');
        $now = new \DateTimeImmutable();
        $note->setCreatedAt($now);
        $note->setUpdatedAt($now);

        $em->persist($note);
        $em->flush();

        return $this->json($note, 201, [], ['groups' => 'note']);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Note $note, Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $note->setTitle($data['title'] ?? $note->getTitle());
        $note->setContent($data['content'] ?? $note->getContent());
        $note->setUpdatedAt(new \DateTimeImmutable());

        $em->flush();

        return $this->json($note, 200, [], ['groups' => 'note']);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(Note $note, EntityManagerInterface $em): JsonResponse
    {
        $em->remove($note);
        $em->flush();
        return $this->json(null, 204);
    }
}
