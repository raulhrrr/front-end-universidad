<?php

function redirect($filename, $queryParams = "")
{
    if (!headers_sent())
        header('Location: ' . $filename . $queryParams);
    else {
        echo '<script type="text/javascript">';
        echo 'window.location.href = \'' . $filename . $queryParams . '\';';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0; url=\'' . $filename . '\'" />';
        echo '</noscript>';
    }
    exit();
}

function showAlert($message)
{
    echo '<script type="text/javascript">';
    echo 'alert(\'' . $message . '\')';
    echo '</script>';
}

function initSession()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}
