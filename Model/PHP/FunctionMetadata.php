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

class FunctionMetadata
{
    /** @var string $comment */
    protected $comment;

    /** @var string $name */
    protected $name;

    /** @var string $accessModifier */
    protected $accessModifier;

    /** @var array $annotations */
    protected $annotations;

    /** @var PropertyMetadata[] $parameters */
    protected $parameters;

    /** @var PropertyMetadata $parameters */
    protected $return;

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

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
     * @param string $accessModifier
     */
    public function setAccessModifier($accessModifier)
    {
        $this->accessModifier = $accessModifier;
    }

    /**
     * @return string
     */
    public function getAccessModifier()
    {
        return $this->accessModifier;
    }

    /**
     * @param array $annotations
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
     * @param PropertyMetadata[] $parameters
     */
    public function setParameters($parameters)
    {
        $this->parameters = $parameters;
    }

    /**
     * @param PropertyMetadata $parameter
     */
    public function addParameter(PropertyMetadata $parameter)
    {
        $this->parameters[] = $parameter;
    }

    /**
     * @return PropertyMetadata[]
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @param PropertyMetadata $return
     */
    public function setReturn(PropertyMetadata $return)
    {
        $this->return = $return;
    }

    /**
     * @return PropertyMetadata
     */
    public function getReturn()
    {
        return $this->return;
    }
}
