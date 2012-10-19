<?php
$rootDir = dirname(getcwd()).'/photos/';
$_POST['dir'] = urldecode($_POST['dir']);
$currentDir = $rootDir.$_POST['dir'];
$currentThumbDir = $rootDir.'.thumb/'.$_POST['dir'];

if(file_exists($currentDir)) {
		// Check thumbnail folder
	if(!is_dir($currentThumbDir)) mkdir($currentThumbDir, 0755, true);

	$files = scandir($currentDir);
	natcasesort($files);

	echo('<ul class="t">');
	foreach($files as $file) {
		if(!preg_match('/\.JPG$/i', $file)) continue;
			// Generate thumbnail
		if(!file_exists($currentThumbDir.$file)) {
			$cmd = '/usr/bin/gm convert -geometry 150x150 -quality 80 "'.$currentDir.$file.'" "'.$currentThumbDir.$file.'"';
			exec($cmd);
		}

			// Generate title
		$title = pathinfo($file, PATHINFO_FILENAME);

			// Parse thumbnail
		echo('<li>');
		echo('<a rel="lightbox[gallery]" href="photos'.$_POST['dir'].$file.'" title="'.$title.'">');
		echo('<img src="photos/.thumb'.$_POST['dir'].$file.'" />');
		echo('</a></li>');
	}
	echo('</ul>');	
}
?>
