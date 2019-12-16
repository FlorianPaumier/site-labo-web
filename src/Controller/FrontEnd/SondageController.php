<?php


namespace App\Controller\FrontEnd;


use App\Entity\Sondage;
use App\Entity\SondageAnswer;
use App\Entity\SondageQuestion;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RulesController
 * @package App\Controller\FrontEnd
 * @Route("/sondage")
 */
class SondageController extends AbstractController
{
    /**
     * @Route("/", name="app_sondage_index")
     */
    public function index(){
        /** @var User $user */
        $user = $this->getUser();
        return $this->render("frontend/sondage/index.html.twig", [
            "sondagesOngoing" => $this->getDoctrine()->getRepository(Sondage::class)->findAnswerableByAssociations($user, $user->getAssociations()),
            "sondagesOver" => $this->getDoctrine()->getRepository(Sondage::class)->findAnsweredByAssociations($user, $user->getAssociations()),
        ]);
    }

    /**
     * @Route("/answer", name="app_sondage_answer")
     */
    public function answer(Request $request, EntityManagerInterface $em){
        $body = json_decode($request->getContent());
        dump($body);
        $sondageQuestion = $em->getRepository(SondageQuestion::class)->find($body->question);
        $answer = (new SondageAnswer())
            ->setSondage($sondageQuestion)
            ->setUser($this->getUser())
        ;

        $em->persist($answer);
        $em->flush();
        return new Response("Ok", 201);
    }
}