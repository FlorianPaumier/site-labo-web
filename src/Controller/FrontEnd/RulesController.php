<?php


namespace App\Controller\FrontEnd;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RulesController
 * @package App\Controller\FrontEnd
 * @Route("/rules")
 */
class RulesController extends AbstractController
{

    /**
     * @Route("/", name="app_rules_index")
     */
    public function index(){
        return $this->render("rules/index.html.twig");
    }
}