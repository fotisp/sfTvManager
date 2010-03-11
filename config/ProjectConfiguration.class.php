<?php

require_once '/opt/symfony/symfony-1.4.1/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

class ProjectConfiguration extends sfProjectConfiguration
{
	public function setup()
	{
		$this->enablePlugins('sfDoctrinePlugin');
		$this->enablePlugins('sfFormExtraPlugin');
		$this->enablePlugins('sfJqueryReloadedPlugin');
		$this->enablePlugins('sfFeed2Plugin');
		$this->enablePlugins('sfWebBrowserPlugin');

		$this->enablePlugins('sfTaskExtraPlugin');
		$this->enablePlugins('exTransmissionApiPlugin');
		
	}

	public function setupPlugins(){
		foreach ($this->plugins as $plugin){
			// check for your project's prefix
			if (0 === strpos($plugin, 'ex')){
				
				$this->pluginConfigurations[$plugin]->connectTests();
			
			}
		}
		 
	}
}
