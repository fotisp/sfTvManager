<?php

require_once dirname(__FILE__).'/../lib/seasonGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/seasonGeneratorHelper.class.php';

/**
 * season actions.
 *
 * @package    MythTv
 * @subpackage season
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class seasonActions extends autoSeasonActions
{

	public function executeSeasonFilter(sfWebRequest $request){
		/**
		 *
		 * Make sure you check up on this answer
		 * http://forum.symfony-project.org/index.php/m/93000/#msg_93000
		 *
		 *
		 */

		$this->getUser()->setAttribute(
											'season.filters', 
		array('series_id' => $request->getParameter('season')),
											'admin_module');
			
		$this->redirect($this->generateUrl('season'));

	}


	public function executeIndex(sfWebRequest $request){

		$filterArray = $this->getFilters();
	
		$this->filterTitle='All';

		if(sizeof($filterArray) >0){

			$series_id= $filterArray['series_id'];
			$this->series=Doctrine::getTable('Series')->find($series_id);
			$this->forward404Unless($this->series,'There is no series with that id');

			$this->filterTitle=$this->series->getName();
		}

		parent::executeIndex($request);

	}
}
