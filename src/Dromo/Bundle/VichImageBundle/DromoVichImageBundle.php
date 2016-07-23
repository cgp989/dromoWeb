<?php

namespace Dromo\Bundle\VichImageBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DromoVichImageBundle extends Bundle
{
    public function getParent()
    {
        return 'VichUploaderBundle';
    }
}
