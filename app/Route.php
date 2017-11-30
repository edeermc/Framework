<?php

namespace App;

class Route{
    public function run(){
        $route = array(
            //url
            ['url' => '/', 	        						'ctrl' => 'HomeController@index', 				    		'type' => 'guest'],

            ['url' => 'navegacion', 					    'ctrl' => 'NavController@filtros', 			    			'type' => 'guest'],
            ['url' => 'navegacion/filter', 					'ctrl' => 'NavController@filtrar', 			    			'type' => 'guest'],
            ['url' => 'navegacion/pdf', 					'ctrl' => 'NavController@ppdf', 			    			'type' => 'guest'],
            ['url' => 'navegacion/excel', 					'ctrl' => 'NavController@pexcel', 			    			'type' => 'guest'],
            ['url' => 'navegacion/save', 					'ctrl' => 'NavController@save', 			    			'type' => 'guest'],

            ['url' => 'r_productos',     					'ctrl' => 'ProductoController@index', 			    		'type' => 'guest'],
            ['url' => 'r_productos/filter', 				'ctrl' => 'ProductoController@filter', 			    		'type' => 'guest'],
            ['url' => 'r_productos/pdf',     				'ctrl' => 'ProductoController@pdf', 			    		'type' => 'guest'],
            ['url' => 'r_productos/excel', 				    'ctrl' => 'ProductoController@excel', 			    		'type' => 'guest'],

            ['url' => 'emp_carrier', 					    'ctrl' => 'EmpCarrierController@index', 					'type' => 'guest'],
            ['url' => 'emp_carrier/save', 					'ctrl' => 'EmpCarrierController@save', 				    	'type' => 'guest'],
            ['url' => 'emp_carrier/del', 					'ctrl' => 'EmpCarrierController@del', 				    	'type' => 'guest'],
            ['url' => 'emp_carrier/pdf', 					'ctrl' => 'EmpCarrierController@pdf', 				    	'type' => 'guest'],
            ['url' => 'emp_carrier/excel', 					'ctrl' => 'EmpCarrierController@excel', 			    	'type' => 'guest'],

            ['url' => 'conductores', 					    'ctrl' => 'ConductoresController@index', 					'type' => 'guest'],
            ['url' => 'conductores/save', 					'ctrl' => 'ConductoresController@save', 					'type' => 'guest'],
            ['url' => 'conductores/del', 					'ctrl' => 'ConductoresController@del', 			    		'type' => 'guest'],
            ['url' => 'conductores/pdf', 					'ctrl' => 'ConductoresController@pdf', 	    				'type' => 'guest'],
            ['url' => 'conductores/excel', 					'ctrl' => 'ConductoresController@excel',		    		'type' => 'guest'],

            ['url' => 'vehiculos', 					        'ctrl' => 'VehiculosController@index', 					    'type' => 'guest'],
            ['url' => 'vehiculos/save', 				    'ctrl' => 'VehiculosController@save', 					    'type' => 'guest'],
            ['url' => 'vehiculos/del', 				        'ctrl' => 'VehiculosController@del', 					    'type' => 'guest'],
            ['url' => 'vehiculos/pdf', 	    			    'ctrl' => 'VehiculosController@pdf', 					    'type' => 'guest'],
            ['url' => 'vehiculos/excel',			        'ctrl' => 'VehiculosController@excel', 					    'type' => 'guest'],

            /* autenticación */
            ['url' => 'login', 						        'ctrl' => 'AuthController@index', 						    'type' => 'guest'],
			['url' => 'logout', 					        'ctrl' => 'AuthController@logout', 					    	'type' => 'guest'],
            ['url' => 'auth', 						        'ctrl' => 'AuthController@login', 				    		'type' => 'guest'],
            ['url' => 'test', 						        'ctrl' => 'HomeController@test', 				    		'type' => 'guest'],

			/* error */
            ['url' => '404', 					        	'ctrl' => 'ErrorController@error404',		    			'type' => 'guest'],
            ['url' => '403', 						        'ctrl' => 'ErrorController@error403', 	    				'type' => 'guest'],
            ['url' => '500', 						        'ctrl' => 'ErrorController@error500', 	    				'type' => 'guest']
        );
        return $route;
    }
}
