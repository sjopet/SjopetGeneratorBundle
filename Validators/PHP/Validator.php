<?php
/*
 * (c) Sjopet Internetdiensten
 *
 * Sjoerd Peters <speters@sjopet.net>
 * 7-12-12
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sjopet\Bundle\GeneratorBundle\Validators\PHP;

use Sjopet\Bundle\GeneratorBundle\Validators\Validator as BaseValidator;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\ClassMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\PropertyMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\FunctionMetadata;

class Validator extends BaseValidator
{
    private $primitives = array(
        "int" => "integer",
        "integer" => "integer",
        "long" => "integer",
        "byte" => "integer",
        "short" => "integer",
        "negativeInteger" => "integer",
        "nonNegativeInteger" => "integer",
        "nonPositiveInteger" => "integer",
        "positiveInteger" => "integer",
        "unsignedByte" => "integer",
        "unsignedInt" => "integer",
        "unsignedLong" => "integer",
        "unsignedShort" => "integer",

        "float" => "double",
        "double" => "double",
        "decimal" => "double",

        "string" => "string",
        "token" => "string",
        "normalizedString" => "string",
        "hexBinary" => "string",

        "boolean" => "boolean",
    );

    public function validateClassName($className)
    {
        $validClassName = self::validateClassNamingConvention($className);
        return $validClassName;
    }

    public function validateClassNamingConvention($name)
    {
        $name = $this->stripName($name);
        $name[0] = strtoupper($name[0]);
        $name = $this->toCamelCase($name);

        if (in_array(strtolower($name), self::getReservedWords())) {
            throw new \RuntimeException("Cannot declare Class or Function using PHP reserved word '" . $name . "'");
        }
        return $name;
    }

    public function validateFunction(FunctionMetadata $function)
    {
        $name = $function->getName();
        $name = $this->stripName($name);
        $name = $this->toCamelCase($name);
        $function->setName($name);

        foreach ($function->getParameters() as $parameter) {
            $this->validateVariable($parameter);
        }

        if ($return = $function->getReturn()) {
            $this->validateVariable($return);
        }
        return $function;
    }

    public function validateType(PropertyMetadata $variable)
    {
        $type = $variable->getType();

        if (substr($type, -2) == "[]") {
            $variable->setIsCollection(true);
            $type = substr($type, 0, -2);
        }

        $lowerType = strtolower($type);

        if ($this->isPrimitiveType($lowerType)) {
            $validType = $this->primitives[$lowerType];
        } else {
            $validType = self::validateClassNamingConvention($type);
        }

        $variable->setType($validType);
        return $variable;
    }

    public function isPrimitiveType($type)
    {
        if (array_key_exists($type, $this->primitives)) {
            return true;
        }
        return false;
    }

    public function validateVariable(PropertyMetadata $variable)
    {
        $variable->setName($this->stripName($variable->getName()));
        return $this->validateType($variable);
    }

    public function validateClass(ClassMetadata $class)
    {
        $class->setClassName($this->validateClassName($class->getClassName()));
        $class->setExtend($this->validateClassName($class->getExtend()));

        foreach ($class->getImplements() as $implements) {
            $this->validateClassName($implements);
        }

        foreach ($class->getProperties() as $property) {
            $this->validateVariable($property);
        }

        foreach ($class->getFunctions() as $function) {
            $this->validateFunction($function);
        }
    }
}
