<?php

namespace LSB\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class LSBUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
