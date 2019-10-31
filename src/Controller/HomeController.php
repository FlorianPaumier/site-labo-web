<?php
namespace App\Controller;

use App\Entity\Cours;
use App\Entity\Sondage;
use App\Entity\SondageAnswer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home(EntityManagerInterface $em)
    {
        dump($em->getRepository(SondageAnswer::class)->findCount());
        return $this->render("base.html.twig", [
            "sondages" => $em->getRepository(Sondage::class)->findAll(),
            "cours" => $em->getRepository(Cours::class)->findOrderByDate(),
            "answers" => $em->getRepository(SondageAnswer::class)->findByUser($this->getUser()),
            "participation" => $em->getRepository(SondageAnswer::class)->findCount(),
        ]);
    }
}