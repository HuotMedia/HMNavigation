<?php
namespace HMNavigation;

use HMNavigation\Navigation\Service\HMMenuFactory;

class Module
{
	protected $sm;
	protected $menus;
	public function onBootstrap($e)
	{
		$this->sm = $e->getApplication()->getServiceManager();
		/*$view = $sm->get('ViewRenderer');
		$filters = $view->getFilterChain();
		$widgetFilter = new ShortCodeFilter();
		$widgetFilter->setServiceLocator($sm);
		$filters->attach($widgetFilter, 50);
		$view->setFilterChain($filters);*/
		$em = $e->getApplication()->getEventManager();
		
		$em->attach('dispatch', array($this, 'buildNavs'));
		
	}
	
	public function buildNavs($e)
	{
		$sm = $this->sm;
		$sm->setAllowOverride(true);
		$config = $sm->get('Configuration');
		
		$navigations = $config['navigation'];
		
		$containers = array();
		
		foreach($navigations as $key=>$pages)
		{
			$containers[$key] = $this->createMenu($key);
			$name = ($key == "default")? "Navigation": $key;
			$sm->setService($name,$containers[$key]);
		}
	}
	
	protected function createMenu($name)
	{
		$menu = new HMMenuFactory();
		$menu->setName($name);
		return $menu->createService($this->sm);
	}
		
	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\ClassMapAutoloader'=> array(__DIR__ . '/autoload_classmap.php'),
				'Zend\Loader\StandardAutoloader' => array('namespaces'=>array(
						__NAMESPACE__ => __DIR__ .'/src/'.__NAMESPACE__,
				)),
		);
	}
	
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
	
	
}