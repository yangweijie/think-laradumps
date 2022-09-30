<?php

namespace think\Laradumps\Support;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

class Dumper
{
    public static function dump($arguments): string
    {
        $varCloner = new VarCloner();

        $dumper = new HtmlDumper();

        $htmlDumper = (string) $dumper->dump($varCloner->cloneVar($arguments), true);
        return self::cut($htmlDumper, '<pre ', '</pre>');
    }

    public static function cut($string, $begin, $end){
        $str = strstr($string ,$begin);
        $str = strstr($str, $end, true). $end;
        return $str;
    }
}