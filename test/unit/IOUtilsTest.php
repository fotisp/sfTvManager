<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include dirname(__FILE__)."/../bootstrap/unit.php";

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'test', true);

//create the file
$folder = sfConfig::get("app_tv_series_folder");

if(!file_exists($folder)){
	mkdir($folder);
}else{
	delTree($folder);
	mkdir($folder);
}

$t = new lime_test(10, new lime_output_color());

$t->info("::createSeriesFolder()");
try{
	IOUtils::createSeriesFolder("one");
	$one = $folder."/one";
	$t->is(file_exists($one) && is_dir($one), true,"Testing series folder has been created");

}catch(sfException $e){
	$t->fail("An exception occurs ".$e);
}

$t->info("::deleteSeriesFolder");
mkdir($folder."/two");
try{
	IOUtils::deleteSeriesFolder("two");
	//make sure the file doesn't exists
	$t->is(!file_exists($folder."/two"),true, "Testing the series folder is removed when empty");

}catch(sfException $e){
	$t->fail("An exception occured ".$e);
}


$t->info("::deleteSeriesFolder");
mkdir($folder."/two");
touch($folder."/two/a");
try{
	IOUtils::deleteSeriesFolder("two");
	//make sure the file doesn't exists
	$t->is(!file_exists($folder."/two"),true, "Testing the series folder is removed when not-empty");


	IOUtils::deleteSeriesFolder("ten");
	$t->comment("Testing whether a non-existant season can be deleted without error");

}catch(sfException $e){
	$t->fail("An exception occured ".$e);
}


$t->info("::renameSeriesFolder()");
mkdir($folder."/three");

try{
	IOUtils::renameSeriesFolder("three", "four");
	$t->is(
		!file_exists($folder."/three")
		&& (
					file_exists($folder."/four") && is_dir($folder."/four")
			),
		true,"Testing that rename worked");

}catch (Exception $e){
	$t->fail("An exception occured ".$e);
}

$seriesName = "one";


$t->info("::createSeasonFolder()");
try{

	IOUtils::createSeasonFolder($seriesName, "01");

	$t->is(
		file_exists($folder."/".$seriesName."/01") &&
		is_dir($folder."/".$seriesName."/01"),
		true,
		"Testing that we can create a season for a series"
	);

}catch (Exception $e){
	$t->fail("An exception occured ".$e);
}


$t->info("::deleteSeasonFolder()");
$seasonFolder = $folder."/five/02";
$t->diag("Creating message ".$seasonFolder);

mkdir($seasonFolder,0777,true);

try{

	IOUtils::deleteSeasonFolder("five", "02");

	//check that the folder doesn't exist
	$t->is(file_exists($folder."/five"), true,"Testing that the series folder wasn't deleted");
	$t->is(!file_exists($folder."/five/02"),true,"Testing that the season folder was deleted when empty");
	
}catch (Exception $e){
	$t->fail("An exception occured ".$e);
}

$seasonFolder = $folder."/six/03";
if(!mkdir($seasonFolder,0777,true)){
	$t->fail("Problem seting up");
}

if(!touch($seasonFolder."/a")){
	$t->fail();
}

try{

	IOUtils::deleteSeasonFolder("six", "03");

	//check that the folder doesn't exist
	$t->is(file_exists($folder."/six"), true,"Testing that the series folder wasn't deleted");
	$t->is(!file_exists($folder."/six/03"),true,"Testing that the season folder was deleted when non-empty");


	IOUtils::deleteSeasonFolder("six", "05");
	$t->comment("Testing whether a non-existant season/series can be deleted without error");


}catch (Exception $e){
	$t->fail("An exception occured ".$e);
}


$t->info("::::renameSeasonFolder()");
if(!mkdir($folder."/seven/eleven",0777,true)){
	$t->fail("Can't set up for rename season test");
}
try{
	IOUtils::renameSeasonFolder("seven", "eleven", "twelve");
	$t->is(
		!file_exists($folder."/seven/eleven") &&
			(file_exists($folder."/seven/twelve") && is_dir($folder."/seven/twelve")),
			true,
			"Testign if season folder was renamed");
}catch(Exception $e){
	$t->fail("Message e");
}








