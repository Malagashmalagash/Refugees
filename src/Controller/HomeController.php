<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $message = "Hey oui, c'est possible avec la carte Kiwi";
        $presentation = "Le site est actuellement en construction";

        return $this->render('home/index.html.twig', [
            'message' => $message,
            'presentation' => $presentation,
        ]);
    }
}
