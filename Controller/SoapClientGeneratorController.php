<?php

namespace Sjopet\Bundle\GeneratorBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Finder\Finder;

use Sjopet\Bundle\GeneratorBundle\Command\Validators;

class SoapClientGeneratorController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     */
    public function indexAction()
    {
        list($wsdl, $dom) = Validators::validateWsdl('../wsdl/jirasoapservice.wsdl');

        $namespace = 'Acme\JiraSoapClientBundle';
        $bundle = 'JiraSoapClientBundle';
        $dir = '/home/vagrant/vhosts/scg/src/';

        $scg = $this->get('generator.soap.client');
        $classes = $scg->generate($namespace, $bundle, $dir, $dom, $wsdl);

        return array('classes' => $classes);
    }

    /**
     * @Route("/soap/generate", name="sjopet_generate_soap_client")
     * @Template()
     */
    public function generateAction()
    {
        list($wsdl, $dom) = Validators::validateWsdl('../wsdl/jirasoapservice.wsdl');

        $namespace = 'Acme\JiraSoapClientBundle';
        $bundle = 'JiraSoapClientBundle';
        $dir = '/home/vagrant/vhosts/scg/src/';

        $scg = $this->get('generator.soap.client');
        $classes = $scg->generate($namespace, $bundle, $dir, $dom, $wsdl);

        echo "<pre>";
        var_dump($classes);
        echo "</pre>";
        die;

        return array();
    }

    /**
     * @Route("/list/bundles", name="sjopet_list_bundles")
     * @Template()
     */
    public function listBundlesAction()
    {
//        $bundles = $this->container->getParameter('kernel.bundles');
        $kernel = $this->container->get('kernel');
        $bundles = $kernel->getBundles();

//        echo "<pre>";
//        var_dump($bundles);
//        echo "</pre>";
//        die;

        foreach ($bundles as $bundle) {
            echo "searching for entities in bundle: ".$bundle->getName();
            echo '<br />';
            if($entities = $this->getBundleEntities($bundle)){
               echo "<pre>";
               var_dump($entities);
               echo "</pre>";
                echo '<br />';
                echo '<br />';
            }
        }
        die;


        /** @var \Doctrine\Bundle\DoctrineBundle\Registry $repo  */
        $repo  = $this->container->get('doctrine');

        $managers = $repo->getEntityManagerNames();
        foreach ($managers as $managerName) {
            /** @var \Doctrine\ORM\EntityManager $manager */
            $manager = $this->container->get($managerName);
        }




        return array();
    }

    protected function getBundleFiles($path)
    {
        $finder = new Finder();
        $finder->files()->in($path);
        foreach ($finder as $file) {
            echo "file: ".$file->getRealPath();
            echo '<br />';
        }
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
