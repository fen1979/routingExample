# routingExample
Simplest route example on php language without any frameworks or libs to use routing.

In this example for connect and interact with DB i'am use the RED BEAN PHP framework, but this is only my choice, 
this example can be used in any DB or storage place 
how to connect and use DB you need to know by it self, 
read about RBDB here: https://www.redbeanphp.com/index.php?p=/crud
You can improve this code, feel free to use, change, and all what you need :)

SOME SORT OF DESCRIPTION
The structure of the project folders and following the MVC patterns 
are not important, this example is expandable for any structural solutions, 
the example shows a partial implementation of the MVC pattern. 
The main condition for the functionality of the example is 
a single entry point into the project index.php, 
configured for nginx in the server settings, 
for Apache in the .htaccess file.

$_GET[] with some parameters:
When requests are displayed in the address bar and the parameters 
are displayed there, the parameters are used as in a regular get request, 
below is an example of accessing the about us page through <a> button 
indicating the values

on your page :
 - press tis button you go to about page
<a href="/about">About Us</a>

 - press this button about page hase be open in new tab 
<a href="/about" target="_blank">About Us</a>

Get request in file .php
if(isset($_GET["some-name"])){
// do some actions
}

 - for request from form the action need to be empty if your request going
 - to self page scripts
<form action="" method="get">
// some inputs...
</form>

 - else if your request go to another page 
<form action="/about" method="get">
// some inputs...
</form>

the same actions fo form when method equal POST 
$_POST[] with some parameters:

When submitting a form using the post method on the page with the form, 
leave the ACTION="" attribute in the form need to be empty!!
When sending a form to another page with a transition to this page, 
enter the route for this page in the action attribute of the form

<form action="/" method="post">
// here we goin to Login.php
// some inputs...
</form>

 - receiving data from a post request in a login.php script file:
 
 if(isset($_POST["some-name])){
 // do some actions
 
 // redirection to needed page after some actions
 header("Location: /home");
 exit();
 }
 
