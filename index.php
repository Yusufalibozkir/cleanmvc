<?php
	
	/*
	 * V1 haven't got a autoloader yet. :)
	 */

	require('config/execute-config.php');
	require('library/controller.php');
	require('library/view.php');
	require_once 'boot.php';
	
	$boot = new Boot();