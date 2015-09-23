<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\DataFixtures\ORM;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
/**
 * Description of LoadProvinciaData
 *
 * @author CRISTIANGILBERTO
 */
class LoadLocalidadData extends AbstractFixture implements OrderedFixtureInterface{
   
    public function getOrder(){
        return 2; 
    }

    public function load(ObjectManager $manager) {
        $sql = file_get_contents('src/AppBundle/DataFixtures/sqlScripts/insertLocalidades.sql');
        $manager->getConnection()->exec($sql);  // Execute native SQL
        $manager->flush();
    }

}
