<?php


namespace App\Controller\FrontEnd;


use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
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
    public function index(EntityManagerInterface $em){
        return $this->render("frontend/events/index.html.twig", [
            "events" => $em->getRepository(Event::class)->findAllPublished()
        ]);
    }
}