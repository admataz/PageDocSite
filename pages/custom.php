<?php
/**
* A custom PHP page that overrides the default Markdown to template pattern
*/
$metadata = '
Author: Adam Davis  
Date: 1 December 2011  
Title: A custom PHP page that overrides the MarkDown pattern.


';


//Create an instance of the PageDoc object
$doc = new PageDoc();

//add some class selectors for making custom styles per page
$doc->set_css_classes('custom-php');

//note, no checking going on here - file might not exist! but you can set a custom template (default is 'page')
$doc->set_template('page');

//you can also set a custom template for the inner content area (default is 'article')
$doc->set_content_template('custom_article_with_partials');

//set the metadata from the text string above
$doc->set_metadata($metadata);

//partials can be embedded into the custom template by identifier
$doc->parse_content_file('pages/partials/partial1.md','partial1',FALSE);
$doc->parse_content_file('pages/partials/partial2.md','partial2',FALSE);

//include the template which handles the output to the browser
include('templates/'.$doc->get_template());
?>

