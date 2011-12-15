<?php
	class PageDoc{
		
		var $metadata = array('Title'=>array(),'Author'=>array(),'Date'=>array(),'Description'=>array(),'Keywords'=>array(),'Tags'=>array());
		var $content = array('content'=>'');
		var $content_id = 'content';
		var $css_classes = '';
		var $template = 'page';
		var $content_template = 'article';
			

		function __construct($content_id='content') {
		   $this->content_id = $content_id;   
	   }
	   
		function set_metadata($metadata_str='', $set_metadata=TRUE)
		{
			if(!preg_match('/Title\:\s+(.*)\s?+/i', $metadata_str,$match)){		
				return false;
			}
		
			if($set_metadata){
				foreach($this->metadata as $k=>$v){
					if(preg_match('/'.$k.'\:\s+(.*)\s?+/i', $metadata_str,$match)){
						$this->metadata[$k]=$match;
					}
				}
			}
			return true;
		}
		
		
		function get($id='content')
		{
			return $this->content[$id];
		
		}
		
		function set_content($content='', $content_id='content', $format='md')
		{
			if($format=='md'){
				$this->content[$content_id] = Markdown($content);
			}else{
				$this->content[$content_id] = $content;
			}
		
		}
		
		
		function set_css_classes($selectors='')
		{
			$this->css_classes = $selectors;
		
		}
		
		
		function get_template()
		{
			if(isset($this->metadata['Template'])){
				$this->template = $this->metadata['Template'];
			}
			
			return $this->template.'.php';
		}
		
		
		function set_template($template='page')
		{
			$this->template = $template;
		}
		
		
		
		function set_content_template($name='article')
		{
			$this->content_template = $name;
		}
		
		
		function get_content_template()
		{
			return $this->content_template.'.php';
		
		}
		
		
		
		
		function parse_content_file($path='error-404', $content_id='content', $set_metadata=TRUE)
		{
			//return false if this file doesn't exist - need to send a 404
			if(!file_exists($path)){
				return false;
			}
			$filecontent = file_get_contents($path);
			//check for metadata (which is not part of the markdown syntax)
			$document_array = preg_split('/\r?\n\r?\n/s', $filecontent, 2);	
			$metadata = $this->set_metadata($document_array[0],$set_metadata);
			//multimarkdown syntax guide for adding metadata to markdown - https://github.com/fletcher/MultiMarkdown/wiki/MultiMarkdown-Syntax-Guide
			if(!$metadata){
				//we must have at least a title in the metadata, otherwise, there is no metadata.
				$this->set_content($filecontent,$content_id);
			}else{
				$this->set_content($document_array[1],$content_id);	
			}
			
			
			
		}
		
		
		
		
	}
