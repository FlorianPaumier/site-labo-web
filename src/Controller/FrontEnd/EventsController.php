<?php


namespace App\Controller\FrontEnd;


use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use JMS\Serializer\Serializer;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function index(EntityManagerInterface $em, SerializerInterface $serializer){

        return $this->render("frontend/events/index.html.twig");
    }

    /**
     * @Route("/show", name="app_event_show")
     * @param EntityManagerInterface $em
     * @param SerializerInterface $serializer
     * @return JsonResponse
     */
    public function show(EntityManagerInterface $em, SerializerInterface $serializer){
        return JsonResponse::fromJsonString(
            $serializer->serialize($em->getRepository(Event::class)->findAllPublished(), "json", SerializationContext::create()->enableMaxDepthChecks())
        );
    }
}