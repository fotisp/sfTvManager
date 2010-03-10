<?php

/**
 * Season filter form.
 *
 * @package    MythTv
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeasonFormFilter extends BaseSeasonFormFilter
{
  public function configure()
  {
  	$this->unsetFields();
  }
  
  public function unsetFields(){
  	
  	unset(
  		$this['start_date'],
  		$this['feed'],
			$this['regex'],
			$this['created_at'],
			$this['updated_at']
			);
  	
  }
}
