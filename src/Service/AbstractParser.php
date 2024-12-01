<?php

namespace Bigtree\InfoPlus\Service;

abstract class AbstractParser
{
    /**
     * @param \DOMElement $element
     * @param string $nodeName
     * @return string
     */
    public function getSubNodeValue(\DOMElement $node, $subnodeName)
    {
        if ($node->hasChildNodes()) {
            if ($children = $node->getElementsByTagName($subnodeName)) {
                if ($children->length > 0) {
                    return $children->item(0)->nodeValue;
                }
            }
        }
    }

    /**
     *
     * @param \DOMElement $node
     * @param string $subnodeName
     * @return \DOMElement
     */
    public function getSubNode(\DOMElement $element, $subnodeName)
    {
        if ($element->hasChildNodes()) {
            if ($children = $element->getElementsByTagName($subnodeName)) {
                if ($children->length > 0) {
                    return $children->item(0);
                }
            }
        }
    }

    /**
     * @param \DOMElement $element
     * @param string $nodeName
     * @return \DOMElement
     */
    public function getChildNodeByName(\DOMElement $element, $nodeName)
    {
        if ($element->hasChildNodes()) {
            $nodeNameWithoutNs = $nodeName;
            if (strpos($nodeName, ':') !== false) {
                $nodeNameWithoutNs = explode(':', $nodeNameWithoutNs)[1];
            }

            foreach ($element->childNodes as $child) {
                if ($child->nodeType == XML_ELEMENT_NODE) {
                    if ($child->nodeName == $nodeName) {
                        return $child;
                    }
                    if ($nodeNameWithoutNs) {
                        if ($child->nodeName == $nodeNameWithoutNs) {
                            return $child;
                        }
                        if (strpos($child->nodeName, ':') !== false) {
                            $childNodeNameWithoutNs = explode(':', $child->nodeName)[1];
                            if ($childNodeNameWithoutNs == $nodeNameWithoutNs) {
                                return $child;
                            }
                        }
                    }
                }
            }
        }
    }

    /**
     * @param \DOMElement $element
     * @param string $nodeName
     * @return \DOMElement[]
     */
    public function getChildNodesByName(\DOMElement $element, $nodeName)
    {
        $childNodes = [];
        if ($element->hasChildNodes()) {

            $nodeNameWithoutNs = $nodeName;
            if (strpos($nodeName, ':') !== false) {
                $nodeNameWithoutNs = explode(':', $nodeNameWithoutNs)[1];
            }

            foreach ($element->childNodes as $child) {
                if ($child->nodeType == XML_ELEMENT_NODE) {
                    if ($child->nodeName == $nodeName) {
                        $childNodes[] = $child;
                    } else if ($nodeNameWithoutNs) {
                        if ($child->nodeName == $nodeNameWithoutNs) {
                            $childNodes[] = $child;
                        } else if (strpos($child->nodeName, ':') !== false) {
                            $childNodeNameWithoutNs = explode(':', $child->nodeName)[1];
                            if ($childNodeNameWithoutNs == $nodeNameWithoutNs) {
                                $childNodes[] = $child;
                            }
                        }
                    }
                }
            }
        }
        return $childNodes;
    }

    /**
     * @param \DOMElement $element
     * @param string $nodeName
     * @return string
     */
    public function getChildNodeValueByName(\DOMElement $element, $nodeName)
    {
        $child = $this->getChildNodeByName($element, $nodeName);
        if ($child) {
            return $child->nodeValue;
        }
    }
}
