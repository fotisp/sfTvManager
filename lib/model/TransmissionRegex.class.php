<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class TransmissionRegex{

	public function  __construct($regex = array()) {
		$this->regex = $regex;
	}


	public function getPatterns(){
		return $this->regex;
	}

	
}