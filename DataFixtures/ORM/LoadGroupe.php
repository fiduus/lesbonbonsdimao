<?php
// src/fidi/PlatformBundle/DataFixtures/ORM/LoadCategory.php

namespace fidi\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use fidi\PlatBundle\Entity\Groupe;

class LoadGroupe implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Liste des noms de catégorie à ajouter
    $names = array(
      'Anglais',
      'Béré',
      'Châteaubriant',
      'Moquet',
      'Poterie','Pouancé'
    );

    foreach ($names as $name) {
      // On crée la catégorie
      $groupe = new Groupe();
      $groupe->setName($name);

      // On la persiste
      $manager->persist($groupe);
    }

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}