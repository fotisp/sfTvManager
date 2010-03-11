<?php
/**
 *
 * The following class grabs all the series from the database
 * along with the regular expressions. And puts the files
 * in the relative directories.
 *
 * For example:
 *
 * Series Lost, has n active season, for each of the season
 * we have the regular expression to test for the files,
 * and we move the files to the destination directory
 * specified by the preferences.
 *
 */
class transmissionCleanUpCompletedTask extends sfBaseTask{

	public function configure(){

		$this->namespace= "existanze";
		$this->name= "hello";
		$this->briefDescription = 'Simple hello world';
		$this->detailedDescription=<<<EOF
The [say:hello|INFO] task is an implementation of the classical
Hello World example using symfony's task system.

  [./symfony say:hello|INFO]

Use this task to greet yourself, or somebody else using
the [--who|COMMENT] argument.
EOF;
		$this->addArgument("who",sfCommandArgument::OPTIONAL,'Who wants to say hello?','World');

	}

	public function execute($arguments = array(), $options=array()){
		$this->logSection('say', 'Hello, World! '.$arguments['who'].'!');
	}


}