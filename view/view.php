<?php

	$CSS = [
    'view/css/header.css',
    'view/css/style.css',
];
$JS = [];
$LIBRAIRIES = [];


	require File::build_path(['view', 'html', 'html_start.php']);
	require File::build_path(['view', 'html', 'header.php']);
	require File::build_path(['view', $controller, "$page.php"]);
	require File::build_path(['view', 'html', 'html_end.php']);

?>