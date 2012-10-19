<?php
$rootDir = dirname(getcwd()).'/photos/';
$_POST['dir'] = urldecode($_POST['dir']);
$currentDir = $rootDir.$_POST['dir'];
$currentThumbDir = $currentDir.'.thumbs/';

if(file_exists($currentDir)) {
		// Check thumbnail folder
	if(!is_dir($currentThumbDir)) mkdir($currentThumbDir);

	$files = scandir($currentDir);
	natcasesort($files);
	$files = array_reverse($files);
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
			echo('<img src="photos'.$_POST['dir'].'.thumbs/'.$file.'" />');
			echo('</a></li>');
		}
		echo('</ul>');	
}
?>
