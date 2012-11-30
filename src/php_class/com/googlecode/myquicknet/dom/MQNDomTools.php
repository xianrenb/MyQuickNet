<?php

/**
 * MQNDomTools
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\dom;

/**
 *
 */
class MQNDomTools {

    /**
     *
     * @var array|null
     */
    private $numericEntityArray;

    /**
     *
     * @param array $config 
     */
    public function __construct(array $config = array()) {
        $this->resetNumericEntityArray();
    }

    /**
     *
     * @param string $html
     * @return string 
     */
    public function convertNamedEntityToNumericEntity($html) {
        new \String($html);
        $numericEntityArray = $this->numericEntityArray;

        $callback = function (array $matches) use ($numericEntityArray) {
                    $namedEntity = (string) $matches[0];

                    if (array_key_exists($namedEntity, $numericEntityArray)) {
                        $numericEntity = (string) $numericEntityArray[$namedEntity];
                    } else {
                        $numericEntity = '&#160;';
                    }

                    return $numericEntity;
                };

        $html = (string) preg_replace_callback('/&[A-Za-z][0-9A-Za-z]+;/', $callback, $html);
        return $html;
    }

    /**
     * 
     */
    public function resetNumericEntityArray() {
        $this->numericEntityArray = array();
        $translationTable = get_html_translation_table(HTML_ENTITIES);

        if (version_compare(PHP_VERSION, '5.4.0') >= 0) {
            foreach ($translationTable as $key => $value) {
                $numericEntity = (string) mb_encode_numericentity($key, array(0x0, 0xffff, 0, 0xffff), 'UTF-8');
                $this->numericEntityArray[$value] = (string) $numericEntity;
            }
        } else {
            foreach ($translationTable as $key => $value) {
                $numericEntity = (string) mb_encode_numericentity($key, array(0x0, 0xffff, 0, 0xffff), 'HTML-ENTITIES');
                $this->numericEntityArray[$value] = (string) $numericEntity;
            }
        }
    }

    /**
     *
     * @param string $key
     * @param string $value 
     */
    public function setNumericEntityArray($key, $value) {
        new \String($key);
        new \String($value);
        $this->numericEntityArray[$key] = (string) $value;
    }

}

?>
