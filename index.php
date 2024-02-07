<?php
require 'core/Routing.php';
require 'core/db-connection.php';

$r = new Routing();

/* routing to pages by GET */
/* all POST request use directly from $_POST[ANY] */

// login page
$r->addRout('/', 'auth/login.php');
//logout page
$r->addRout('/sign-out', 'auth/login.php');
// home page
$r->addRout('/home', 'views/home.php');

// orders pages


// call the routing function to view page
$r->route($r->getUrl());