<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_Navigation
 */

namespace HMNavigation\Navigation\Service;

use Zend\Navigation\Service\AbstractNavigationFactory;

/**
 * Default navigation factory.
 *
 * @category  Zend
 * @package   Zend_Navigation
 */
class HMMenuFactory extends AbstractNavigationFactory
{
	protected $name = "default";
	
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    
    public function setName($name)
    {
    	$this->name = $name;
    }
}
