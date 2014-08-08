<?php
/**
return array(
    'controllers' => array(
        'invokables' => array(
            'ZendSkeletonModule\Controller\Skeleton' => 'ZendSkeletonModule\Controller\SkeletonController',
        ),
    ),
    'router' => array(
        'routes' => array(
            'module-name-here' => array(
                'type'    => 'Literal',
                'options' => array(
                    // Change this to something specific to your module
                    'route'    => '/module-specific-root',
                    'defaults' => array(
                        // Change this value to reflect the namespace in which
                        // the controllers for your module are found
                        '__NAMESPACE__' => 'ZendSkeletonModule\Controller',
                        'controller'    => 'Skeleton',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // This route is a sane default when developing a module;
                    // as you solidify the routes for your module, however,
                    // you may want to remove it and replace it with more
                    // specific routes.
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                        //    'route'    => '/[:controller[/:action]]',
                      //      'constraints' => array(
                    //            'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                ////            ),
              //              'defaults' => array(
            //                ),
          //              ),
        //            ),
      //          ),
    //        ),
  //      ),
//    ),
    //'view_manager' => array(
  //      'template_path_stack' => array(
//            'ZendSkeletonModule' => __DIR__ . '/../view',
//        ),
//    ),
//);
**/

return array(
    'router' => array(
        'routes' => array(
            'interns-hello-world' => array(
                'type'    => 'Literal',
                    'options' => array(
                    'route' => '/hello/world',
                    'defaults' => array(
                        'controller' => 'Interns\Controller\Hello',
                        'action'     => 'world',
                    ),
                ),
            ),
			'student' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/student[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Interns\Controller\Students',
                        'action'     => 'index',
                    ),
                ),
            ),
            'employer' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/employer[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Interns\Controller\Employer',
                        'action'     => 'index',
                    ),
                ),
            ),
            'ins' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/ins[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Interns\Controller\Institute',
                        'action'     => 'index',
                    ),
                ),
            ),
            'interns' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/interns[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Interns\Controller\Internship',
                        'action'     => 'listInternships',
                    ),
                ),
            ),
            'user' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/users[/:action][/:id]',
                    'constraints' => array(
                        'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'id'     => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Interns\Controller\User',
                        'action'     => 'login',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Interns\Controller\Hello' => 'Interns\Controller\HelloController',
			'Interns\Controller\Students' => 'Interns\Controller\StudentsController',
			'Interns\Controller\Employer' => 'Interns\Controller\EmployerController',
			'Interns\Controller\Institute' => 'Interns\Controller\InstituteController',
			'Interns\Controller\Internship' => 'Interns\Controller\InternshipController',
			'Interns\Controller\User' => 'Interns\Controller\UserController',
        ),
    ),
	'view_manager' => array(
        'template_path_stack' => array(
            'interns' => __DIR__ . '/../view'
        ),
        'strategies' => array(
	        'ViewJsonStrategy',
	    ),
    ),
);
