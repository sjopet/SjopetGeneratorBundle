<?php
/**
 * (c) Sjopet Internetdiensten
 *
 * @author Sjoerd Peters <speters@sjopet.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sjopet\Bundle\GeneratorBundle\Model;

class BundleMetadata
{
    /** @var string $name */
    protected $name;

    /** @var string $namespace */
    protected $namespace;

    /** @var string $path */
    protected $path;

    /** @var string $vendor */
    protected $vendor;

    /** @var string $directory */
    protected $directory;

    /** @var string $configType */
    protected $configType;

    /** @var string $alias */
    protected $alias;

    /** @var array $files */
    protected $files;

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $vendor
     */
    public function setVendor($vendor)
    {
        $this->vendor = $vendor;
    }

    /**
     * @return string
     */
    public function getVendor()
    {
        return $this->vendor;
    }

    /**
     * @param string $directory
     */
    public function setDirectory($directory)
    {
        $this->directory = $directory;
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }

    /**
     * @param string $configType
     */
    public function setConfigType($configType)
    {
        $this->configType = $configType;
    }

    /**
     * @return string
     */
    public function getConfigType()
    {
        return $this->configType;
    }

    /**
     * @param string $alias
     */
    public function setAlias($alias)
    {
        $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * @param array $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @param string $file
     */
    public function addFile($file)
    {
        $this->files[] = $file;
    }

    /**
     * @return array
     */
    public function getFiles()
    {
        return $this->files;
    }
}
