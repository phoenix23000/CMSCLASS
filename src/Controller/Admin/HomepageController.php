<?php
namespace App\Controller\Admin;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/** @Route("/admin") */
class HomepageController extends AbstractController {

    /**
    * @Route("/") 
    */
    public function index() {
        return $this->render('admin/index.html.twig', ['mainNavAdmin' => true, 'title' => 'Espace Admin']);
    }

    

}