<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonModule for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

 /**
 
namespace ZendSkeletonModule;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
**/

namespace Interns;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Interns\Model\Students;
use Interns\Model\StudentsTable;
use Zend\Db\TableGateway\TableGateway;
use Interns\Model\UsersTable;
use Interns\Model\Users;
use Interns\Model\Locations;
use Interns\Model\LocationsTable;
use Interns\Model\Employer;
use Interns\Model\EmployerTable;
use Zend\Session\Container;
use Interns\Model\Internship;
use Interns\Model\InternshipTable;
use Interns\Model\InternshipRelevance;
use Interns\Model\InternshipRelevanceTable;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
 
    public function getControllerConfig()
    {
        return array('factories' => array(
            'Interns\Controller\Students' => function ($controllers) {
                $services   = $controllers->getServiceLocator();
                $controller = new Controller\InternsLKController();
                $events     = $services->get('EventManager');
 
                $events->attach('dispatch', function ($e) use ($controller) {
                    //$controller->layout()->setTemplate('layout/layoutStart');
                }, 100); // execute before executing action logic
 
                $controller->setEventManager($events);
                return $controller;
            }
        ));
    }
 
	public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Interns\Model\StudentsTable' =>  function($sm) {
                    $tableGateway = $sm->get('StudentsTableGateway');
                    $table = new StudentsTable($tableGateway);
                    return $table;
                },
                'StudentsTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Students($dbAdapter));
                    return new TableGateway('students', $dbAdapter, null, $resultSetPrototype);
                },
                'Interns\Model\FieldCategoryTable' =>  function($sm) {
                    $tableGateway = $sm->get('FieldTableGateway');
                    $table = new StudentsTable($tableGateway);
                    return $table;
                },
                'FieldTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Students($dbAdapter));
                    return new TableGateway('field_categories', $dbAdapter, null, $resultSetPrototype);
                },
                'Interns\Model\UsersTable' =>  function($sm) {
                    $tableGateway = $sm->get('UsersGateway');
                    $table = new UsersTable($tableGateway);
                    return $table;
                },
                'UsersGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Users($dbAdapter));
                    return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                },
                'Interns\Model\LocationsTable' =>  function($sm) {
                    $tableGateway = $sm->get('LocationsGateway');
                    $table = new LocationsTable($tableGateway);
                    return $table;
                },
                'LocationsGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Locations($dbAdapter));
                    return new TableGateway('locations', $dbAdapter, null, $resultSetPrototype);
                },
                'Interns\Model\EmployerTable' =>  function($sm) {
                    $tableGateway = $sm->get('EmployerGateway');
                    $table = new EmployerTable($tableGateway);
                    return $table;
                },
                'EmployerGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Employer($dbAdapter));
                    return new TableGateway('employer', $dbAdapter, null, $resultSetPrototype);
                },
                'Interns\Model\InternshipTable' =>  function($sm) {
                    $tableGateway = $sm->get('InternshipGateway');
                    $table = new InternshipTable($tableGateway);
                    return $table;
                },
                'InternshipGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Internship($dbAdapter));
                    return new TableGateway('internship_programs', $dbAdapter, null, $resultSetPrototype);
                },
                'Interns\Model\InternshipRelevanceTable' =>  function($sm) {
                    $tableGateway = $sm->get('InternshipRelevanceGateway');
                    $table = new InternshipRelevanceTable($tableGateway);
                    return $table;
                },
                'InternshipRelevanceGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new InternshipRelevance($dbAdapter));
                    return new TableGateway('internship_relevance', $dbAdapter, null, $resultSetPrototype);
                },
            ),
        );
    }
}