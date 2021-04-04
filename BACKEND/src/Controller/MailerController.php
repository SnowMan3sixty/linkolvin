<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/email")
     */
    public function sendEmail(MailerInterface $mailer)
    {

        header('Access-Control-Allow-Origin: *');
        $data = json_decode($mailer->getContent(), true);
        $correu = $data['correu'];

        $email = (new Email())
            ->from('linkolvin@gmail.com')
            ->to($correu)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Has recibido un correo de Linkolvin')
            ->text('Revisa que contiene el correo crack')
            ->html('<p>Este es un correo de prueba</p>');

        $mailer->send($email);

        return new Response('Correo enviado con éxito');
    }
}