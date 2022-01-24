<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\UtilisateurType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class InscriptionController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request, ManagerRegistry $managerRegistry, UserPasswordEncoderInterface $encoder): Response
    {
        $utilisateurs = new Utilisateur();
        $form = $this->createForm(UtilisateurType::class, $utilisateurs);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $mot_de_pass = $encoder->encodePassword($utilisateurs, $utilisateurs->getPassword());
            $utilisateurs->setPassword($mot_de_pass);
            $em = $managerRegistry->getManager();
            $em->persist($utilisateurs);
            $em->flush();
            return $this->redirectToRoute("aliment");
        }
            return $this->render('inscription/inscription.html.twig', [
            'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/inscription/login", name="connexion")
     */
    public function connexion(AuthenticationUtils $util):Response
    {
        return $this->render('inscription/connexion.html.twig', [
            "lastUserName" => $util->getLastUsername(),
            "error" => $util->getLastAuthenticationError()
        ]);


    }
    /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion()
    {
        

    }
}
