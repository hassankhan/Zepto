<?php

namespace Zepto\Route;

/**
 * TagRoute
 *
 * This route is executed when a ``/tag | /tags`` URL is matched
 *
 * @package    Zepto
 * @subpackage Route
 * @author     Hassan Khan <contact@hassankhan.me>
 * @link       https://github.com/hassankhan/Zepto
 * @license    MIT
 * @since      0.7
 */
class TagRoute extends \Zepto\Route\ListRoute
{

    /**
     * Initializes the route by creating a regex pattern from the provided URL,
     * and assigns the callable function for this route
     *
     * @param string $url
     * @codeCoverageIgnore
     */
    public function __construct($url = '')
    {
        parent::__construct($url, array($this, 'build_route'));
    }

    /**
     * Builds and returns the rendered HTML
     *
     * @return string
     */
    public function build_route($tag_name = '')
    {
        // Get reference to Zepto
        $zepto = \Zepto\Zepto::instance();
        // Get tags
        $tags           = $zepto->app['filesystem']->tags('content');
        // Load file
        $tagged_files   = $tags[$tag_name];
        // Create array to hold posts
        $posts          = $this->get_excerpts($tagged_files);
        // Load in any extra stuffs
        $zepto->app['extra'] = isset($zepto->app['extra']) === TRUE ? $zepto->app['extra'] : array();

        // Merge Twig options and content into one array
        $options             = array_merge($posts, $zepto->app['extra']);

        // Render template with Twig
        return $zepto->app['twig']->render($zepto->app['settings']['zepto.default_list_template'], array('contents' => $posts));
    }

}
