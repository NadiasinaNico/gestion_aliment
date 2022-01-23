<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliment")
     */
    public function index(AlimentRepository $aliment_repository): Response
    {
        $aliments = $aliment_repository->findAll();
        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
        ]);
    }
     /**
     * @Route("/afficherParCalorie/{calorie}", name="afficherParCalorie")
     */
    public function afficherParCalorie(AlimentRepository $aliment_repository, $calorie): Response
    {
        $aliments = $aliment_repository->getParCalorie($calorie);
        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
            
        ]);
    }
     /**
     * @Route("/afficherParGlucide/glucide/{glucide}", name="afficherParGlucide")
     */
    public function afficherParGlucide(AlimentRepository $aliment_repository, $glucide): Response
    {
        $aliments = $aliment_repository->getParGlucide($glucide);
        return $this->render('aliment/index.html.twig', [
            'aliments' => $aliments,
        ]);
    }
}
