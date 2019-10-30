<?php
namespace App\Controller;

use App\Entity\Sondage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render("base.html.twig", [
            "sondages" => $this->getDoctrine()->getRepository(Sondage::class)->findAll(),
        ]);
    }
}