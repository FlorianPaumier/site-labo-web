<?php

namespace App\Controller\BackEnd;

use App\Entity\Rules;
use App\Form\RulesType;
use App\Repository\RulesRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/rules")
 * @IsGranted("ROLE_ADMIN")
 */
class RulesController extends AbstractController
{
    /**
     * @Route("/", name="rules_index", methods={"GET"})
     */
    public function index(RulesRepository $rulesRepository): Response
    {
        return $this->render('rules/index.html.twig', [
            'rules' => $rulesRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="rules_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $rule = new Rules();
        $form = $this->createForm(RulesType::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($rule);
            $entityManager->flush();

            return $this->redirectToRoute('rules_index');
        }

        return $this->render('rules/new.html.twig', [
            'rule' => $rule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rules_show", methods={"GET"})
     */
    public function show(Rules $rule): Response
    {
        return $this->render('rules/show.html.twig', [
            'rule' => $rule,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="rules_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Rules $rule): Response
    {
        $form = $this->createForm(RulesType::class, $rule);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('rules_index');
        }

        return $this->render('rules/edit.html.twig', [
            'rule' => $rule,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="rules_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Rules $rule): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rule->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($rule);
            $entityManager->flush();
        }

        return $this->redirectToRoute('rules_index');
    }
}
