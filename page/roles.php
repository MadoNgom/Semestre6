<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function isAdmin() {
    return isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] === 'ADMIN';
}

function isBoutiquier() {
    return isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] === 'BOUTIQUIER';
}

function isClient() {
    return isset($_SESSION['User']['profile']) && $_SESSION['User']['profile'] === 'CLIENT';
}

function redirectToLogin() {
    header('Location: ../views/connexion.php');
    exit;
}

function checkAdmin() {
    if (!isAdmin()) {
        redirectToLogin();
    }
}

function checkBoutiquier() {
    if (!isBoutiquier()) {
        redirectToLogin();
    }
}

function checkClient() {
    if (!isClient()) {
        redirectToLogin();
    }
}
?>
