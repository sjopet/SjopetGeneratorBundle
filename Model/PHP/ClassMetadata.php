<?php
/**
 * (c) Sjopet Internetdiensten
 *
 * @author Sjoerd Peters <speters@sjopet.nl>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sjopet\Bundle\GeneratorBundle\Model\PHP;

use Sjopet\Bundle\GeneratorBundle\Model\PHP\PropertyMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\FunctionMetadata;

class ClassMetadata
{
    /** @var string $comment */
    protected $comment;

    /** @var string $namespace */
    protected $namespace;

    /** @var array $imports */
    protected $imports = array();

    /** @var array $annotations */
    protected $annotations = array();

    /** @var string $className */
    protected $className;

    /** @var string $classAccessModifier */
    protected $classAccessModifier;

    /** @var string $fileName */
    protected $fileName;

    /** @var string $extend */
    protected $extend;

    /** @var array $implements */
    protected $implements = array();

    /** @var array $constants*/
    protected $constants = array();

    /** @var PropertyMetadata[] $properties */
    protected $properties = array();

    /** @var FunctionMetadata[] $functions */
    protected $functions = array();


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
     * @param array $imports
     */
    public function setImports($imports)
    {
        $this->imports = $imports;
    }

    /**
     * @param string $import
     */
    public function addImport($import)
    {
        $this->imports[$import] = $import;
    }

    /**
     * @return array
     */
    public function getImports()
    {
        return $this->imports;
    }

    /**
     * @param array $annotations
     * @return ClassMetadata
     */
    public function setAnnotations($annotations)
    {
        $this->annotations = $annotations;
    }

    /**
     * @return array
     */
    public function getAnnotations()
    {
        return $this->annotations;
    }

    /**
     * @param string $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $classAccessModifier
     * @return ClassMetadata
     */
    public function setClassAccessModifier($classAccessModifier)
    {
        $this->classAccessModifier = $classAccessModifier;
    }

    /**
     * @return string
     */
    public function getClassAccessModifier()
    {
        return $this->classAccessModifier;
    }

    /**
     * @param string $fileName
     * @return ClassMetadata
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }

    /**
     * @return string
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param array $extend
     */
    public function setExtend($extend)
    {
        $this->extend = $extend;
    }

    /**
     * @return string
     */
    public function getExtend()
    {
        return $this->extend;
    }

    /**
     * @param array $implements
     * @return ClassMetadata
     */
    public function setImplements($implements)
    {
        $this->implements = $implements;
    }

    /**
     * @return array
     */
    public function getImplements()
    {
        return $this->implements;
    }

    /**
     * @param array $constants
     * @return ClassMetadata
     */
    public function setConstants($constants)
    {
        $this->constants = $constants;
    }

    /**
     * @return array
     */
    public function getConstants()
    {
        return $this->constants;
    }

    /**
     * @return FunctionMetadata[]
     */
    public function getFunctions()
    {
        return $this->functions;
    }

    /**
     * @param PropertyMetadata[] $properties
     */
    public function setProperties($properties)
    {
        $this->properties = $properties;
    }

    /**
     * @param PropertyMetadata $property
     */
    public function addProperty(PropertyMetadata $property)
    {
        $this->properties[] = $property;
    }

    /**
     * @return PropertyMetadata[]
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param FunctionMetadata[] $functions
     */
    public function setFunctions($functions)
    {
        $this->functions = $functions;
    }

    /**
     * @param FunctionMetadata $function
     */
    public function addFunction(FunctionMetadata $function)
    {
        $this->functions[] = $function;
    }

    /**
     * @return string
     */
    public function getClassPath()
    {
        return "$this->namespace\\$this->className";
    }
}
