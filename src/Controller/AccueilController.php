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
    #[Route('/presProduit', name: 'presProduit', methods: ['GET'])]
    public function boulangerie(ProduitRepository $produitRepository): Response
    {
        return $this->render('prod/index.html.twig', [
            'controller_name' => 'Produit',
            'produits' => $produitRepository->findAll()
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
}
