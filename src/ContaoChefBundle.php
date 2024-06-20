<?php

declare(strict_types=1);


namespace FourAngles\ChefBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ContaoChefBundle extends Bundle
{

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }

}
