<?php

function viewdatetime($date)
{

    try {
        return (strtotime($date) == false) ? '' : (date("m/d/Y H:i", strtotime($date)));
    } catch (\RuntimeException $e) {
        return false;
    }
}

function dbdatetime($date)
{
    try {
        return (strtotime($date) == false) ? NULL : (date("Y-m-d H:i:s", strtotime($date)));
    } catch (\RuntimeException $e) {
        return NULL;
    }
}

function viewdate($date)
{
    try {
        return (strtotime($date) == false) ? '' : (date("m/d/Y", strtotime($date)));
    } catch (\RuntimeException $e) {
        return false;
    }
}


function dbdate($date)
{
    try {
        return (strtotime($date) == false) ? NULL : (date("Y-m-d", strtotime($date)));
    } catch (\RuntimeException $e) {
        return NULL;
    }
}

function viewtime($date)
{
    try {
        return (strtotime($date) == false) ? '' : (date("H:i", strtotime($date)));
    } catch (\RuntimeException $e) {
        return false;
    }
}

function dbtime($date)
{
    try {
        return (strtotime($date) == false) ? '' : (date("H:i:s", strtotime($date)));
    } catch (\RuntimeException $e) {
        return false;
    }
}


function array_urlencode($data)
{
    if (is_array($data)) {
        foreach ($data as $k => $v) $data_temp[urlencode($k)] = array_urlencode($v);
        return $data_temp;
    } else {
        return urlencode($data);
    }
}
