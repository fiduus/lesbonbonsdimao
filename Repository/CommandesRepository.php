<?php

namespace fidi\EcommerceBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Validator\Constraints\DateTime;
/**
 * CommandesRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandesRepository extends EntityRepository
{
    public function byFacture($utilisateur)
    {
        $qb = $this->createQueryBuilder('u')
                ->select('u')
                ->where('u.utilisateur = :utilisateur')
                ->andWhere('u.valider = 1')
                ->andWhere('u.reference != 0')
                ->orderBy('u.id')
                ->setParameter('utilisateur', $utilisateur);
        
        return $qb->getQuery()->getResult();
    }
    
    public function byAdresse($utilisateur)
    {
       /* $query = $em->createQuery("SELECT u.adresse,u.cp FROM UtilisateursAdresses u JOIN u.Commandes c 
         ON u.utilisateur_id = c.utilisateur_id WHERE c.utilisateur = $utilisateur ");
        return $users = $query->getResult();*/
        
        $qb = $this->createQueryBuilder('c')
            ->select('u.adresse,u.cp')
            ->join('c.UtilisateursAdresses,u')
            ->where('c.utilisateur = :utilisateur')
            ->setParameter('utilisateur', $utilisateur);        
        return $qb->getQuery()->getResult();
    }
    
    public function byDate()
    {
        $dateObject = new \DateTime('-1 day');
        $date = $dateObject->format('Y-m-d');                       
        $qb = $this->createQueryBuilder('u')
                ->select('u')                                
                ->where('u.reference != 0')
                ->where('u.valider = :valider' )
                ->andwhere('u.date = :date')               
                ->setParameter('date', $date)
                ->setParameter('valider', true);
                //->setParameter('date', new \DateTime('2017-07-23'), \Doctrine\DBAL\Types\Type::DATETIME);
       // print_r( $date );exit;
        return $qb->getQuery()->getResult();
    }
    
    public function validerCommande($id)
    {
        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('fidiEcommerceBundle:Commandes', 'c')
            ->set('c.valider', '?1')
            ->where('c.id = ?2')
            ->setParameter(1, '1')
            ->setParameter(2, $id);
        $q = $qB->getQuery();
        $q ->execute();
        return $q;
    }
    
    public function invaliderCommande($id)
    {
        $qB = $this->getEntityManager()->createQueryBuilder();
        $qB ->update('fidiEcommerceBundle:Commandes', 'c')
            ->set('c.valider', '?1')
            ->where('c.id = ?2')
            ->setParameter(1, false)
            ->setParameter(2, $id);
        $q = $qB->getQuery();
        $q ->execute();
        return $q;
    }
    
    public function findAll()
    {
        return $this->findBy(array(), array('id' => 'DESC'));
    }
}

