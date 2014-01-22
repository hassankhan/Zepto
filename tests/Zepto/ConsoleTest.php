<?php
namespace Zepto;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2014-01-33 at 01:10:02.
 */
class ConsoleTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @covers Zepto\Console::getName()
     * @covers Zepto\Console::getInputs()
     */
    public function testGetName() {
        $cli = new Console(array(
          'cli.php',
          '-p'
        ));

        $cli->parse();
        $inputs = $cli->getInputs();

        $this->assertEquals('cli.php', $cli->getName());
        $this->assertEquals('-p', $inputs[0]);
    }

    /**
     * @covers Zepto\Console::option
     * @covers Zepto\Console::getOptions
     */
    public function testOption() {
        $cli = new Console(array('cli.php'));
        $cli->option('-p, --peppers', 'Add peppers');
        $cli->option('-c, --cheese [type]', 'Add a cheese');

        $options = $cli->getOptions();

        $this->assertCount(2, $options);
        $this->assertArrayHasKey('-p', $options);
        $this->assertArrayHasKey('-c', $options);
        $this->assertTrue($options['-c']['input']);
    }

    /**
     * @covers Zepto\Console::option
     * @covers Zepto\Console::parse
     */
    public function testRequiredOption() {
        $cli = new Console(array(
          'cli.php',
          '-p'
        ));

        $cli->option('-h, --ham', 'Add ham');
        $cli->option('-b, --bread [type]', 'Type of bread', true);

        $cli->parse();

        // expect parse to throw an exception that input is not defined
        $this->expectOutputString(
            "Option \"-b, --bread [type] Type of bread\" is required"
            . PHP_EOL . PHP_EOL . PHP_EOL
            . "Usage: cli.php [options]" . PHP_EOL
        );
    }

    /**
     * Test params
     */
    public function testParams() {
        $cli = new Console(array(
          'cli.php',
          'test',
          'uk'
        ));
        $cli->param('client', 'Name of client', true);
        $cli->param('locale', 'Client locale');
        $cli->parse();

        // expect parse to throw an exception that input is not defined
        $this->assertEquals("test", $cli->get('client'));
        $this->assertEquals("uk", $cli->get('locale'));
    }

    /**
     * Test required
     */
    public function testRequiredParam() {
        $cli = new Console(array(
          'cli.php'
        ));

        $cli->param('client', 'Specify client', true);

        $cli->parse();

        // expect parse to throw an exception that input is not defined
        $this->expectOutputString(
            "Parameter \"client\" is required"
            . PHP_EOL . PHP_EOL . PHP_EOL
            . "Usage: cli.php <client> [options]" . PHP_EOL
        );
    }


    /**
     * @covers Zepto\Console::parse
     */
    public function testParse() {
        $cli = new Console(array(
          'cli.php',
          '-p',
          '--cheese',
          'cheddar'
        ));
        $cli->option('-p, --peppers', 'Add peppers');
        $cli->option('-c, --cheese [type]', 'Add a cheese');
        $cli->option('-m, --mayo', 'Add mayonaise');

        $cli->parse();

        $this->assertTrue($cli->get('-p'));
        $this->assertTrue($cli->get('--peppers'));

        $this->assertEquals('cheddar', $cli->get('-c'));
        $this->assertEquals('cheddar', $cli->get('--cheese'));

        $this->assertFalse($cli->get('-m'));
        $this->assertFalse($cli->get('--mayo'));
    }

    /**
     * Test parsing non options
     */
    public function testParsingNonOptions() {
        $cli = new Console(array(
          'cli.php',
          '-p',
          '--cheese',
          'cheddar',
          'extra',
          '-b',
          'info'
        ));
        $cli->option('-p, --peppers', 'Add peppers');
        $cli->option('-c, --cheese [type]', 'Add a cheese');

        $cli->parse();

        $this->assertTrue($cli->get('-p'));
        $this->assertTrue($cli->get('--peppers'));

        $this->assertEquals('cheddar', $cli->get('-c'));
        $this->assertEquals('cheddar', $cli->get('--cheese'));

        $this->assertEquals('extra', $cli->get(0));
        $this->assertEquals('-b', $cli->get(1));
        $this->assertEquals('info', $cli->get(2));
    }

    /**
     * Test help text
     */
    public function testHelp() {
        $cli = new Console(array(
            'cli.php',
            '-p',
            '--help'
        ));

        $cli->option('-p, --peppers', 'Add peppers');
        $cli->option('-c, --cheese [type]', 'Add a cheese');
        $cli->option('-m, --mayo', 'Add mayonaise');
        $cli->option('-b, --bread [type]', 'Type of bread', true);

        $cli->param('client', 'Name of client', true);
        $cli->param('locale', 'Client locale');

        $cli->parse();

        $this->expectOutputString(PHP_EOL . "Usage: cli.php <client> [locale] [options]\n\nParameters:\n\t<client> Name of client\n\t[locale] Client locale\n\nOptions:\n\t-p, --peppers Add peppers\n\t-c, --cheese [type] Add a cheese\n\t-m, --mayo Add mayonaise\n\t-b, --bread [type] Type of bread [required]\n\t-h, --help Output usage information\n");
    }

}
