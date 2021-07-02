<?php


class SamePart
{
    public static function sameStart(...$strings): string
    {
        $inputs = [];
        foreach ($strings as $string){
            if (mb_check_encoding($string,"UTF-8")){
                $inputs[] = self::utf8Split($string);
            }else{
                $inputs[] = str_split($string,1);
            }
        }
        return self::getSame($inputs);
    }

    public static function sameEnd(...$strings): string
    {
        $inputs = [];
        foreach ($strings as $string){
            if (mb_check_encoding($string,"UTF-8")){
                $inputs[] = array_reverse(self::utf8Split($string));
            }else{
                $inputs[] = array_reverse(str_split($string,1));
            }
        }
        return self::getSame($inputs,true);
    }

    public static function getSame(array $inputs, $resever = false): string
    {
        $results = [];
        $found = true;
        $loop = count($inputs);
        foreach ($inputs[0] as $key => $input) {
            for ($j = 1; $j < $loop; $j++) {
                if ($inputs[$j][$key] !== $input) {
                    $found = false;
                    break;
                }
            }
            if ($found) {
                $results[$key] = $input;
            } else {
                break;
            }
        }
        return implode("", $resever ? array_reverse($results) : $results);
    }

    public static function utf8Split($str, $len = 1)
    {
        $arr = array();
        $strLen = mb_strlen($str, 'UTF-8');
        for ($i = 0; $i < $strLen; $i++)
        {
            $arr[] = mb_substr($str, $i, $len, 'UTF-8');
        }
        return $arr;
    }

}