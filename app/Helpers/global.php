<?php


function getLocalIp()
{
    return getHostByName(getHostName());
}

function getUnreadNotificationsCount()
{
    return auth()->check() ? auth()->user()->unreadNotifications()->count() : null;
}
