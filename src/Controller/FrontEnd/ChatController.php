<?php


namespace App\Controller\FrontEnd;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ChatController
 * @package App\Controller\FrontEnd
 * @Route("/chat")
 */
class ChatController extends AbstractController
{

    /**
     * @Route("/", name="app_chat_index")
     */
    public function index()
    {
        return $this->render(":chat:layout.html.twig");
    }
    /**
     * @Route("/new", name="app_chat_new")
     */
    public function new()
    {

    }

    /**
     * @Route("/delete", name="app_chat_delete")
     */
    public function delete()
    {

    }

    /**
     * @Route("/talk", name="app_chat_talk")
     */
    public function talk(){

    }
}