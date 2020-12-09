<?php

$CSS = [
        'view/css/header2.css',
    'view/css/style4.css',
];
$JS = [];
$LIBRAIRIES = [];
	
	require_once File::build_path(['view', 'html', 'html_start.php']);
	require File::build_path(['view', 'html', 'header.php']);
	?>
	<div class="main_container">
	<?php
		if(isset($erreur)){
			if($erreur != ""){
				require File::build_path(['view', $controller, "error.php"]);
			}
		}
		require File::build_path(['view', $controller, "$page.php"]);
	?>
	</div>
	<?php
	require File::build_path(['view', 'html', 'html_end.php']);
?>