<?php

/**
 * MQNAutoRecordTools
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */

/**
 *
 */
class MQNAutoRecordTools {

    /**
     *
     * @param string $shortFieldName
     * @return string
     */
    public static function shortFieldNameToFieldName($shortFieldName) {
        new String($shortFieldName);
        $fieldName = '';
        $n = (int) strlen($shortFieldName);

        for ($i = 0; $i < $n; ++$i) {
            $c = (string) substr($shortFieldName, $i, 1);
            $lc = (string) strtolower($c);

            if (($c == $lc) || !$i) {
                $fieldName .= $lc;
            } else {
                $fieldName .= '_' . $lc;
            }
        }

        return $fieldName;
    }

}

?>
