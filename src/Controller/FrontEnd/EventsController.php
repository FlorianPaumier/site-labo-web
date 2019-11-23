<?php


namespace App\Controller\FrontEnd;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RulesController
 * @package App\Controller\FrontEnd
 * @Route("/events")
 */
class EventsController extends AbstractController
{

    /**
     * @Route("/", name="app_events_index")
     */
    public function index(){
        return $this->render("rules/index.html.twig");
    }
}