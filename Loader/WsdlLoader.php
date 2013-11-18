<?php
/*
 * (c) Sjopet Internetdiensten
 *
 * Sjoerd Peters <speters@sjopet.net>
 * 3-12-12
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Sjopet\Bundle\GeneratorBundle\Loader;

use Sjopet\Bundle\GeneratorBundle\Parser\WsdlParser;
use Sjopet\Bundle\GeneratorBundle\Validators\ClassValidator;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\BundleMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\ClassMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\PropertyMetadata;
use Sjopet\Bundle\GeneratorBundle\Model\PHP\FunctionMetadata;

class WsdlLoader
{
    protected $validator;

    public function __construct(ClassValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param $bundleMetaData
     * @param $source
     * @throws \Exception
     */
    public function load(BundleMetadata $bundleMetaData, $source)
    {
        try {
            $parser = new WsdlParser();
            $dom = $parser->parse($source);

            $bmd = new BundleMetadata();
            $this->loadClasses($bmd, $dom);
            $this->loadServices($bmd, $dom);

            $bmd->loadClasses(); // resolve extends and implements classes
            $bundleMetaData->merge($bmd);

        } catch(\Exception $e){
            throw new \Exception("error parsing wsdl document: ".$e->getMessage());
        }
    }

    /**
     * @param BundleMetadata $bmd
     * @param \DOMDocument $dom
     */
    private function loadClasses(BundleMetadata $bmd, $dom)
    {
        /** @var \DOMElement[] $xmlClasses */
        $xmlClasses = $dom->getElementsByTagName("class");
        foreach ($xmlClasses as $xmlClass) {

            $class = new ClassMetadata();
            $class->setNamespace($bmd->getNamespace('Model'));
            $class->setClassName($xmlClass->getAttribute("name"));

            $extends = $xmlClass->getElementsByTagName("extends");
            foreach ($extends as $extend) {
                $class->setExtend($extend->nodeValue);
            }

            /** @var \DOMElement[] $entries */
            $entries = $xmlClass->getElementsByTagName("entry");
            foreach ($entries as $entry) {
                $property = new PropertyMetadata();
                $property->setName($entry->getAttribute("name"));
                $property->setType($entry->getAttribute("type"));
                $class->addProperty($property);
            }
            $this->validator->validateClass($class);
            $bmd->addClass($class);
        }
    }

    /**
     * @param BundleMetadata $bmd
     * @param \DOMDocument $dom
     */
    private function loadServices(BundleMetadata $bmd, $dom)
    {
        /** @var \DOMElement[] $xmlServices */
        $xmlServices = $dom->getElementsByTagName("service");
        foreach ($xmlServices as $xmlService) {

            $service = new ClassMetadata();
            $service->setNamespace($bmd->getNamespace('Service'));
            $service->setClassName($xmlService->getAttribute("name"));

            /** @var \DOMElement[] $xmlFunctions */
            $xmlFunctions = $xmlService->getElementsByTagName("function");
            foreach ($xmlFunctions as $xmlFunction) {

                $function = new FunctionMetadata();
                $function->setName($xmlFunction->getAttribute("name"));

                $xmlParametersList = $xmlFunction->getElementsByTagName("parameters");
                if ($xmlParametersList->length > 0) {
                    /** @var \DOMElement[] $xmlParameters */
                    $xmlParameters = $xmlParametersList->item(0)->getElementsByTagName("entry");
                    foreach ($xmlParameters as $xmlParameter) {
                        $property = new PropertyMetadata();
                        $property->setName($xmlParameter->getAttribute("name"));
                        $property->setType($xmlParameter->getAttribute("type"));
                        $function->addParameter($property);
                    }
                }

                $xmlReturns = $xmlFunction->getElementsByTagName("returns");
                if ($xmlReturns->length > 0) {
                    /** @var \DOMElement[] $xmlReturnList */
                    $xmlReturnList = $xmlReturns->item(0)->getElementsByTagName("entry");
                    if ($xmlReturnList->length > 0) {
                        $xmlReturn = $xmlReturnList->item(0);
                        $return = new PropertyMetadata();
                        $return->setName($xmlReturn->getAttribute("name"));
                        $return->setType($xmlReturn->getAttribute("type"));
                        $function->setReturn($return);
                    }
                }
                $service->addFunction($function);
            }
            $this->validator->validateClass($service);
            $bmd->addClass($service);
        }
    }

}
