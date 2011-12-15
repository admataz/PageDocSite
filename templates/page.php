<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title><?php echo addslashes($doc->metadata['Title'][1]); ?></title>	
	<meta name="description" content="<?php echo addslashes($doc->metadata['Description']); ?>" />
	<meta name="keywords" content="<?php echo addslashes($doc->metadata['Keywords']); ?>" />
	<meta name="author" content="<?php echo addslashes($doc->metadata['Author']); ?>" />	
</head>
<body class="<?php echo $doc->css_classes ?>">

<?php
		include 'templates/'.$doc->get_content_template();		
?>

</body>
</html>