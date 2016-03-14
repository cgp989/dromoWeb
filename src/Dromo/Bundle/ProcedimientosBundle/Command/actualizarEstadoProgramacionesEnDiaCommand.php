<?php
/**
 * Description of actualizarEstadoProgramacionesEnDiaCommand
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

class actualizarEstadoProgramacionesEnDiaCommand extends ContainerAwareCommand {
    protected function configure()
    {
        $this
            ->setName('cronjob:actualizarEstadoProgramacionesEnDia')
            ->setDescription('Esta tarea va a recorrer la tabla ProgramacionEnDia y verificando '
                    . 'si esta en vigencia o no, actualizando el estado de las mismas')
        ;
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        $repositoryPrED = $em->getRepository('AppBundle:ProgramacionEnDia');
        $arrayResult = $repositoryPrED->actualizarVigenciasProgramaciones();
        $output->writeln(print_r($arrayResult));
    }
}
