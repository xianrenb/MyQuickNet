<?php

/**
 * MQNDom
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class MQNDom {

    /**
     *
     * @var DOMDocument
     */
    private $doc;

    /**
     *
     * @var DOMXPath
     */
    private $xPath;

    /**
     *
     * @param array $config 
     */
    public function __construct(array $config = array()) {
        $this->doc = new DOMDocument();
        $this->doc->formatOutput = true;
        $this->xPath = null;
    }

    /**
     * 
     */
    public function __destruct() {
        $this->xPath = null;
        $this->doc = null;
    }

    /**
     *
     * @param DOMNode $node 
     */
    protected function _removeChildNodes($node) {
        while ($node->firstChild) {
            while ($node->firstChild->firstChild) {
                $this->_removeChildNodes($node->firstChild);
            }

            $node->removeChild($node->firstChild);
        }
    }

    /**
     *
     * @return DOMDocument
     */
    public function getDoc() {
        return $this->doc;
    }

    /**
     *
     * @return DOMXPath|null
     */
    public function getXPath() {
        return $this->xPath;
    }

    /**
     *
     * @param string $filename
     * @param int $options 
     * @return boolean 
     */
    public function load($filename, $options = 0) {
        new String($filename);
        new Int($options);

        if ($this->doc->load($filename, $options)) {
            $this->xPath = new DOMXPath($this->doc);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $source
     * @return boolean 
     */
    public function loadHTML($source) {
        new String($source);

        if ($this->doc->loadHTML($source)) {
            $this->xPath = new DOMXPath($this->doc);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $filename
     * @return boolean 
     */
    public function loadHTMLFile($filename) {
        new String($filename);

        if ($this->doc->loadHTMLFile($filename)) {
            $this->xPath = new DOMXPath($this->doc);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $source
     * @param int $options
     * @return boolean 
     */
    public function loadXML($source, $options = 0) {
        new String($source);
        new Int($options);

        if ($this->doc->loadXML($source, $options)) {
            $this->xPath = new DOMXPath($this->doc);
            return true;
        } else {
            return false;
        }
    }

    /**
     *
     * @param string $query
     * @param string $attrName
     * @param string|null $attrValue
     * @return string|null
     * @throws Exception 
     */
    public function queryAttr($query, $attrName, $attrValue = null) {
        new String($query);
        new String($attrName);

        if ($attrValue === null) {
            $node = $this->xPath->query($query)->item(0);

            if ($node && $node->hasAttributes()) {
                $attr = $node->attributes->getNamedItem($attrName);

                if ($attr && ($attr instanceof DOMAttr)) {
                    $attrValue = (string) $attr->value;
                    return $attrValue;
                } else {
                    return null;
                }
            } else {
                return null;
            }
        } else {
            new String($attrValue);

            foreach ($this->xPath->query($query) as $node) {
                if ($node->hasAttributes()) {
                    $attr = $node->attributes->getNamedItem($attrName);

                    if (!$attr) {
                        $node->appendChild($this->doc->createAttribute($attrName));
                        $attr = $node->attributes->getNamedItem($attrName);
                    }
                } else {
                    $node->appendChild($this->doc->createAttribute($attrName));
                    $attr = $node->attributes->getNamedItem($attrName);
                }

                if ($attr instanceof DOMAttr) {
                    $attr->value = (string) $attrValue;
                    $node->normalize();
                } else {
                    throw new Exception('Node is not DOMAttr.');
                }
            }
        }
    }

    /**
     *
     * @param string $query
     * @param callable $callback
     * @return mixed
     */
    public function queryDo($query, $callback) {
        new String($query);
        $nodes = $this->xPath->query($query);
        return $callback($nodes, $this);
    }

    /**
     *
     * @param string $query
     * @param string|null $text
     * @return string|null
     */
    public function queryText($query, $text = null) {
        new String($query);

        if ($text === null) {
            $node = $this->xPath->query($query)->item(0);

            if ($node) {
                $node->normalize();

                foreach ($node->childNodes as $child) {
                    if ($child instanceof DOMText) {
                        $text = (string) $child->wholeText;
                        return $text;
                    }
                }

                return null;
            } else {
                return null;
            }
        } else {
            new String($text);

            foreach ($this->xPath->query($query) as $node) {
                $this->_removeChildNodes($node);
                $node->appendChild($this->doc->createTextNode($text));
                $node->normalize();
            }
        }
    }

    /**
     *
     * @param string $query
     * @param string|null $value
     * @return string|null
     */
    public function queryVal($query, $value = null) {
        new String($query);

        if ($value !== null) {
            new String($value);
        }

        return $this->queryAttr($query, 'value', $value);
    }

    /**
     *
     * @param string $query
     * @param string|null $xml
     * @return string|null
     */
    public function queryXml($query, $xml = null) {
        new String($query);

        if ($xml === null) {
            $xml = '';
            $node = $this->xPath->query($query)->item(0);

            if ($node) {
                foreach ($node->childNodes as $child) {
                    $xml .= (string) $this->doc->saveXML($child);
                }

                return $xml;
            } else {
                return null;
            }
        } else {
            new String($xml);

            foreach ($this->xPath->query($query) as $node) {
                $this->_removeChildNodes($node);
                $docFrag = $this->doc->createDocumentFragment();
                $docFrag->appendXML($xml);
                $node->appendChild($docFrag);
                $node->normalize();
            }
        }
    }

    /**
     *
     * @param string $filename
     * @param int|null $options
     * @return int|bool
     */
    public function save($filename, $options = null) {
        new String($filename);

        if ($options === null) {
            return $this->doc->save($filename);
        } else {
            new Int($options);
            return $this->doc->save($filename, $options);
        }
    }

    /**
     *
     * @param DOMNode|null $node
     * @return string|bool
     */
    public function saveHTML(DOMNode $node = null) {
        return $this->doc->saveHTML($node);
    }

    /**
     *
     * @param string $filename
     * @return int|bool
     */
    public function saveHTMLFile($filename) {
        new String($filename);
        return $this->doc->saveHTMLFile($filename);
    }

    /**
     *
     * @param DOMNode|null $node
     * @param int|null $options
     * @return string|bool
     */
    public function saveXML(DOMNode $node = null, $options = null) {
        if ($node === null) {
            return $this->doc->saveXML();
        }

        if ($options === null) {
            return $this->doc->saveXML($node);
        } else {
            new Int($options);
            return $this->doc->saveXML($node, $options);
        }
    }

}

?>
