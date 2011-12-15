<?php
	require_once('app/lib/markdown.php');
	//require_once('app/scripts/functions.php');
	require_once('app/classes/PageDoc.php');
	
	
	$content_dir='pages';
	//get the id of the current page from the apache PATH_INFO environment variable
	$curr_page = $_SERVER['PATH_INFO'];
	$classes=array();
	
	
	//work out which page, index or subdir index we want
	if(!strlen($curr_page)){
		$curr_page = '/index';
		$classes[]= 'home';
	}elseif(is_dir($content_dir.$curr_page)){
		$curr_page = $curr_page.'/index';
	}elseif(substr($curr_page,-1)=="/"){
		//last attempt - if there is a trailing slash remove it
		$curr_page = substr($curr_page,0,-1);
	}
	
	
	
	//give preference to php files so I can do custom stuff - otherwise load a markdown content file. Finally 404 it. 
	//use php for multiple content areas from different sources (paritals)
	//use markdown for a single article page
	
	if(file_exists($content_dir.$curr_page.'.php')){
		include_once($content_dir.$curr_page.'.php');
	}elseif(file_exists($content_dir.$curr_page.'.md')){
		$doc = new PageDoc();
		$doc->parse_content_file($content_dir.$curr_page.'.md');
		//add some class selectors for making custom styles per page
		$doc->set_css_classes(implode(" ",array_merge($classes,explode('/',$curr_page))));
		//note, no checking going on here - file might not exist!
		include('templates/'.$doc->get_template());
	}else{
		//404
		header("Status: 404 Not Found"); 
		$doc = new PageDoc();
		$doc->parse_content_file($content_dir.'/404.md');
		$doc->set_css_classes(implode(" ",array_merge($classes,explode('/',$curr_page))));
		include('templates/'.$doc->get_template());
	}