<?php

namespace App\EventListener;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

#[\AllowDynamicProperties] class NewUserListener implements EventSubscriberInterface
{
    private MailerInterface $mailer;
    private string $adminEmail;

    public function __construct(
        #[Autowire('%admin_email%')] string $adminEmail,
        MailerInterface $mailer,
        RequestStack $requestStack)
    {
        $this->adminEmail = $adminEmail;
        $this->mailer = $mailer;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            AfterEntityPersistedEvent::class => 'onAfterEntityPersisted',
        ];
    }

    public function onAfterEntityPersisted(AfterEntityPersistedEvent $event): void
    {
        $entity = $event->getEntityInstance();

        if ($entity instanceof User) {
            $this->sendWelcomeEmail($entity);
        }
    }

    private function sendWelcomeEmail(User $user): void
    {
        $email = (new TemplatedEmail())
            ->from($this->adminEmail)
            ->to($user->getEmail())
            ->subject('Bienvenue chez Arcadia')
            ->htmlTemplate('emails/welcome.html.twig')
            ->context([
                'nom' => $user->getLastname(),
                'prénom' => $user->getFirstname(),
                'username' => $user->getEmail(),
                'userRole' => $this->getUserRoleLabel($user->getRoles()),
            ]);

        try {
            $this->mailer->send($email);
            $this->requestStack->getSession()->getFlashBag()->add('success', 'L\'e-mail de bienvenue a bien été envoyé à '.$user->getFirstname().' '.$user->getLastname().' avec succès !');
        } catch (TransportExceptionInterface $e) {
            $this->requestStack->getSession()->getFlashBag()->add('error', 'L\'envoi de l\'e-mail de bienvenue n\'a pas pu être envoyé à '.$user->getFirstname().' '.$user->getLastname());
        }
    }

    private function getUserRoleLabel(array $roles): string
    {
        if (in_array('ROLE_SUPER_ADMIN', $roles)) {
            return 'Super administrateur';
        } elseif (in_array('ROLE_ADMIN', $roles)) {
            return 'Administrateur';
        } elseif (in_array('ROLE_EMPLOYEE', $roles)) {
            return 'Employé';
        } elseif (in_array('ROLE_VETERINARIAN', $roles)) {
            return 'Vétérinaire';
        } else {
            return 'Utilisateur';
        }
    }
}
