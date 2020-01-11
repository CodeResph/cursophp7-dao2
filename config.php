<?php 

spl_autoload_register(function($class_name){

	//informando a localização do arquivo que contem a classe
	$filename = "Class".DIRECTORY_SEPARATOR.$class_name.".php";

	if (file_exists(($filename))) {
		require_once($filename);
	}
});

 ?>