<?php
/*
 * (c) Sjopet Internetdiensten
 *
 * Sjoerd Peters <speters@sjopet.net>
 * 26-11-12
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sjopet\Bundle\GeneratorBundle\Parser;

class WsdlParser
{
    /**
     * @param $wsdl
     * @return \DOMDocument
     * @throws \Exception
     */
    public function parse($wsdl)
    {
        $this->validateWsdl($wsdl);
        $dom = $this->loadWsdl($wsdl);

        try {
            $xsl = new \XSLTProcessor();
            $xslDom = new \DOMDocument();
            $xslDom->load(dirname(__FILE__)."/../Resources/xsl/wsdl2php.xsl");
            $xsl->registerPHPFunctions();
            $xsl->importStyleSheet($xslDom);
            $dom = $xsl->transformToDoc($dom);
            $dom->formatOutput = true;
        } catch (\Exception $e) {
            throw new \Exception("Error interpreting WSDL document (".$e->getMessage().")");
        }
        return $dom;
    }

    /**
     * @param $wsdl
     * @return \DOMDocument
     * @throws \InvalidArgumentException
     */
    public function validateWsdl($wsdl)
    {
        if (!preg_match('/.wsdl$/', $wsdl)) {
            throw new \InvalidArgumentException('Please enter a path to a valid .wsdl file');
        }
        return $this->loadWsdl($wsdl);
    }

    /**
     * @param $wsdl
     * @return \DOMDocument
     * @throws \InvalidArgumentException
     */
    protected function loadWsdl($wsdl)
    {
        try {
            $dom = new \DOMDocument();
            $dom->load($wsdl, LIBXML_DTDLOAD|LIBXML_DTDATTR|LIBXML_NOENT|LIBXML_XINCLUDE);

            $xpath = new \DOMXPath($dom);

            /**
             * wsdl:import
             */
            $query = "//*[local-name()='import' and namespace-uri()='http://schemas.xmlsoap.org/wsdl/']";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $parent = $entry->parentNode;
                $wsdlDoc = new \DOMDocument();
                $wsdlDoc->load($entry->getAttribute("location"), LIBXML_DTDLOAD|LIBXML_DTDATTR|LIBXML_NOENT|LIBXML_XINCLUDE);
                foreach ($wsdlDoc->documentElement->childNodes as $node) {
                    $newNode = $dom->importNode($node, true);
                    $parent->insertBefore($newNode, $entry);
                }
                $parent->removeChild($entry);
            }

            $query = "//*[local-name()='import' and namespace-uri()='http://www.w3.org/2001/XMLSchema']";
            $entries = $xpath->query($query);
            foreach ($entries as $entry) {
                $parent = $entry->parentNode;
                $xsd = new \DOMDocument();
                $result = @$xsd->load(dirname($wsdl) . "/" . $entry->getAttribute("schemaLocation"),
                    LIBXML_DTDLOAD|LIBXML_DTDATTR|LIBXML_NOENT|LIBXML_XINCLUDE);
                if ($result) {
                    foreach ($xsd->documentElement->childNodes as $node) {
                        $newNode = $dom->importNode($node, true);
                        $parent->insertBefore($newNode, $entry);
                    }
                    $parent->removeChild($entry);
                }
            }
        } catch (\Exception $e) {
            throw new \InvalidArgumentException("Error loading WSDL document (".$e->getMessage().")");
        }
        return $dom;
    }
}
