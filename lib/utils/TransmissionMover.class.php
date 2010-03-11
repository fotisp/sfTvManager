<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class TransmissionMover{

	private $srcDirectory,
					$destDirectory,
					$regex,
					$move;

	/**
	 * This class checks all the files in the $srcDirectory and
	 * moves the to the $destDirectory. It only moves the files
	 * that match the regular expression.
	 *
	 * @param $srcDirectory
	 * @param $destDirectory
	 * @param $regex
	 * @param $move Whether or not to move the files, or to copy them
	 */
	public function  __construct(
											$srcDirectory,
											$destDirectory,
											TransmissionRegex $regex,
											$move =false) {



		$this->srcDirectory = $srcDirectory;
		$this->destDirectory =$destDirectory;
		$this->regex = $regex;
		$this->move= $move;

	}


	
	public function run($dry=false){

		sfContext::getInstance()->getConfiguration()->loadHelpers("pregFind");

		//get all the files

		$patterns = $this->regex->getPatterns();

		$files = array();

		foreach ($patterns as $key => $pattern) {

			$files = array_merget($files,preg_find($pattern,$this->srcDirectory));

		}


		foreach($files as $f){

			$src = $this->srcDirectory."/".$f;
			$dest = $this->destDirectory."/".$f;

			if($dry_run){
				echo "mv $src to $dest"; 
			}else{
				rename($src, $dest);
			}
		}
	}



}
