<?php


function getLocalIp()
{
    return getHostByName(getHostName());
}
