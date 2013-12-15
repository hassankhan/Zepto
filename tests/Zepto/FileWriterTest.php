<?php
namespace Zepto;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-11-26 at 00:03:02.
 */
class FileWriterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileWriter
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new FileWriter();
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        if (file_exists(ROOT_DIR . 'tests/testfile.txt')) {
            unlink(ROOT_DIR . 'tests/testfile.txt');
        }
    }

    /**
     * @covers Zepto\FileWriter::write
     */
    public function testWrite()
    {
        $writer = $this->object;
        $writer->write(ROOT_DIR . 'tests/testfile.txt', 'Test content');

        $this->assertFileExists(ROOT_DIR . 'tests/testfile.txt');
    }

}
