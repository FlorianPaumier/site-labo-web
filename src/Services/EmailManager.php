<?php
namespace App\Services;

use App\Entity\Emails;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Message;
use Twig\Environment;

class EmailManager
{
    private $mailer;
    /** @var Environment */
    private $twig;
    private $from =  "fpaumier@myges.fr";

    public function __construct(MailerInterface $mailer, Environment $twig)
    {
        $this->mailer = $mailer;
        $this->twig = $twig;
    }

    public function send(Emails $emails)
    {
        $userMail = [];

        foreach ($emails->getDest() as $dest){
            $userMail[] = $dest->getEmail();
        }

        $mail = (new Email())
            ->from($this->from)
            ->to(...$userMail)
            ->subject($emails->getTitle())
            ->html($this->twig->render("emails/base.html.twig", ["body" => $emails->getBody()]))
            ;

        $this->mailer->send($mail);
    }
}