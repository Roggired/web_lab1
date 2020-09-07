<?php

const R_VALUES = [1, 1.5, 2, 2.5, 3];

function isValid($x, $y, $r)
{
    if (!is_double($r) || !is_double($y) || !is_double($x)) {
        return false;
    }

    if (!in_array($r, R_VALUES)) {
        return false;
    }

    return true;
}

function isHit($x, $y, $r)
{
    return isYellowZone($x, $y, $r) || isOrangeZone($x, $y, $r) || isGreenZone($x, $y, $r);
}

function isYellowZone($x, $y, $r)
{
    return $x >= - $r && $x <= 0 && $y >= 0 && $y <= $r;
}

function isOrangeZone($x, $y, $r)
{
    return $x >= 0 && $x <= $r && $y >= ($x - $r) && $y <= 0;
}

function isGreenZone($x, $y, $r)
{
    return $x <= 0 && $y <= 0 && sqrt($x ** 2 + $y ** 2) < $r;
}
