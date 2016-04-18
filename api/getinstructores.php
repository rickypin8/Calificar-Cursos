<?php

//allow access to API
	header('Access-Control-Allow-Origin: *');
	//use files
	require_once('classes/catalogs.php');
	require_once('classes/curso.php');
	require_once('classes/instructores.php');
	//start json
	$json = '{ "status" : 0, "instructores" : [';
	//read makes
	$first = true;
	foreach(Catalogs::get_instructores() as $ins)
	{
		if($first) $first = false; else $json .= ',';
		$json .= '{
					"id" : '.$ins->get_id().',
					"name" : "'.$ins->get_name().'",
          "img" : "'.$ins->get_img().'",
					"curso":{';
            $curso=new Curso($ins->get_id_curso());
            $json .='"id":'.$curso->get_id().',
            "name":"'.$curso->get_name().'",
            "img":"'.$curso->get_img().'"}';
	}
	//end json
	$json .= '}]}';
	//display json
	echo $json;
?>
