<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    //! Page Accueil
    #[Route('/', name: 'accueil')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'Accueil',
        ]);
    }

    //! Page Des Produits
    #[Route('/Gourmandises', name: 'gourmandises', methods: ['GET'])]
    public function boulangerie(ProduitRepository $produitRepository): Response
    {
        $macaron = 2;
        $chocolat = 3;
        $confiserie = 4;

        return $this->render('gourmandises/index.html.twig', [
            'controller_macaron' => 'Macarons',
            'controller_chocolat' => 'Chocolats',
            'controller_confiserie' => 'Confiseries',
            'macarons' => $produitRepository->findMacaron($macaron),
            'chocolats' => $produitRepository->findChocolat($chocolat),
            'confiseries' => $produitRepository->findConfiserie($confiserie)
        ]);
    }

    //! Page Contact 
    #[Route('/contact', name: 'contact')]
    public function Contact(): Response
    {
        return $this->render('contact/index.html.twig', [
            'controller_name' => 'Contact',
        ]);
    }

    //! Page Profil
    #[Route('/profil', name: 'profil')]
    public function indexProfile(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'Ton Profil',
        ]);
    }
}
