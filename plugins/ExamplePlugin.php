<?php

/**
 * ExamplePlugin
 *
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/Zepto
 * @license    MIT
 * @since      0.4
 */
class ExamplePlugin implements \Zepto\PluginInterface {

    public function after_plugins_load(\Pimple $app)
    {
        // echo __CLASS__ . '::after_plugins_load';
    }

    public function before_config_load(\Pimple $app, &$settings)
    {
        // echo __CLASS__ . '::before_config_load';
    }

    public function before_router_setup(\Pimple $app)
    {
    }

    public function after_router_setup(\Pimple $app)
    {
    }

    public function before_response_send(\Pimple $app)
    {
    }

    public function after_response_send(\Pimple $app)
    {
    }

}
