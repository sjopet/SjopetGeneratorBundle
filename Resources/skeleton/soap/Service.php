<?php
/*
 * This file was generated by the SjopetSoapClientGeneratorBundle.
 *
 * Sjoerd Peters <speters@sjopet.net>
 * 23-02-2012
 *
 * For more information please visit:
 * https://bitbucket.org/sjopet/sf2bundle-soap-client-generator
 */

namespace {{ namespace }}\Service;

use {{ namespace }}\Service\ParameterInterface;

{% for func in functions %}
use {{ namespace }}\Service\Parameters\{{ func.parameterClass }};
{% endfor %}

class {{ class }} extends \SoapClient
{
    private $validator;
    private static $classmap = array(
    {% for xml, cls in classes %}
        "{{ xml }}" => "{{ cls }}",
    {% endfor %}

    );

    /**
     * @param string $wsdl
     * @param \Symfony\Component\Validator\Validator $validator
     */
    public function __construct($wsdl, $validator)
    {
        $this->validator = $validator;
        $options = array();

        foreach(self::$classmap as $wsdlClassName => $phpClassName) {
            if(!isset($options['classmap'][$wsdlClassName])) {
                $options['classmap'][$wsdlClassName] = "{{ namespace }}\Model\\".$phpClassName;
            }
        }

        parent::__construct($wsdl, $options);
    }

    /**
     * @param \{{ namespace }}\Service\ParameterInterface $parameterObject
     * @return array
     * @throws \InvalidArgumentException
     */
    public function validateParameters(ParameterInterface $parameterObject)
    {
        $errors = $this->validator->validate($parameterObject);

        if (count($errors) > 0) {
            throw new \InvalidArgumentException(print_r($errors, true));
        }
        return $parameterObject->getArguments();
    }

{% for func in functions %}
    /**
     * @param \{{ namespace }}\Service\Parameters\{{ func.parameterClass }} {{ func.parameterObject }}
    {% for param in func.parameters -%}
      * - param {{ param.type }} {{ param.name }}
    {% endfor -%}
      *
     * @return {% if func.return.custom %}\{{ namespace }}\Model\{% endif %}{{ func.return.type }}
     * @throws \InvalidArgumentException
    */
    public function {{ func.name }}({{ func.parameterClass }} {{ func.parameterObject }})
    {
        $args = $this->validateParameters({{ func.parameterObject }});
        {{ func.return.name }} = $this->__soapCall("{{ func.xmlName }}", $args);
        return {{ func.return.name }};
    }

{% endfor %}


}
