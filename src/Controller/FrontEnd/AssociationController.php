<?php


namespace App\Controller\FrontEnd;


use App\Entity\Association;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RulesController
 * @package App\Controller\FrontEnd
 * @Route("/association")
 */
class AssociationController extends AbstractController
{

    /**
     * @Route("/{id}", name="app_association_show")
     */
    public function show(Association $association){
        return $this->render("association/show.html.twig", [
            "association" => $association,
        ]);
    }
}