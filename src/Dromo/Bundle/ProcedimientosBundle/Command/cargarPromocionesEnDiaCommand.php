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

class cargarPromocionesEnDiaCommand extends ContainerAwareCommand {
   protected function configure()
    {
        $this
            ->setName('cronjob:cargarPromocionesEnDia')
            ->setDescription('Esta tarea va a buscar en la base de datos las promociones que esten'
                    . ' programadas para la fecha actual y va a cargar las mismas en la tabla'
                    . ' programacionEnDia')
            /*->addArgument(
                'name',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
            ->addOption(
                'yell',
                null,
                InputOption::VALUE_NONE,
                'If set, the task will yell in uppercase letters'
            )*/
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /*$name = $input->getArgument('name');
        if ($name) {
            $text = 'Hello '.$name;
        } else {
            $text = 'Hello';
        }

        if ($input->getOption('yell')) {
            $text = strtoupper($text);
        }*/
        
        //get entity manager for queries
        /* @var $em EntityManager */
         $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $repository = $em->getRepository('AppBundle:Promocion');
        $all = $repository->findAll();

        $output->writeln($all);
    }
}
