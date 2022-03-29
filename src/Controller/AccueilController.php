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
        //? Gourmandises 
        #[Route('/Gourmandises', name: 'gourmandises', methods: ['GET'])]
        public function Gourmandise(ProduitRepository $produitRepository): Response
        {
            $macaron = 1;
            $chocolat = 2;
            $confiserie = 3;

            return $this->render('gourmandises/index.html.twig', [
                'controller_macaron' => 'Macarons',
                'controller_chocolat' => 'Chocolats',
                'controller_confiserie' => 'Confiseries',
                'macarons' => $produitRepository->findMacaron($macaron),
                'chocolats' => $produitRepository->findChocolat($chocolat),
                'confiseries' => $produitRepository->findConfiserie($confiserie)
            ]);
        }

        //? Produits 
        #[Route('/Produits', name: 'produits', methods: ['GET'])]
        public function Produits(ProduitRepository $produitRepository): Response
        {
            $boulangerie = 4;
            $signature = 5;
            $grandsClassique = 6;

            return $this->render('produits/index.html.twig', [
                'controller_boulangerie' => 'Boulangeries',
                'controller_signature' => 'Signatures',
                'controller_grandsClassique' => 'Grands Classiques',
                'boulangeries' => $produitRepository->findBoulangerie($boulangerie),
                'signatures' => $produitRepository->findSignatures($signature),
                'grandsClassiques' => $produitRepository->findGrandsClassiques($grandsClassique)
            ]);
        }

        //? Traiteurs
        #[Route('/Traiteurs', name: 'traiteurs', methods: ['GET'])]
        public function Traiteurs(ProduitRepository $produitRepository): Response
        {
            $sucre = 7;
            $salee = 8;

            return $this->render('traiteurs/index.html.twig', [
                'controller_recepsucre' => 'Réception Sucrée',
                'controller_recepsalee' => 'Réception Salée',
                'sucres' => $produitRepository->findSucre($sucre),
                'salees' => $produitRepository->findSalee($salee)
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

    //! Page Mentions Légales
    #[Route('/mention_legale', name: 'mention_legale')]
    public function indexMentionLegale(): Response
    {
        return $this->render('mention_legale/index.html.twig');
    }
}
