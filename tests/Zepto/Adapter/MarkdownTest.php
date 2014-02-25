<?php
namespace Zepto\Adapter;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-02-24 at 21:34:12.
 */
class MarkdownTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Markdown
     */
    protected $adapter;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->parsed_text = '<h2>This is a Sub Page</h2>' . PHP_EOL . PHP_EOL
            . '<p>This is page.md in the "sub" folder.</p>' . PHP_EOL . PHP_EOL
            . '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>' . PHP_EOL . PHP_EOL
            . '<p>Donec ultricies tristique nulla et mattis.</p>' . PHP_EOL . PHP_EOL
            . '<p>Phasellus id massa eget nisl congue blandit sit amet id ligula.</p>' . PHP_EOL;

        $parser = $this->getMock('Michelf\Markdown', array('defaultTransform'));
        $parser::staticExpects($this->any())
            ->method('defaultTransform')
            ->will($this->returnValue($this->parsed_text));

        $this->adapter = new Markdown(ROOT_DIR . 'content', $parser);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers Zepto\Adapter\Markdown::__construct()
     * @covers Zepto\Adapter\Markdown::parser()
     */
    public function testConstructedAndParserSet()
    {
        $actual = $this->adapter->parser();
        $this->assertInstanceOf('Michelf\MarkdownInterface', $actual);
    }

    /**
     * @covers Zepto\Adapter\Markdown::read()
     * @covers Zepto\Adapter\Markdown::post_process()
     * @covers Zepto\Adapter\Markdown::parse_meta()
     * @covers Zepto\Adapter\Markdown::parse_content()
     */
    public function testRead()
    {
        $actual        = $this->adapter->read('sub/page.md');
        $expected_meta = array(
            'title'         => 'Sub Page',
        );

        $this->assertEquals($expected_meta, $actual['meta']);
        $this->assertEquals($this->parsed_text, $actual['contents']);
    }

    /**
     * @covers Zepto\Adapter\Markdown::read()
     * @expectedException PHPUnit_Framework_Error_Warning
     */
    public function testReadFailure()
    {
        $actual = $this->adapter->read('no_such_file');
        $this->assertFalse($actual);
    }

}
