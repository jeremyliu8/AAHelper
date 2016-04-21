<?php
	/* 
	 * This file is just used to hash strings that we already know.
	 * The main function of this file was to populate the database with passwords
	 * that we knew, but wanted to hash to keep it secure.
	 */

	$password = hash('SHA512', "drsamrocks");
	echo $password;

?>