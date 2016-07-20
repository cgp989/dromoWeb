<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of testCommand
 *
 * @author CRISTIANGILBERTO
 */

namespace Dromo\Bundle\ProcedimientosBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManager;

class cargarProgramacionesEnDiaCommand extends ContainerAwareCommand {
   protected function configure()
    {
        $this
            ->setName('cronjob:cargarProgramacionesEnDia')
            ->setDescription('Esta tarea va a buscar en la base de datos las promociones que esten'
                    . ' programadas para la fecha actual y va a cargar las mismas en la tabla'
                    . ' programacionEnDia')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $repositoryPr = $em->getRepository('AppBundle:Programacion');
        $repositoryPrED = $em->getRepository('AppBundle:ProgramacionEnDia');
       
        $programaciones = $repositoryPr->getProgramacionesEnDia(); //obtenego todas las porgramacion que estan en dia
        $repositoryPrED->eliminarProgramacionesEnDia(); //elimino todas las programacion en dia de al tabla programacionEnDia
        $result = $repositoryPrED->insertProgramaciones($programaciones);
                
        $output->writeln($result);
    }
}
