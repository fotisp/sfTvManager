<?php

/**
 * Preferences filter form.
 *
 * @package    MythTv
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class PreferencesFormFilter extends BasePreferencesFormFilter
{
  public function configure()
  {
  	$this->useFields(array('name','value'));
  }
}
