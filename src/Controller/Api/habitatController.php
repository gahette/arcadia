<?php

namespace App\Controller\Api;

use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class habitatController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/habitat', name: 'api_habitat', methods: ['GET'])]
    public function getHabitats(HabitatRepository $habitatRepository, NormalizerInterface $normalizer): Response
    {
        $habitats = $habitatRepository->findAll();

        $serializedHabitats = $normalizer->normalize($habitats, 'json', [
            'groups' => ['habitat:read', 'image:read'],
        ]);

        return $this->json($serializedHabitats);
    }
}
