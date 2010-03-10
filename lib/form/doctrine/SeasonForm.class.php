<?php

/**
 * Season form.
 *
 * @package    MythTv
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class SeasonForm extends BaseSeasonForm
{
  public function configure()
  {
  	
  	$this->unsetFields();
  	
  	$this->widgetSchema['start_date'] = new sfWidgetFormJQueryDate(
  					array('date_widget'=>new sfWidgetFormDate(
  																					array('format'=>'%day%/%month%/%year%')))
  	);
  	$this->widgetSchema['feed']->setAttributes(array('cols'=>60,'rows'=>5));
  	
  	$this->widgetSchema['regex'] = new sfWidgetFormTextarea(array(), array('cols'=>60, 'rows'=>10));
  	
  	$this->widgetSchema->setHelp('regex','One php regex per line');
  	
  	
  }
  
  public function unsetFields(){
  	
  	unset($this['created_at'],
  				$this['updated_at']);
  	
  }
}
