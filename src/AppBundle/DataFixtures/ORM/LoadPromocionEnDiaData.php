<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoadDireccionData
 *
 * @author CRISTIANGILBERTO
 */
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\PromocionEnDia;

class LoadPromocionEnDiaData extends AbstractFixture implements OrderedFixtureInterface{
    public function load(ObjectManager $manager) {
    }
    
    public function getOrder(){
        return 3; 
    }
}
