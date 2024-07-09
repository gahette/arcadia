<?php


namespace App\Controller\Api;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
}
