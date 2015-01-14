<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace test\Epson\Devices;

use Epson\Devices\Serial;

class SerialTest extends \PHPUnit_Framework_TestCase
{
	const DEVICE    = '/dev/ttyS0';
	const BAUD_RATE = 9600;
	const BYTE_SIZE = 8;
	const PARITY    = 'none';

	/**
	 * @var \Epson\Devices\Serial
	 */
	private $object;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $phpserial;

	protected function setUp()
	{
		parent::setUp();

		$this->phpserial = $this->getMockBuilder('\PhpSerial')->getMock();

		//Config device params in constructor
		$this->phpserial->expects($this->once())
			->method('deviceSet')
			->with($this->equalTo(self::DEVICE));

		$this->phpserial->expects($this->once())
			->method('confBaudRate')
			->with($this->equalTo(self::BAUD_RATE));

		$this->phpserial->expects($this->once())
			->method('confCharacterLength')
			->with($this->equalTo(self::BYTE_SIZE));

		$this->phpserial->expects($this->once())
			->method('confParity')
			->with($this->equalTo(self::PARITY));

		$this->phpserial->expects($this->once())
			->method('deviceOpen');

		$this->object = new Serial(
			$this->phpserial,
			self::DEVICE,
			self::BAUD_RATE,
			self::BYTE_SIZE,
			self::PARITY
		);
	}

	/**
	 * @test
	 */
//	public function testCreate()
//	{
//		$this->assertInstanceOf('\Epson\Devices\Serial', Serial::create());
//	}

	/**
	 * @test
	 */
	public function testClose()
	{
		$this->phpserial->expects($this->once())
			->method('deviceClose');

		$this->object->close();
	}

	/**
	 * @test
	 */
	public function testWrite()
	{
		$this->phpserial->expects($this->once())
			->method('sendMessage')
			->with($this->equalTo('testData'));

		$this->object->write('testData');
	}
}
