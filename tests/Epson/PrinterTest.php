<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace tests\Epson;

use Epson\EscPos;
use Epson\Printer;

class PrinterTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Printer
	 */
	private $object;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $device;

	protected function setUp()
	{
		parent::setUp();

		$this->device = $this->getMockBuilder('\Epson\Devices\Device')
			->getMockForAbstractClass();

		//$this->device->expects($this->once())->method('initialize');

		$this->object = new Printer(
			$this->device
		);
	}

	/**
	 * @test
	 */
	public function testText()
	{
		$this->device->expects($this->once())
			->method('write')
			->with($this->equalTo('test'));

		$this->assertEquals($this->object, $this->object->text('test'));
	}

	/**
	 * @test
	 */
	public function testFeedWithZero()
	{
		$this->device->expects($this->once())
			->method('write')
			->with($this->equalTo(EscPos::CTL_LF));

		$this->assertEquals($this->object, $this->object->feed(0));
	}

	/**
	 * @test
	 */
	public function testFeedWithMultipleLines()
	{
		$this->device->expects($this->once())
			->method('write')
			->with($this->equalTo(EscPos::CTL_ESC . "d" . chr(5)));

		$this->assertEquals($this->object, $this->object->feed(5));
	}

	/**
	 * @test
	 */
	public function testSetPrintModeDefault()
	{
		$this->device->expects($this->once())
			->method('write')
			->with($this->equalTo(EscPos::CTL_ESC . "!" . chr(EscPos::NUL)));

		$this->assertEquals($this->object, $this->object->setPrintMode());
	}

	/**
	 * @test
	 */
	public function testSetPrintModeWithParam()
	{
		$this->device->expects($this->once())
			->method('write')
			->with($this->equalTo(EscPos::CTL_ESC . "!" . chr(EscPos::MODE_FONT_A)));

		$this->assertEquals($this->object, $this->object->setPrintMode(EscPos::MODE_FONT_A));
	}

	/**
	 * @test
	 */
	public function testSetUnderline()
	{
		$this->device->expects($this->once())
			->method('write')
			->with($this->equalTo(EscPos::CTL_ESC . "-" . chr(0)));

		$this->assertEquals($this->object, $this->object->setUnderline(0));
	}
}
