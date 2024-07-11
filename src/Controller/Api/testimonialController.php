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
        // Décoder les données JSON envoyées dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérifier que les données sont bien décodées
        if (!$data) {
            return new JsonResponse(['error' => 'Invalid JSON'], Response::HTTP_BAD_REQUEST);
        }

        // Créer une nouvelle instance de l'entité Testimonial
        $testimonial = new Testimonial();
        $testimonial->setPseudo($data['pseudo'] ?? null);
        $testimonial->setContent($data['content'] ?? null);
        $testimonial->setIsVisible($data['isVisible'] ?? false);

        // Valider l'entité
        $errors = $validator->validate($testimonial);

        if (count($errors) > 0) {
            return new JsonResponse(['errors' => (string) $errors], Response::HTTP_BAD_REQUEST);
        }

        // Sauvegarder l'entité dans la base de données
        $em->persist($testimonial);
        $em->flush();

        // Retourner une réponse de succès
        return new JsonResponse(['status' => 'Testimonial created successfully'], Response::HTTP_CREATED);
    }
}

