<?php

namespace App\Service;


use App\Entity\Contact;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email as PHPEmail;


class ContactEmailService {

    public $mailer;
    public $email;
    public $reciver;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function getReciver() {

        return $this->reciver;

    }

    public function setReciver($reciver){

        $this->reciver  = $reciver;

    }

    public function initializeEmail(Contact $contact){

        $to = $this->getReciver();

        $subject = $contact->getName(). "(" . $contact->getEmail() . ") - " . $contact->getCreatedAt()->format('d-M-Y h:i');
        
        $content =  "<h1>". $contact->getTitle() ."</h1><br>" . $contact->getContent() ;
        // $textmail = "<h1>".(new \DateTime('now'))->format('d-m-Y h:i')."</h1>";
        // $htmlmail = "<div>".$textmail. "<p>". $content . "</p>". "</div>";

        $this->email = (new PHPEmail())
        ->from('ns1root@locs.ro')
        ->to($to)
        //->cc('cc@example.com')
        //->bcc('bcc@example.com')
        //->replyTo('fabien@example.com')
        //->priority(Email::PRIORITY_HIGH)
        ->subject($subject)
        ->text($content)
        ->html($content);
        // ->attach($dompdf->output(), $pdfname);
       
    }

    public function send(){
        $this->mailer->send($this->email);
    }

}