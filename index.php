<?php
header('Content-Type: text/html; charset=utf-8');

// Direct access protection 
define('TESTFORRGRANT',TRUE);

// Config
require_once 'config.php';

// functions
require_once 'functions.php';

// Controller
require_once CONTROLLER;
