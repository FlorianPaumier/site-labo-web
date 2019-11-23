<?php


namespace App\Controller\BackEnd;


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
     * @param Request $request
     * @return Response
     */
    public function dashboard(Request $request){
        return $this->render("dashboard/dashboard.html.twig");
    }
}