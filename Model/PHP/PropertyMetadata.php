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

class PropertyMetadata
{
    /** @var string $comment */
    protected $comment;

    /** @var string $name */
    protected $name;

    /** @var string $accessModifier */
    protected $accessModifier;

    /** @var string $type */
    protected $type;

    /** @var array $annotations */
    protected $annotations;

    /** @var boolean $isCollection */
    protected $isCollection = false;

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
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
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
     * @return string
     */
    public function getGetterName()
    {
        return 'get'.ucfirst($this->name);
    }

    /**
     * @return string
     */
    public function getSetterName()
    {
        return 'set'.ucfirst($this->name);
    }

    /**
     * @param boolean $isCollection
     */
    public function setIsCollection($isCollection)
    {
        $this->isCollection = $isCollection;
    }

    /**
     * @return boolean
     */
    public function isCollection()
    {
        return $this->isCollection;
    }
}
