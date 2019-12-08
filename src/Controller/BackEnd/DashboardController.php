<?php


namespace App\Controller\BackEnd;


use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DashboardController
 * @package App\Controller\BackEnd
 * @IsGranted("ROLE_ADMIN")
 */
class DashboardController extends AbstractController
{


    /**
     * @Route("/dashboard", name="admin_dashboard")
     * @IsGranted("ROLE_ADMIN")
     * @param Request $request
     * @return Response
     */
    public function dashboard(Request $request){
        /** @var User $user */
        $user = $this->getUser();

        $assoc = $user->getAssociations();
        return $this->render("dashboard/dashboard.html.twig");
    }
}