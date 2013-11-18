<?php

namespace Sjopet\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

use Sjopet\Bundle\GeneratorBundle\Command\Validators;

class TestController extends Controller
{
    /**
     * @Route("/tests/{bundle}", name="sjopet_generate_tests")
     * @Template()
     */
    public function indexAction($bundle)
    {
        die('generate test for bundle');
    }
}
