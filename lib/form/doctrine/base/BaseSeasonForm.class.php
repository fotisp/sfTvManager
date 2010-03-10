<?php

/**
 * Season form base class.
 *
 * @method Season getObject() Returns the current form's model object
 *
 * @package    MythTv
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseSeasonForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'number'     => new sfWidgetFormInputText(),
      'start_date' => new sfWidgetFormDate(),
      'feed'       => new sfWidgetFormTextarea(),
      'regex'      => new sfWidgetFormInputText(),
      'series_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Series'), 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorDoctrineChoice(array('model' => $this->getModelName(), 'column' => 'id', 'required' => false)),
      'number'     => new sfValidatorString(array('max_length' => 255)),
      'start_date' => new sfValidatorDate(array('required' => false)),
      'feed'       => new sfValidatorString(array('max_length' => 1000)),
      'regex'      => new sfValidatorPass(),
      'series_id'  => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Series'))),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
    ));

    $this->widgetSchema->setNameFormat('season[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Season';
  }

}
