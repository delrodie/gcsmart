<?php

namespace AppBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\Tools\Pagination\Paginator;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * AgentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AgentRepository extends \Doctrine\ORM\EntityRepository
{

  /**
    * Liste des agents ordonnés et paginés
    *
    * @param int $page Le numéro de la page
    * @param int $nbMaxParPage Nombre maximum de bnéficiaire par page
    *
    * @throws InvalidArgumentException
    * @throws NotFoundHttpException
    *
    * @return Paginator
    *
    * Author: Delrodie AMOIKON
    * Date: 26/03/2017
    * Since: v1.0
    */
    public function getMosaique($page, $nbMaxParPage)
    {
      $em = $this->getEntityManager();

        if (!is_numeric($page)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $page est incorrecte (valeur : ' . $page . ').'
            );
        }

        if ($page < 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas');
        }

        if (!is_numeric($nbMaxParPage)) {
            throw new InvalidArgumentException(
                'La valeur de l\'argument $nbMaxParPage est incorrecte (valeur : ' . $nbMaxParPage . ').'
            );
        }

        $qb = $em->createQuery('
            SELECT a
            FROM AppBundle:Agent a
            ORDER BY a.nom ASC
        ')
        ;

        $premierResultat = ($page - 1) * $nbMaxParPage;
        $qb->setFirstResult($premierResultat)->setMaxResults($nbMaxParPage);
        $paginator = new Paginator($qb);

        if ( ($paginator->count() <= $premierResultat) && $page != 1) {
            throw new NotFoundHttpException('La page demandée n\'existe pas.'); // page 404, sauf pour la première page
        }

        return $paginator;
    }

    /**
   * Calcule du nombre d'agents enregistrés
   *
   * Author: Delrodie AMOIKON
   * Date: 26/03/2017
   */
   public function getNombreAgent()
   {
       $qb = $this->createQueryBuilder('a')
           ->select('count(a.id)')
       ;

       $query = $qb->getQuery();

       $recup =  $query->getSingleScalarResult();

       return $recup;
   }

   /**
     * Calcule du nombre des agents du service
     *
     * @author Delrodie AMOIKON
     * Date: 27/03/2017
     */
    public function getNombreAgentParService($id){
        $qb = $this->createQueryBuilder('a')
                ->select('count(a.id)')
                ->andWhere('a.service = :id')
                ->setParameter('id', $id)
                ;
        $query = $qb->getQuery();

        $recup =  $query->getSingleScalarResult();

        return $recup;
    }

    /**
      * Calcule du nombre des agents du grade
      *
      * @author Delrodie AMOIKON
      * Date: 27/03/2017
      */
     public function getNombreAgentParGrade($id){
         $qb = $this->createQueryBuilder('a')
                 ->select('count(a.id)')
                 ->andWhere('a.grade = :id')
                 ->setParameter('id', $id)
                 ;
         $query = $qb->getQuery();

         $recup =  $query->getSingleScalarResult();

         return $recup;
     }

     /**
       * Calcule du nombre des agents de l'echelon
       *
       * @author Delrodie AMOIKON
       * Date: 27/03/2017
       */
      public function getNombreAgentParEchelon($id){
          $qb = $this->createQueryBuilder('a')
                  ->select('count(a.id)')
                  ->andWhere('a.echelon = :id')
                  ->setParameter('id', $id)
                  ;
          $query = $qb->getQuery();

          $recup =  $query->getSingleScalarResult();

          return $recup;
      }

      /**
        * CRecherche de l'agent
        *
        * @author Delrodie AMOIKON
        * Date: 27/03/2017
        */
       public function getAgentByMatriculeEtPass($matricule, $pass){
         $em = $this->getEntityManager();
      $qb = $em->createQuery('
          SELECT a
          FROM AppBundle:Agent a
          WHERE a.matricule = :mat
          AND a.datepass = :pass
      ')
        ->setParameter('mat', $matricule)
        ->setParameter('pass', $pass)
      ;
      try {
          $result = $qb->getSingleResult();

          return $result;

      } catch (NoResultException $e) {
          return $e;
      }
       }
}
