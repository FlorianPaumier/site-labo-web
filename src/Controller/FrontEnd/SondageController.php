<?php


namespace App\Controller\FrontEnd;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
        return $this->render("rules/index.html.twig");
    }

    public function answer(){
        return $this->render("rules/index.html.twig");
    }
}