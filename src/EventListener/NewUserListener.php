<?php

namespace App\EventListener;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\AfterEntityPersistedEvent;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;

#[\AllowDynamicProperties]
class NewUserListener implements EventSubscriberInterface
{
    private MailerInterface $mailer;
    private string $adminEmail;
    private RequestStack $requestStack;

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
        $firstname = $user->getFirstname() ?? '';
        $lastname = $user->getLastname() ?? '';
        $email = $user->getEmail() ?? '';
        $userRoleLabel = $this->getUserRoleLabel($user->getRoles());

        $htmlContent = '
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <title>Bienvenue chez Arcadia</title>
        </head>
        <body>
                <h1>Bienvenue chez Arcadia !</h1>
                <p>Bonjour '.htmlspecialchars($firstname, ENT_QUOTES, 'UTF-8').' '.htmlspecialchars($lastname, ENT_QUOTES, 'UTF-8').',</p>
                <p>Nous sommes heureux de vous accueillir en tant que '.htmlspecialchars($userRoleLabel, ENT_QUOTES, 'UTF-8').' dans notre équipe. Votre compte a été créé avec succès. Voici vos informations de connexion :</p>
                <ul>
                    <li><strong>Nom d\'utilisateur (email) :</strong> '.htmlspecialchars($email, ENT_QUOTES, 'UTF-8').'</li>
                </ul>
                <p>Pour des raisons de sécurité, votre mot de passe n\'est pas inclus dans cet email. Veuillez contacter votre administrateur pour obtenir votre mot de passe.</p>
                <p>Si vous avez des questions ou avez besoin d\'aide, n\'hésitez pas à nous contacter.</p>
                <p>Cordialement,</p>
                <p>Arcadia</p>
        </body>
        </html>
        ';

        $email = (new TemplatedEmail())
            ->from($this->adminEmail)
            ->to((string) $user->getEmail())
            ->subject('Bienvenue chez Arcadia')
            ->html($htmlContent)
        ;

        try {
            $this->mailer->send($email);

            // Vérifiez si la session est du type `Session`
            $session = $this->requestStack->getSession();
            if ($session instanceof Session) {
                $session->getFlashBag()->add('success', 'L\'e-mail de bienvenue a bien été envoyé à '.$firstname.' '.$lastname.' avec succès !');
            }
        } catch (TransportExceptionInterface $e) {
            $session = $this->requestStack->getSession();
            if ($session instanceof Session) {
                $session->getFlashBag()->add('error', 'L\'envoi de l\'e-mail de bienvenue n\'a pas pu être envoyé à '.$firstname.' '.$lastname);
            }
        }
    }

    /**
     * @param array<string> $roles
     */
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
