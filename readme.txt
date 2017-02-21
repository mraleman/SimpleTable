------------------------------------------------------------------------------
Simple Table CHALLENGE
Author: Marvin Aleman
Date: January 26th, 2017

MySQL Database Dump File included
Change DB Settings in configure.php
view App in action http://nivrama.com/SimpleTable/
------------------------------------------------------------------------------
Simple Table CHALLENGE INSTRUCTIONS

We would like a small web application that touches on:
	-database
	-PHP
	-HTML/CSS
	-JavaScript/jQuery/AJAX.

This app should access a MySQL database table called ‘user’ that has the following columns:
	-user_id
	-name
	-access_count
	-modify_dt

That table should have several rows in it, each with distinct data.

The database should be accessed using an instance of a PHP class that manages the connection and provides methods for accessing the user table.

A PHP class that generates a page containing a tabular form should be written that includes all of the columns from the user table;

it should list all of the rows.

Each row should have a button that, when clicked, uses AJAX to bump the access_count and update the modify_dt of the selected user using the server’s time.
The form should be updated to reflect the current access_count and modify_dt without reloading the page itself.
A page-level PHP script should be written that brings all of these elements together.
CSS should be used for styling; inline styles should be avoided.
This code should not be based on an existing PHP or JS framework (other than jQuery).