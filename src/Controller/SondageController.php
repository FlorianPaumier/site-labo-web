<?php

namespace App\Controller;

use App\Entity\Sondage;
use App\Entity\SondageAnswer;
use App\Entity\Themes;
use App\Form\SondageType;
use App\Repository\SondageRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/sondage")
 */
class SondageController extends AbstractController
{
    /**
     * @Route("/", name="sondage_index", methods={"GET"})
     */
    public function index(SondageRepository $sondageRepository): Response
    {
        return $this->render('sondage/index.html.twig', [
            'sondages' => $sondageRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="sondage_new", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request): Response
    {
        $sondage = new Sondage();
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($sondage);
            $entityManager->flush();

            return $this->redirectToRoute('sondage_index');
        }

        return $this->render('sondage/new.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sondage_show", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function show(Sondage $sondage): Response
    {
        return $this->render('sondage/show.html.twig', [
            'sondage' => $sondage,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="sondage_edit", methods={"GET","POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Sondage $sondage): Response
    {
        $form = $this->createForm(SondageType::class, $sondage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('sondage_index');
        }

        return $this->render('sondage/edit.html.twig', [
            'sondage' => $sondage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="sondage_delete", methods={"DELETE"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, Sondage $sondage): Response
    {
        if ($this->isCsrfTokenValid('delete'.$sondage->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($sondage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('sondage_index');
    }

    /**
     * @Route("/{id}/answer", name="sondage_user_answer", methods={"POST"})
     */
    public function answer(Request $request, Sondage $sondage){
        $data = json_decode(
            $request->getContent(),
            true
        );
        $em = $this->getDoctrine()->getManager();

        $theme = $em->getRepository(Themes::class)->find($data["theme"]);

        $answer = (new SondageAnswer())
            ->setSondage($sondage)
            ->setThemes($theme)
            ->setUser($this->getUser())
        ;

        $em->persist($answer);
        $em->flush();

        return new JsonResponse();
    }
}
