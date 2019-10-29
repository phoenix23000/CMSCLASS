<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MemberController extends AbstractController {

    /**
    * @Route("/member/" , name="member_homepage")
    *@IsGranted("ROLE_USER")
    */
    public function index() {
        return $this->render('member/index.html.twig', ['mainNavMember'=>true, 'title'=>'Espace Membre']);
    }

    /**
     * listingUsers
     * @return mixed 
     * @Route ("/admin/member/listing",name="listingUsers")
     * @IsGranted("ROLE_ADMIN")
     */
    function listingUsers(UserRepository $repo)
    {
        $user = $repo->findAll();
        dump($user);
        
        return $this->render('admin/listingUsers.html.twig', [
            'user' => $user
        ]); 
    }
}
?>