<?php
$DS = DIRECTORY_SEPARATOR;
require_once __DIR__ . $DS . 'lib' . $DS . 'File.php';
require_once File::build_path(['controller', 'routeur.php'])
?>


<!---HTML--->
<?php
$CSS = [
    'view/css/header.css',
    'view/css/style.css',
];
$JS = [];
$LIBRAIRIES = [];
require File::build_path(['view', 'html', 'html_start.php']);
require File::build_path(['view', 'html', 'header.php']);
require File::build_path(['view', 'html', 'html_end.php']);

?>
