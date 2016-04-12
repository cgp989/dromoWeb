<?php

namespace Dromo\Bundle\FosUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DromoFosUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
