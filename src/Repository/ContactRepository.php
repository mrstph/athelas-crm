<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Contact;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Contact>
 *
 * @method Contact|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contact|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contact[]    findAll()
 * @method Contact[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contact::class);
    }

    public function save(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Contact $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function getFiveLastContactsAdded()
    {
        return $this->createQueryBuilder('c')
            ->orderBy('c.created_at', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult()
        ;
    }

    // public function findAllContactsThatAreNotUsers()
    // {
        // $conn = $this->getEntityManager()->getConnection();

        // return $this->convertResult(
        //     $conn
        //         ->prepare("select * from contacts as c WHERE id NOT IN (select contact_id from users)")
        //         ->executeQuery()
        //         ->fetchAllAssociative()
        // );

        // $qb = $this->createQueryBuilder('c');
        
        // $qb->where($qb->expr()->notIn('c.id', 
        //     $this->getEntityManager()->createQueryBuilder()
        //         ->select('u.contact')
        //         ->from('App\Entity\User', 'u')
        //         ->getDQL()
        // ));
        
        // return $qb->getQuery()->getResult();
    // }

    //
    // public function convertResult(array $results)
    // {
    //     if (empty($results)){
    //         return;
    //     }

    //     $contacts = [];

    //     foreach ($results as $res) {
    //         $contact = new Contact();

    //         //miss setID & company due to being foreign key
    //         $contact->setFirstname($res['firstname']);
    //         $contact->setLastname($res['lastname']);
    //         $contact->setEmail($res['email']);
    //         $contact->setPhone($res['phone']);
    //         $contact->setAddress($res['zip_code']);
    //         $contact->setCity($res['city']);
    //         $contact->setCountry($res['country']);
    //         $contact->setJobPosition($res['job_position']);

    //         array_push($contacts, $contact);

    //         return $contacts;
    //     }
    // }

//    /**
//     * @return Contact[] Returns an array of Contact objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Contact
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
