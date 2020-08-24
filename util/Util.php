<?php

namespace app\util;

class Util {
    public static function checkValue($value)
    {
        return isset($value)?$value:0;
    }
    public static function cleanValueForFilter($value)
    {
        $value = trim($value);
        $value =  strtolower($value);
        $value = self::tirarAcentos($value);
        return $value;
    }
    
    public static function tirarAcentos($string){
        return preg_replace(array("/(�|�|�|�|�)/","/(�|�|�|�|�)/","/(�|�|�|�)/","/(�|�|�|�)/","/(�|�|�|�)/","/(�|�|�|�)/","/(�|�|�|�|�)/","/(�|�|�|�|�)/","/(�|�|�|�)/","/(�|�|�|�)/","/(�)/","/(�)/"),explode(" ","a A e E i I o O u U n N"),$string);
    }
    
    public static function ajustaNomeLogin($string){
        $string = explode(" ", trim($string));
        return $string[0];
    }
}