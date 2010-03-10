<?php

/**
 * BaseSeries
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Seasons
 * 
 * @method string              getName()    Returns the current record's "name" value
 * @method Doctrine_Collection getSeasons() Returns the current record's "Seasons" collection
 * @method Series              setName()    Sets the current record's "name" value
 * @method Series              setSeasons() Sets the current record's "Seasons" collection
 * 
 * @package    MythTv
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 6820 2009-11-30 17:27:49Z jwage $
 */
abstract class BaseSeries extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('series');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => '255',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('Season as Seasons', array(
             'local' => 'id',
             'foreign' => 'series_id'));

        $timestampable0 = new Doctrine_Template_Timestampable();
        $this->actAs($timestampable0);
    }
}