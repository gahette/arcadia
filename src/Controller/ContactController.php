<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact_index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('contact/index.html.twig');
    }

    #[Route('/contact', name: 'contact', methods: ['POST'])]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $name = (string) $request->request->get('name');
        $email = (string) $request->request->get('email');
        $message = (string) $request->request->get('message');

        $emailMessage = (new Email())
            ->from($email)
            ->to('jose@arcadia.com')
            ->subject('Contact Form Submission')
            ->text("Name: $name\n\nMessage: $message");

        $mailer->send($emailMessage);

        return $this->json(['status' => 'Message sent']);
    }
}
