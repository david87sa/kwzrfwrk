<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Kweizar\StoreBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * Description of MainComponentRepository
 *
 * @author david
 */
class MainComponentRepository extends EntityRepository
{
    public function retreiveHerarchy()
    {
        $query = $this->getEntityManager()
            ->createQuery(
                    'Select c,s from KweizarStoreBundle:MainComponent c
                    join c.sections s');

        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }
    }
}
