<?php
echo 'hola';
echo '<pre>';
var_dump($_GET);
echo '<pre>';
var_dump($_POST);
echo '<pre>';
var_dump($_REQUEST);

setcookie('cookieName','cookieValue');

echo '<pre>';
var_dump($_COOKIE);
echo '<pre>';
session_start ();
var_dump($_SESSION);
