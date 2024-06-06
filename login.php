<?php
include 'functions.php';
session_start();

if (isset($_POST['login'])) {
  login($_POST);
}
