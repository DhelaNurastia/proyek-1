<?php

function formatTanggal($value)
{
    $datetime = new DateTime($value);
    return date_format($datetime, "d F Y");
}

function kapital($string)
{
    return ucwords(strtolower($string));
}
