<?php

namespace Sjopet\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

use Sjopet\Bundle\GeneratorBundle\Command\Validators;

class DocController extends Controller
{
    /**
     * @Route("/doc/{bundle}", name="sjopet_generate_docs")
     * @Template()
     */
    public function indexAction($bundle)
    {
        die('generate doc for bundle');
    }
}
