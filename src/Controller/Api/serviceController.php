<?php

namespace App\Controller\Api;

use App\Repository\ServiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class serviceController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/service', name: 'api_service', methods: ['GET'])]
    public function getServices(ServiceRepository $serviceRepository, NormalizerInterface $normalizer): Response
    {
        $services = $serviceRepository->findAll();

        $serializedServices = $normalizer->normalize($services, 'json', [
            'groups' => ['service:read'],
        ]);

        return $this->json($serializedServices);
    }
}
