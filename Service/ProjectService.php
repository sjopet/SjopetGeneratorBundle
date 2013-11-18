<?php
/*
 * (c) Sjopet Internetdiensten
 *
 * Sjoerd Peters <speters@sjopet.net>
 * 10-12-12
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sjopet\Bundle\GeneratorBundle\Service;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;

class ProjectService
{
    /** @var ContainerInterface $container */
    protected $container;

    /** @var string $projectDir */
    protected $projectDir;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $kernel = $this->container->get('kernel');
        $this->projectDir = $kernel->locateResource('@SjopetGeneratorBundle/Resources/projects');
    }

    public function getProjects()
    {
;
        $finder = new Finder();
        $finder->files()->in($this->projectDir);

        $files = array();
        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder as $file) {
            $files[] = $file->getBasename();
        }
        echo "<pre>";
        var_dump($files);
        echo "</pre>";
        die;
    }


    public function getProject($project)
    {
        $finder = new Finder();
        $finder->files()->in($this->projectDir)->name($project);

        echo "<pre>";
        var_dump($finder);
        echo "</pre>";
        die;

        $files = array();
        foreach ($finder as $file) {

        }
    }

    public function saveProject($project)
    {
        $finder = new Finder();
        $finder->files()->in($this->projectDir)->name($project);
        if(count($finder)){
            // @todo project exists
        } else {
            $fileName = $this->projectDir.$project.'.'.$project['format'];
            $file = fopen($fileName, 'w');
            fwrite($file, $project);
            fclose($file);
        }
    }
}
