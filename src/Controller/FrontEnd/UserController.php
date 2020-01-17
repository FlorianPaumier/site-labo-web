<?php

namespace App\Controller\FrontEnd;

use App\Entity\Association;
use App\Entity\User;
use App\Form\ForgotPasswordType;
use App\Form\ResetPasswordType;
use App\Form\UserType;
use App\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{
    /**
     * @Route("/me", name="me", methods={"GET"})
     * @IsGranted("ROLE_USER")
     */
    public function me(): Response
    {
        $user = $this->getUser();
        return $this->render('Frontend/user/profile.html.twig', [
            'user' => $user,
        ]);
    }

    public function subscribe(){

    }

    /**
     * @param Request $request
     * @Route("/unsubscribe", name="app_user_unsubscribe")
     */
    public function unsubscribe(Request $request)
    {
        return "OK";
    }

    /**
     * @Route("/reset_password", name="user_reset_password")
     * @IsGranted("ROLE_USER")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function resetPassword(Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $form = $this->createForm(ResetPasswordType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $oldPassword = $request->request->get('reset_password')["oldPassword"];
            $plainPassword = $request->request->get('reset_password')["plainPassword"];

            if($plainPassword["first"] !== $plainPassword["second"]){
                $form->addError(new FormError('Les deux mots de passe ne sont pas identique'));
            }else{
                // Si l'ancien mot de passe est bon
                if ($passwordEncoder->isPasswordValid($user, $oldPassword)) {
                    $newEncodedPassword = $passwordEncoder->encodePassword($user, $plainPassword["first"]);
                    $user->setPassword($newEncodedPassword);

                    $em->persist($user);
                    $em->flush();

                    $this->addFlash('notice', 'Votre mot de passe à bien été changé !');

                    return $this->redirectToRoute('me');
                } else {
                    $form->addError(new FormError('Ancien mot de passe incorrect'));
                }
            }
        }

        return $this->render('Frontend/user/password.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @param Request $request
     * @Route("/forgot-password")
     */
    public function forgotPassword(Request $request)
    {
        $form = $this->createForm(ForgotPasswordType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

        }

        return $this->render('Frontend/user/password.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->remove("point");
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('me');
        }

        return $this->render('Frontend/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

}
