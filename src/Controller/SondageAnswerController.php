<?php

namespace App\Controller;

use App\Entity\SondageAnswer;
use App\Form\SondageAnswerType;
use App\Repository\SondageAnswerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sondage/answer")
 */
class SondageAnswerController extends AbstractController
{
    /**
     * @Route("/", name="sondage_answer_index", methods={"GET"})
     */
    public function index(SondageAnswerRepository $sondageAnswerRepository): Response
    {
        return $this->render('sondage_answer/index.html.twig', [
            'sondage_answers' => $sondageAnswerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sondage_answer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $sondageAnswer = new SondageAnswer();
        $form = $this->createForm(SondageAnswerType::class, $sondageAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sondageAnswer);
            $entityManager->flush();

            return $this->redirectToRoute('sondage_answer_index');
        }

        return $this->render('sondage_answer/new.html.twig', [
            'sondage_answer' => $sondageAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sondage_answer_show", methods={"GET"})
     */
    public function show(SondageAnswer $sondageAnswer): Response
    {
        return $this->render('sondage_answer/show.html.twig', [
            'sondage_answer' => $sondageAnswer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sondage_answer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, SondageAnswer $sondageAnswer): Response
    {
        $form = $this->createForm(SondageAnswerType::class, $sondageAnswer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_answer_index');
        }

        return $this->render('sondage_answer/edit.html.twig', [
            'sondage_answer' => $sondageAnswer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sondage_answer_delete", methods={"DELETE"})
     */
    public function delete(Request $request, SondageAnswer $sondageAnswer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sondageAnswer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sondageAnswer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sondage_answer_index');
    }
}
