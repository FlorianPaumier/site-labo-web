<?php

namespace App\Controller\BackEnd;

use App\Entity\Emails;
use App\Form\EmailsType;
use App\Repository\EmailsRepository;
use App\Services\EmailManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/emails")
 * @IsGranted("ROLE_ADMIN")
 */
class EmailsController extends AbstractController
{
    /**
     * @Route("/", name="admin_emails_index", methods={"GET"})
     * @param EmailsRepository $emailsRepository
     * @return Response
     */
    public function index(EmailsRepository $emailsRepository): Response
    {
        return $this->render('emails/index.html.twig', [
            'emails' => $emailsRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin_emails_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $email = new Emails();
        $form = $this->createForm(EmailsType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($email);
            $entityManager->flush();

            return $this->redirectToRoute('admin_emails_index');
        }

        return $this->render('emails/new.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_emails_show", methods={"GET"})
     * @param Emails $email
     * @return Response
     */
    public function show(Emails $email): Response
    {
        return $this->render('emails/show.html.twig', [
            'email' => $email,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_emails_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Emails $email
     * @return Response
     */
    public function edit(Request $request, Emails $email): Response
    {
        $form = $this->createForm(EmailsType::class, $email);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_emails_index');
        }

        return $this->render('emails/edit.html.twig', [
            'email' => $email,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_emails_delete", methods={"DELETE"})
     * @param Request $request
     * @param Emails $email
     * @return Response
     */
    public function delete(Request $request, Emails $email): Response
    {
        if ($this->isCsrfTokenValid('delete'.$email->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($email);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_emails_index');
    }

    /**
     * @Route("/send/{id}", name="admin_emails_send")
     * @param Request $request
     * @param EmailManager $emailManager
     * @param Emails $emails
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function send(Request $request,EmailManager $emailManager,  Emails $emails)
    {
        $emailManager->send($emails);
        return  $this->redirectToRoute('admin_emails_index');
    }
}
