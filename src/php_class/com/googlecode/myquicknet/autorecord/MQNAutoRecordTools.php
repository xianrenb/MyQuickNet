<?php

/**
 * MQNAutoRecordTools
 * @package MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

namespace com\googlecode\myquicknet\autorecord;

use com\googlecode\myquicknet\scalar\String;

/**
 *
 */
class MQNAutoRecordTools
{
    /**
     *
     * @param  string $shortFieldName
     * @return string
     */
    public static function shortFieldNameToFieldName($shortFieldName)
    {
        new String($shortFieldName);
        $fieldName = '';
        $n = (int) strlen($shortFieldName);

        for ($i = 0; $i < $n; ++$i) {
            $c = (string) substr($shortFieldName, $i, 1);
            $lc = (string) strtolower($c);

            if (($c === $lc) || !$i) {
                $fieldName .= $lc;
            } else {
                $fieldName .= '_' . $lc;
            }
        }

        return $fieldName;
    }

}
