<?php

include dirname(__FILE__)."/../bootstrap/unit.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'test', true);


$t = new lime_test(1, new lime_output_color());


######################################################
# Prepare
######################################################

//prepare for test
$srcTestDir = '/tmp/tv/src';
$destTestDir = '/tmp/tv/dest';

//create the files
if(file_exists($srcTestDir)){
	delTree($srcTestDir);
}

if(file_exists($destTestDir)){
	delTree($destTestDir);
}


mkdir($srcTestDir,0777,true);
mkdir($destTestDir,0777,true);

//copy all the files to the src dir
$files=glob(sfConfig::get('sf_data_dir')."/test/regex/*");

foreach($files as $f){
	copy($f,$srcTestDir."/".basename($f));
}

#################### start Tests ##########################


$regex = new TransmissionRegex(
								array(
									"/How\.I\.Met\.Your\.Mother\.S05E\d{2}([\.\w]+)?\.HDTV(-BDS)?\.XviD(-(NoTV|2HD|XII|FQM))\.\[VTV\]\.avi/"));

$tm = new TransmissionMover($srcTestDir, $destTestDir, $regex);

$tm->run();

