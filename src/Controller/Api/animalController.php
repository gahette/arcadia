<?php

namespace App\Controller\Api;

use App\Entity\Animal;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class animalController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/animal', name: 'api_animal', methods: ['GET'])]
    public function getAnimals(AnimalRepository $animalRepository, NormalizerInterface $normalizer): Response
    {
        $animals = $animalRepository->findAll();

        $serializedAnimals = $normalizer->normalize($animals, 'json', [
            'groups' => ['animal:read', 'image:read'],
        ]);

        return $this->json($serializedAnimals);
    }

    #[Route('/api/animal/{id}/increment-consultation', name: 'increment_consultation_count', methods: ['POST'])]
    public function incrementConsultationCount(Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $animal->setConsultationCount($animal->getConsultationCount() + 1);
        $entityManager->persist($animal);
        $entityManager->flush();

        return new JsonResponse(['status' => 'success'], JsonResponse::HTTP_OK);
    }
}
