<?php 

isset($_SESSION['userBean']) or header("Location: /") and exit();

// your code here 
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>Home Page </title>
 </head>
 <body>
 <h1>Hello dear</h1>
 <h5>your code here </h5>
 <br>
 <a href="/log-out">Log Out Baby</a>
 </body>
 </html>