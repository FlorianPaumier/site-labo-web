<?php


namespace App\Controller\FrontEnd;

use App\Entity\Association;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\FrontEnd
 * @Route("/dashboard")
 */
class DashboardController extends AbstractController
{
    /**
     * @Route("/", name="app_dashboard_index")
     */
    public function index(EntityManagerInterface $em){
        /** @var User $user */
        $user = $this->getUser();

        return $this->render("dashboard/dashboard.html.twig", [
            "user" => $user,
            "associations" => $user->getAssociations(),
        ]);
    }

}