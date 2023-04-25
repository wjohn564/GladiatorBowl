<?php
session_start();

function setSession($name, $value) {
    $_SESSION[$name] = $value;
}

function getSession($name) {
    return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
}

function destroySession() {
    session_destroy();
}
?>
