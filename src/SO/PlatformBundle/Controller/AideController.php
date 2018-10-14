<?php

namespace SO\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AideController extends Controller
{
    public function AideAction()
    {
        return $this->render('@SOPlatform/Aide/aide.html.twig');
    }
}    