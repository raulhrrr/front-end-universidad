<?php

include_once "php/role.php";

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

function validateUserHomePage($role)
{
    redirect($role == Role::CLIENT->value ? "./suppliers_list.php" : "./product_inventory.php");
}

function validateAuthAndPageOwner($role, $checkAuth = true)
{
    initSession();
    if ($checkAuth && !isset($_SESSION["user_id"])) {
        redirect("./index.php");
    }

    if ($role != Role::SHARED->value && $_SESSION["user_role"] != $role) {
        redirect("./index.php");
    }
}
