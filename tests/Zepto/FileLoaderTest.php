<?php
namespace Zepto;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-11-03 at 13:49:12.
 */
class FileLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileLoader
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new FileLoader();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->object = null;
    }

    /**
     * @covers Zepto\FileLoader::load()
     * @expectedException Exception
     */
    public function testLoad()
    {
        $this->object->load('@£@', 'aa');
    }

    /**
     * @covers Zepto\FileLoader::load
     * @todo   Implement testLoad().
     */
    public function testLoadSingleFile()
    {
        $files['404.md'] = '/*' . PHP_EOL
            . 'Title: Error 404' . PHP_EOL
            . 'Robots: noindex,nofollow' . PHP_EOL
            . '*/' . PHP_EOL . PHP_EOL
            . 'Error 404' . PHP_EOL
            . '=========' . PHP_EOL . PHP_EOL
            . 'Woops. Looks like this page doesn\'t exist.';

        $result = $this->object->load(ROOT_DIR . 'content/404.md', array('md'));

        $this->assertEquals($files, $result);
    }

    /**
     * @covers Zepto\FileLoader::load()
     */
    public function testLoadMultipleFiles()
    {
        $files = array(
            'sub/page.md' => '/*' . PHP_EOL
                . 'Title: Sub Page' . PHP_EOL
                . '*/' . PHP_EOL . PHP_EOL
                . '## This is a Sub Page' . PHP_EOL . PHP_EOL
                . 'This is page.md in the "sub" folder.' . PHP_EOL . PHP_EOL
                . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' . PHP_EOL . PHP_EOL
                . 'Donec ultricies tristique nulla et mattis.' . PHP_EOL . PHP_EOL
                . 'Phasellus id massa eget nisl congue blandit sit amet id ligula.' . PHP_EOL
            ,
            'sub/index.md' => '/*' . PHP_EOL
                . 'Title: Sub Page Index' . PHP_EOL
                . '*/' . PHP_EOL . PHP_EOL
                . '## This is a Sub Page Index' . PHP_EOL . PHP_EOL
                . 'This is index.md in the "sub" folder.' . PHP_EOL . PHP_EOL
                . 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.' . PHP_EOL . PHP_EOL
                . 'Donec ultricies tristique nulla et mattis.' . PHP_EOL . PHP_EOL
                . 'Phasellus id massa eget nisl congue blandit sit amet id ligula.' . PHP_EOL
        );


        $result = $this->object->load(ROOT_DIR . 'content/sub', array('md'));
    }

    /**
     * @covers class::()
     */
    public function testCache()
    {
        $this->markTestIncomplete('Not yet implemented');
    }
}
