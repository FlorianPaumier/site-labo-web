<?php


namespace App\Controller\FrontEnd;

use App\Entity\Thread;
use App\Services\ConnectionsPool;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ChatController
 * @package App\Controller\FrontEnd
 * @Route("/thread")
 */
class ChatController extends AbstractController
{

    /**
     * @Route("/", name="app_thread_index", methods={"GET"})
     */
    public function index(ConnectionsPool $connectionsPool)
    {
        return $this->render("chat/layout.html.twig", [
            "threads" => ["", "", "", ""],
        ]);
    }
    /**
     * @Route("/new", name="app_thread_new", methods={"POST"})
     */
    public function new()
    {
        $thread = new Thread();
        return $thread;
    }

    /**
     * @Route("/delete/{id}", name="app_thread_delete",methods={"DELETE"})
     */
    public function delete(Thread $thread, EntityManagerInterface $em)
    {
        $em->remove($thread);
        //$em->flush();

        return Response::HTTP_OK;
    }

    /**
     * @Route("/{id}/talk", name="app_thread_talk", methods={"POST"})
     */
    public function talk(Request $request,Thread $thread){

    }

    /**
     * @Route("/connected", name="app_thread_connected", methods={"GET"})
     */
    public function getConnected(){

    }

    /**
     * @Route("/{id}/messages", name="app_thread_get_messages", methods={"GET"})
     */
    public function getMessages(Thread $thread){
        return $thread->getMessages();
    }
}