<?php

namespace Sjopet\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

use Sjopet\Bundle\GeneratorBundle\Model\BundleMetadata;
use Sjopet\Bundle\GeneratorBundle\Form\Type\BundleType;

class BundleController extends Controller
{
    /**
     * @Route("/bundle", name="sjopet_generate_bundle")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/bundle/new", name="sjopet_generate_bundle_new")
     * @Template()
     */
    public function createAction()
    {
        $bmd = new BundleMetadata();
        $form = $this->createForm(new BundleType(), $bmd);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {

            $form->bind($request);

            if ($form->isValid()) {
                $bmd = $form->getData();

            }
        }
        return array('form' => $form->createView());
    }

    /**
     * @Route("/bundle/list", name="sjopet_generate_bundle_list")
     * @Template()
     */
    public function listAction()
    {
        $bundles = $this->listBundles();
        return array('bundles' => $bundles);
    }

    /**
     * @Route("/bundle/edit/{name}", name="sjopet_generate_bundle_edit")
     * @Template()
     */
    public function editAction($name)
    {
        $bundle = $kernel = $this->container->get('kernel')->getBundle($name);
        $files = $this->getBundleFiles($bundle);
        return array(
            'bundle' => $bundle,
            'files' => $files,
        );
    }

    /**
     * @Route("/bundle/edit/{name}", name="sjopet_generate_bundle_code_style")
     * @Template()
     */
    public function checkCodeStyleAction($name)
    {

    }

    protected function listBundles()
    {
        $kernel = $this->container->get('kernel');
        $bundles = $kernel->getBundles();
        return $bundles;
    }

    protected function getBundleFiles($bundle)
    {
        $finder = new Finder();
        $finder->files()->in($bundle->getPath());
        $files = array();
        foreach ($finder as $file) {
            $files[] = array(
                'localPath' => $file->getRelativePathname(),
                'localUrlPath' => urlencode($file->getRelativePathname()),
            );
        }
        sort($files);
        return $files;
    }

    protected function getBundleEntities($bundle)
    {
        if (!$dir = realpath($bundle->getPath().'/Entity')) {
            return;
        }

        $finder = new Finder();
        $finder->files()->in($bundle->getPath().'/Entity');
        foreach ($finder as $file) {
            $class = $bundle->getName().":".$file->getBasename('.php');
            echo "Entity - ".$class;
            echo '<br />';
        }
    }

    protected function getBundleControllers($path)
    {
        $finder = new Finder();
        $finder->files()->in($path);
        foreach ($finder as $file) {
            echo "file: ".$file->getRealPath();
            echo '<br />';
        }
    }
}
