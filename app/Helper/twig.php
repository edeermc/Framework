<?php

function resource( $val ) {
    $url = APPLICATION_ROOT . "/public/{$val}";
    return $url;
}

function route( $val ) {
    $url = APPLICATION_ROOT . "/{$val}";
    return $url;
}

function getLanguage() {
    $langs = explode(';', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
    return substr($langs[0], 0, 2);
}

function getIP() {
    return $_SERVER['REMOTE_ADDR'];
}

function twig() {
    $loader     = new \Twig_Loader_Filesystem( 'app/Views' );
    $twig       = new \Twig_Environment( $loader );
    
    $resource   = new Twig_SimpleFunction( 'resource', function( $val ) {
        return resource( $val );
    } );
    
    $router     = new Twig_SimpleFunction( 'route', function( $val ) {
        return route( $val );
    } );

    $getLanguage = new Twig_SimpleFunction( 'getLanguage', function () {
        return getLanguage();
    } );

    $getIP      = new Twig_SimpleFunction( 'getIP', function () {
        return getIP();
    } );

    $twig->addFunction( $resource );
    $twig->addFunction( $router );
    $twig->addFunction( $getLanguage );
    $twig->addFunction( $getIP );
	return $twig;
}

function view( $val, $array = [] ) {
    $t = twig();
    return $t->render( $val, $array );
}

function viewBlock( $valTemplate, $block_name, $array = [] ) {
    $t = twig();
    $template= $t->loadTemplate( $valTemplate );
    return $template->renderBlock( $block_name, $array );
}