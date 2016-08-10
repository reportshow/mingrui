<?php

function cleanTag($v)
{
    $v = strip_tags($v);
    $v = str_replace("&nbsp;", "", $v);
    return trim($v);

}
function VAL($str)
{
    $str = trim($str);
    if (strpos(json_encode($str), '\u4ebf')) {
        return floatval($str) * 10000;
    }
    return floatval($str);
}

function AllCodes()
{
    //return array('300312' );
    //
    $codes = array();
    //深圳
    for ($i = 1; $i < 999; $i++) {
        $c       = str_pad($i, 6, "0", STR_PAD_LEFT);
        $codes[] = $c;
    }

    //中小板
    for ($i = 2001; $i < 2795; $i++) {
        $codes[] = '00' . $i;
    }

    //上海
    for ($i = 600000; $i < 603822; $i++) {
        $codes[] = $i;
    }

    //创业板
    for ($i = 300000; $i < 300510; $i++) {
        $codes[] = $i;
    }

    return $codes;
}
