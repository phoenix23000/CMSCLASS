<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomepageController extends AbstractController {

    /**
     * @Route("/")
     */
    public function index() {
        return $this->render('homepage/index.html.twig', ['mainNavHome'=>true, 'title'=>'Accueil']);
    }

}