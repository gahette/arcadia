<?php

namespace App\Controller\Api;

use App\Repository\ImageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class ImageController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/image', name: 'api_image', methods: ['GET'])]
    public function getImages(ImageRepository $imageRepository, NormalizerInterface $normalizer): Response
    {
        $images = $imageRepository->findAll();

        $serializedImages = $normalizer->normalize($images, 'json', [
            'groups' => ['animal', 'habitat'],
        ]);

        return $this->json($serializedImages);
    }
}
