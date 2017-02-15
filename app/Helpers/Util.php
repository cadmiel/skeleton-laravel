<?php

if (!function_exists('checkIfValueExist')) {
    function checkIfValueExist($object, $value)
    {
        return (isset($object[$value])) ? $object[$value] : '';
    }
}

if (!function_exists('status')) {
    function status()
    {
        return array(1=>'Atvo',0=>'Inativo');
    }
}

