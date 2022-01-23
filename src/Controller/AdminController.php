<?php

namespace App\Controller;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="administration")
     */
    public function index(AlimentRepository $repository): Response
    {
        $aliment = $repository->findAll();
        return $this->render('admin/admin.html.twig', [
            'aliment' => $aliment,
        ]);
    }
    /**
     * @Route("/creation", name="creation_aliment")
     * @Route("modification/{id}", name="modification_aliment", methods="GET|POST")
     */
    public function modification_aliment(Aliment $aliments = null, Request $request, ManagerRegistry $managerRegistry): Response
    {
        if($aliments == null){
            $aliments = new Aliment();
        }
        $form = $this->createForm(AlimentType::class,$aliments);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $modif = $aliments->getId() !== null;
            $em = $managerRegistry->getManager();
            $em->persist($aliments);
            $em->flush();
            $this->addFlash("success", ($modif) ? "La modification avec success" : "L'ajout d'aliment avec success");
            return $this->redirectToRoute("administration");
        }

        return $this->render('admin/modification_aliment.html.twig', [
            'aliments' => $aliments,
            'form' => $form->createView(),
            'isModif' => $aliments->getId() !== null
        ]);
    }

    /**
     * @Route("/suppression/{id}", name="suppression_aliment", methods="delete")
     */
    public function suppression_aliment(Aliment $aliments, Request $request, ManagerRegistry $managerRegistry)
    {
        if($this->isCsrfTokenValid('SUP'. $aliments->getId(), $request->get('_token'))){
            $em = $managerRegistry->getManager();
            $em->remove($aliments);
            $em->flush();
            $this->addFlash("success", "La suppression avec success");
            return $this->redirectToRoute("administration");
     
        }
    }
}
