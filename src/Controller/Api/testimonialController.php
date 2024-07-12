<?php

namespace App\Controller\Api;

use App\Entity\Testimonial;
use App\Repository\TestimonialRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class testimonialController extends AbstractController
{
    /**
     * @throws ExceptionInterface
     */
    #[Route('/api/testimonial', name: 'api_testimonial_get', methods: ['GET'])]
    public function getTestimonials(TestimonialRepository $testimonialRepository, NormalizerInterface $normalizer): Response
    {
        $testimonials = $testimonialRepository->findAll();

        $serializedTestimonials = $normalizer->normalize($testimonials, 'json', [
            'groups' => ['testimonial: read'],
        ]);

        return $this->json($serializedTestimonials);
    }

    #[Route('/api/testimonial', name: 'api_testimonial_post', methods: ['POST'])]
    public function createTestimonial(Request $request, EntityManagerInterface $em, ValidatorInterface $validator): Response
    {
        $data = json_decode($request->getContent(), true);

        if (!is_array($data)) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        $pseudo = isset($data['pseudo']) && is_string($data['pseudo']) ? $data['pseudo'] : null;
        $content = isset($data['content']) && is_string($data['content']) ? $data['content'] : null;
        $isVisible = isset($data['isVisible']) && is_bool($data['isVisible']) ? $data['isVisible'] : false;

        $testimonial = new Testimonial();
        $testimonial->setPseudo($pseudo);
        $testimonial->setContent($content);
        $testimonial->setIsVisible($isVisible);

        $errors = $validator->validate($testimonial);

        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        $em->persist($testimonial);
        $em->flush();

        return new JsonResponse(['status' => 'Testimonial created successfully'], Response::HTTP_CREATED);
    }
}
