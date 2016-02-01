<?php

namespace Dromo\Procedimientos\Command;

require_once '../../vendor/autoload.php';
 
use Dromo\Procedimientos\Command\cargarPromocionesEnDiaCommand;
use Symfony\Component\Console\Application;
 
$application = new Application();
$application->add(new cargarPromocionesEnDiaCommand());
$application->start(); //lanza el proceso en background
