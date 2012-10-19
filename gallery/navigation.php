<?php
$root = dirname(getcwd()).'/photos/';
$_POST['dir'] = urldecode($_POST['dir']);

if(file_exists($root.$_POST['dir'])) {
	$files = scandir($root.$_POST['dir']);
	natcasesort($files);
	echo('<ul class="jqueryFileTree" style="display: none;">');
	foreach($files as $file) {
		if(substr($file, 0, 1)=="." || !is_dir($root.$_POST['dir'].$file))  continue;
		echo('<li class="directory collapsed"><a href="#" rel="'.htmlentities($_POST['dir'].$file).'/">'.preg_replace(array('/^([0-9]){2}\_/', '/\_/'), array('', ' '), htmlentities($file)).'</a></li>');
	}
	echo('</ul>');	
}
?>
