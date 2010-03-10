<?php

/**
 * Series form.
 *
 * @package    MythTv
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeriesForm extends BaseSeriesForm
{
  public function configure()
  {
  	$this->unsetFields();
  }
  
  public function unsetFields(){
  	
  	unset($this['created_at'],
  				$this['updated_at']);
  }
}
