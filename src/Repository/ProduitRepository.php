<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Produit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }

    //! Requete Personnelle Pour Les Categories 
        //? Requete Perso Macarons    
        public function findMacaron(int $macaron): array
        {
            // Requete SQL
            $entityManager = $this->getEntityManager();

            // On récupère la catégorie Macarons
            $query = $entityManager->createQuery(
                'SELECT p -- SELECTION DES PRODUITS
                FROM App\Entity\Produit p -- DE LA TABLE PRODUIT
                WHERE p.category = :macaron -- WHERE LA CATEGORIE EST MACARON' 
            )->setParameter('macaron', $macaron); // On passe la valeur de la categorie 

            // On récupère les résultats de la requete
            return $query->getResult();
        }

        //? Requete Perso Chocolats
        public function findChocolat(int $chocolat): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :chocolat'
            )->setParameter('chocolat', $chocolat);

            // returns an array of Product objects
            return $query->getResult();
        }

        //? Requete Perso Confiseries
        public function findConfiserie(int $confiserie): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :confiserie'
            )->setParameter('confiserie', $confiserie);

            // returns an array of Product objects
            return $query->getResult();
        }

        //? Requete Perso Boulangerie 
        public function findBoulangerie(int $boulangerie): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :boulangerie'
            )->setParameter('boulangerie', $boulangerie);

            // returns an array of Product objects
            return $query->getResult();
        }

        //? Requete Perso Les Grands Classiques
        public function findGrandsClassiques(int $grandsClassique): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :grandsClassique'
            )->setParameter('grandsClassique', $grandsClassique);

            // returns an array of Product objects
            return $query->getResult();
        }

        //? Requete Perso Les Signatures 
        public function findSignatures(int $signature): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :signature'
            )->setParameter('signature', $signature);

            // returns an array of Product objects
            return $query->getResult();
        }

        //? Requete Perso Réception Sucrée 
        public function findSucre(int $sucre): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :sucre'
            )->setParameter('sucre', $sucre);

            // returns an array of Product objects
            return $query->getResult();
        }

        //? Requete Perso Réception Salée 
        public function findSalee(int $salee): array
        {
            $entityManager = $this->getEntityManager();

            $query = $entityManager->createQuery(
                'SELECT p
                FROM App\Entity\Produit p
                WHERE p.category = :salee'
            )->setParameter('salee', $salee);

            // returns an array of Product objects
            return $query->getResult();
        }

    // /**
    //  * @return Produit[] Returns an array of Produit objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Produit
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
