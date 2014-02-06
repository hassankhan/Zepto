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
    protected $loader;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->loader = new FileLoader(ROOT_DIR . 'content/');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->loader = null;
    }

    /**
     * @covers            Zepto\FileLoader::load()
     * @expectedException RuntimeException
     */
    public function testLoadInvalidFile()
    {
        $this->loader->load('@£@');
    }

    /**
     * @covers            Zepto\FileLoader::load()
     * @expectedException UnexpectedValueException
     */
    public function testLoadDirectory()
    {
        $this->loader->load('sub/');
    }

    /**
     * @covers       Zepto\FileLoader::load
     * @dataProvider providerTestLoadSingleFile
     */
    public function testLoadSingleFile($files)
    {
        $result = $this->loader->load('404.md');
        $this->assertEquals($files, $result);
    }

    /**
     * @covers       Zepto\FileLoader::load()
     * @dataProvider providerTestLoadMultipleFiles
     */
    public function testLoadMultipleFiles($expected)
    {
        $actual = array_merge(
            $this->loader->load('sub/page.md'),
            $this->loader->load('sub/index.md')
        );

        $this->assertEquals($expected, $actual);
    }

    /**
     * @covers Zepto\FileLoader::get_directory_map()
     */
    public function testGet_directory_map()
    {
        $expected = array(
            0 => '404.md',
            1 => 'index.md',
            'sub' => array(
                0 => 'index.md',
                1 => 'page.md'
            )
        );

        $this->assertEquals($expected, $this->loader->get_directory_map(ROOT_DIR . 'content'));
    }

    public function providerTestLoadSingleFile()
    {
        $files['404.md'] = '/*' . PHP_EOL
            . 'Title: Error 404' . PHP_EOL
            . 'Robots: noindex,nofollow' . PHP_EOL
            . '*/' . PHP_EOL . PHP_EOL
            . 'Error 404' . PHP_EOL
            . '=========' . PHP_EOL . PHP_EOL
            . 'Woops. Looks like this page doesn\'t exist.';

        return array(array( $files ));
    }

    /**
     * Data provider for tests
     * @return array
     */
    public function providerTestLoadMultipleFiles()
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

        return array(array( $files ));
    }
}
