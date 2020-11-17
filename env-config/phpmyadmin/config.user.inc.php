<?php

$sessionDuration = 60*60*24*7; // 60*60*24*7 = one week
ini_set('session.gc_maxlifetime', $sessionDuration);
$cfg['LoginCookieValidity'] = $sessionDuration;
$cfg['LoginCookieValidity'] = 604800;
$cfg['LoginCookieStore'] = 604800;