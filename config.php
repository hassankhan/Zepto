<?php

$config = array(
    'zepto' => array(
        'content_dir'       => 'content',
        'plugin_dir'        => 'plugins',
        'templates_dir'     => 'templates',
        'default_template'  => 'base.twig',
        'content_ext'       => array('.md', '.markdown'),
        'plugins_enabled'   => true
    ),
    'site' => array(
        'site_root'         => 'Site root URL goes here',
        'site_title'        => 'Zepto',
        'date_format'       => 'jS M Y',
        'excerpt_length'    => '50'
    ),
    'twig' => array(
        'charset'           => 'utf-8',
        'cache'             => 'cache',
        'strict_variables'  => false,
        'autoescape'        => false,
        'auto_reload'       => true
    )
);

return $config;


/*
// Override any of the default settings below:

$config['site_title'] = 'Pico';			// Site title
$config['base_url'] = ''; 				// Override base URL (e.g. http://example.com)
$config['theme'] = 'default'; 			// Set the theme (defaults to "default")
$config['date_format'] = 'jS M Y';		// Set the PHP date format
$config['twig_config'] = array(			// Twig settings
	'cache' => false,					// To enable Twig caching change this to CACHE_DIR
	'autoescape' => false,				// Autoescape Twig vars
	'debug' => false					// Enable Twig debug
);
$config['pages_order_by'] = 'alpha';	// Order pages by "alpha" or "date"
$config['pages_order'] = 'asc';			// Order pages "asc" or "desc"
$config['excerpt_length'] = 50;			// The pages excerpt length (in words)

// To add a custom config setting:

$config['custom_setting'] = 'Hello'; 	// Can be accessed by {{ config.custom_setting }} in a theme

*/
