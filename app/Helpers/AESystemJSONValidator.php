<?php

namespace App\Helpers;

class AESystemJSONValidator {

    //Array of indexes that are required in the JSON
    private static $mandatoryArrayIndexes = [
        'is_fluid',
        'size',
        'is_craftable',
        'display_name',
        'fingerprint' => [
            'id',
            'dmg'
        ],
    ];

    //Last error: used for determining what went wrong (outside this class)
    public static $lastError = '';

    public static function validateItemList($ae_system) {
        //Decode JSON string and force it in UTF-8 charset
        $object = json_decode(utf8_encode($ae_system));

        if(!$object) {
            //Translate error integer into understandable error string
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $error = 'NaE';
                    break;
                case JSON_ERROR_DEPTH:
                    $error = 'StackDepth';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $error = 'UnderflowOrMismatch';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $error = 'InvalidControlCharacter';
                    break;
                case JSON_ERROR_SYNTAX:
                    $error = 'MalformedJSON';
                    break;
                case JSON_ERROR_UTF8:
                    $error =  'MalformedTextEncoding';
                    break;
                default:
                    $error = 'UnknownError';
                    break;
            }

            //Report error
            AESystemJSONValidator::$lastError = $error;
            return false;
        }

        //Check validity of all items
        foreach($object as $item) {
            if(!AESystemJSONValidator::checkKeyArray($item, AESystemJSONValidator::$mandatoryArrayIndexes)) return false;
        }

        return true;
    }

    private static function checkKeyArray($haystack, $keys) {
        foreach($keys as $key=>$value) {
            //Check if a subtree needs to be checked
            if(is_array($value)) {
                //Check a subtree
                if(array_key_exists($key, $haystack)) {
                    //Found subtree, now recursively check the subtree and cascade false returns
                    if(!AESystemJSONValidator::checkKeyArray($haystack->$key, $value)) {
                        return false;
                    }
                } else {
                    //Missing the subtree
                    AESystemJSONValidator::$lastError = 'MissingObjectProperty';
                    return false;
                }
            }elseif(!array_key_exists($value, $haystack)) {
                //Missing a sub-element
                AESystemJSONValidator::$lastError = 'MissingProperty';
                return false;
            }
        }

        //Nothing failed: JSON checks out
        return true;
    }
}
