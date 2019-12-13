<?php

namespace App\Controller\FrontEnd;

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
     * @Route("/new", name="sondage_answer_new", methods={"POST"})
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
}
