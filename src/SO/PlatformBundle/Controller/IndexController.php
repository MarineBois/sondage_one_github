<?php

namespace SO\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class IndexController extends Controller
{
    public function indexAction()
    {
        return $this->render('@SOPlatform/Index/index.html.twig');
    }

    public function headernavAction()
    {
        return $this->render('@SOPlatform/Index/headernav.html.twig');
    }

    public function footernavAction()
    {
        return $this->render('@SOPlatform/Index/footernav.html.twig');
    }


}
