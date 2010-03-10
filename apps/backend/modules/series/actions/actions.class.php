<?php

require_once dirname(__FILE__).'/../lib/seriesGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/seriesGeneratorHelper.class.php';

/**
 * series actions.
 *
 * @package    MythTv
 * @subpackage series
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seriesActions extends autoSeriesActions
{
	public function executeListSeasons(sfWebRequest $request){
		$season = $this->getRoute()->getObject();
		$this->redirect('@season_series?season='.$season->getId());
		
	}
}
