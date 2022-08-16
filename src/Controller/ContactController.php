<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    private ContactRepository $repo;
    public function __construct(ContactRepository $repo)
    {
        $this->repo = $repo;
    }
    
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();

            $this->repo->add($contact, true);

            $email = (new Email())
            ->from($contact->getEmail())
            ->to('contact@laregina.com')
            ->subject($contact->getObject())
            ->html($contact->getMessage());

            $mailer->send($email);

            $this->addFlash('success', 'Message send with success !');

            return $this->redirectToRoute('app_contact');
        }

        return $this->renderForm('home/contact.html.twig', [ 'form' => $form]);
    }
}
