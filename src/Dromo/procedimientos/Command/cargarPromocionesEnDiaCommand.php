<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Dromo\Procedimientos\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Doctrine\ORM\EntityManager;

/**
 * Description of cargarPromocionesEnDia
 *
 * @author CRISTIANGILBERTO
 */
class cargarPromocionesEnDiaCommand extends ContainerAwareCommand{
     protected function configure()
    {
        $this
            ->setName('procedimientos:cargarPromocionesEnDia')
            ->setDescription('este procedimiento carga las promociones que esten en dia')
        ;
    }
 
    protected function execute(InputInterface $input, OutputInterface $output)
    {   
        //get entity manager for queries
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
 
        echo "hola";
    }
}
