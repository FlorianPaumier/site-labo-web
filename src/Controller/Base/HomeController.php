<?php
namespace App\Controller\Base;

use App\Entity\Association;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function home(EntityManagerInterface $em)
    {
        return $this->render("home.html.twig", [
            "associations" => $em->getRepository(Association::class)->findAll(),
        ]);
    }
}