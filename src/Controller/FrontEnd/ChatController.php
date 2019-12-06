<?php


namespace App\Controller\FrontEnd;

use App\Services\SocketChatHandler;
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
     * @var SocketChatHandler
     */
    private $chat;

    /**
     * @Route("/", name="app_chat_index", methods={"GET"})
     */
    public function index(SocketChatHandler $chat)
    {
        $this->chat = $chat;

        $this->chat->instance();
        $this->chat->run();

        return $this->render("chat/layout.html.twig", [
            "threads" => ["", "", "", ""],
        ]);
    }
    /**
     * @Route("/new", name="app_chat_new", methods={"POST"})
     */
    public function new()
    {
        return true;
    }

    /**
     * @Route("/delete", name="app_chat_delete",methods={"DELETE"})
     */
    public function delete()
    {
        return true;
    }

    /**
     * @Route("/talk", name="app_chat_talk", methods={"POST"})
     */
    public function talk(){

    }
}