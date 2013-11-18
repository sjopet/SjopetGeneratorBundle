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

class FileMetadata
{
    /** @var string $comment */
    protected $comment;

    /** @var string $name */
    protected $name;

    /** @var string $extension */
    protected $extension;

    /** @var string $directory */
    protected $directory;

    /** @var array $includes */
    protected $includes;

    /** @var array $requires */
    protected $requires;

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
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
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
     * @param array $includes
     */
    public function setIncludes($includes)
    {
        $this->includes = $includes;
    }

    /**
     * @return array
     */
    public function getIncludes()
    {
        return $this->includes;
    }

    /**
     * @param array $requires
     */
    public function setRequires($requires)
    {
        $this->requires = $requires;
    }

    /**
     * @return array
     */
    public function getRequires()
    {
        return $this->requires;
    }
}
