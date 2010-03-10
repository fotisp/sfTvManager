<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class IOUtils{


	/**
	 * This method create a folder following the standards which will we
	 * use to manage our series
	 *
	 * @param <type> $folderName
	 * @return <type> Wether the create operation has been successfull or not
	 */
	public static function createSeriesFolder($folderName){

		//check if the location to create the folder is valid
		$folder = self::checkParentFolder();		
		return self::createOrBreak($folderName,$folder);

	}

	public static function renameSeriesFolder($fromName, $toName){
		$folder = self::checkParentFolder();
		return self::renameFolder($folder, $fromName, $toName);
	}

	public static function deleteSeriesFolder($series){
		$folder = self::checkParentFolder();
		return self::removeFolder($folder,$series);
	}

	

	public static function createSeasonFolder($seriesName, $season){
		$parent = self::checkSeriesFolder($seriesName);
		return self::createOrBreak($season, $parent);
		
	}

	public static function renameSeasonFolder($seriesName, $fromName, $toName){
		
		$folder= self::checkSeriesFolder($seriesName);
		return self::renameFolder($folder, $fromName, $toName);
	}


	public static function deleteSeasonFolder($seriesName, $season){
		$folder =self::checkSeriesFolder($seriesName);
		return self::removeFolder($folder, $season);
	}


	private static function createOrBreak($folder,$parent ="",$message="% couldn't create location"){

		
		$toCreate = ($parent == "" ? "" : ($parent."/")).$folder;

		if(!mkdir($toCreate)){
			throw new sfException(sprintf($message,$toCreate));
		}

		return $toCreate;
		
	}

	private static function checkSeriesFolder($series){

		$parent = self::checkParentFolder();

		if(!$parent){
			throw new sfException(sprintf("There seems to be an deep problem here (%s)",$parent));
		}

		$seriesParent = $parent."/".$series;

		return self::checkFolder($seriesParent);
		
	}

	private static function checkParentFolder(){	
		
		$folder = sfConfig::get("app_tv_series_folder");

		if(!$folder){
			
			throw new sfException("The parameter app_tv_serires_folder is not set.");
		}
		
		return self::checkFolder($folder);
		
	}

	private static function checkFolder($folderName){

		if(!file_exists($folderName) || !is_dir($folderName)){
			throw new sfException($folderName." is not a valid location");
		}

		if(!is_writable($folderName)){
			throw new sfException(sprintf("The folder is not writtable %s",$folderName));
		}

		return $folderName;
		
	}


	private static function delTree($dir) {
    $files = glob( $dir . '*', GLOB_MARK );
    foreach( $files as $file ){
        if( substr( $file, -1 ) == '/' )
          delTree( $file );
        else
            unlink( $file );
    }

    if (is_dir($dir)) rmdir( $dir );
	}

	private static function renameFolder($parent, $fromName, $toName){

		if($fromName == $toName){
			return true;
		}

		if(trim($fromName) == "" || trim($toName) == ""){
			throw new sfException(sprintf("The names cannot be empty (%s) != (%s)",$fromName,$toName));
		}

		$original = $parent."/".$fromName;
		$destination = $parent."/".$toName;


		if(!rename($original, $destination)){
			throw new sfException(sprintf("Couldn't rename (%s) to (%s)",$original,$destination));
		}

		return true;
	}

	private static function removeFolder($parent,$child){
		//check that it is a dir
		$toDelete = $parent."/".$child."/";

		//check that it exists
		if(!file_exists($toDelete)){
			return true; // no need to delete
		}

		if(!is_dir($toDelete)){
			throw new sfException("The location provide is not a directory");
		}

		self::delTree($toDelete);

		return true;
	}
}