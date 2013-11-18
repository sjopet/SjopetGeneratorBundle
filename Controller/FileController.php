<?php

namespace Sjopet\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

use Sjopet\Bundle\GeneratorBundle\Command\Validators;

class FileController extends Controller
{
    /**
     * @Route("/file/create", name="sjopet_generate_file_create")
     * @Template()
     */
    public function createAction()
    {
        die('creating file');
    }

    /**
     * @Route("/file/edit/{bundle}/{file}", name="sjopet_generate_file_edit")
     * @Template()
     */
    public function editAction($bundle, $file)
    {

    }
}
