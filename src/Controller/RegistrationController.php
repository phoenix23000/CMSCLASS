<?php
namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController {
    
    /**
     * 
     * @Route("/inscription", name="inscription")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder) {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
            //on active par défaut
            $user->setIsActive(true);
            $user->addRole("ROLE_USER");
            //date de creation
            $user->setCreatedAt(new \DateTime(('@'.strtotime('now'))));
            $user->setLastconnect(new \DateTime(('@'.strtotime('now'))));



            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            return $this->redirectToRoute('login');
            // dump($_SERVER['REMOTE_ADDR']);
            
        }

        return $this->render('registration/register.html.twig',
        [
            'form' => $form->createView(),
            'mainNavRegistration' => true, 
            'title' => 'Inscription',

        ]);
    }

}