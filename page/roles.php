<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!function_exists('isAdmin')) {
    function isAdmin() {
        return isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] === 'ADMIN';
    }
}

if (!function_exists('isBoutiquier')) {
    function isBoutiquier() {
        return isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] === 'BOUTIQUIER';
    }
}

if (!function_exists('isClient')) {
    function isClient() {
        return isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] === 'CLIENT';
    }
}

if (!function_exists('redirectToLogin')) {
    function redirectToLogin() {
        header('Location: ../views/connexion.php');
        exit;
    }
}

if (!function_exists('checkAdmin')) {
    function checkAdmin() {
        if (!isAdmin()) {
            redirectToLogin();
        }
    }
}

if (!function_exists('checkBoutiquier')) {
    function checkBoutiquier() {
        if (!isBoutiquier()) {
            redirectToLogin();
        }
    }
}

if (!function_exists('checkClient')) {
    function checkClient() {
        if (!isClient()) {
            redirectToLogin();
        }
    }
}
?>
