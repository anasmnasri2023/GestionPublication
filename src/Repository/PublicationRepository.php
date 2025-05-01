<?php

namespace App\Repository;

use App\Entity\Publication;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Publication>
 *
 * @method Publication|null find($id, $lockMode = null, $lockVersion = null)
 * @method Publication|null findOneBy(array $criteria, array $orderBy = null)
 * @method Publication[]    findAll()
 * @method Publication[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PublicationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publication::class);
    }

    /**
     * Search publications by a keyword in titre or contenu.
     *
     * @param string $search
     * @return Publication[]
     */
    public function findBySearch(string $search): array
    {
        return $this->createQueryBuilder('p')
            ->where('p.titre LIKE :search')
            ->orWhere('p.contenu LIKE :search')
            ->setParameter('search', '%' . $search . '%')
            ->orderBy('p.datePublication', 'DESC')
            ->getQuery()
            ->getResult();
    }

    // Example of a custom query method
    // public function findRecentPublications(int $limit = 5): array
    // {
    //     return $this->createQueryBuilder('p')
    //         ->orderBy('p.datePublication', 'DESC')
    //         ->setMaxResults($limit)
    //         ->getQuery()
    //         ->getResult();
    // }
}
