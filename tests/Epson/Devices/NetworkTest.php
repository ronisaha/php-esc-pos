<?php
/**
 * Created by PhpStorm.
 * User: gerifield
 * Date: 2015.01.14.
 * Time: 11:46
 */

namespace test\Epson\Devices;


use Epson\Devices\Network;

class NetworkTest extends \PHPUnit_Framework_TestCase {

	const HOST = '127.0.0.1';
	const PORT = 80;

	/**
	 * @var \Epson\Devices\Network
	 */
//	private $object;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
//	private $fsWrapper;

	protected function setUp()
	{
		parent::setUp();

//		$this->fsWrapper = $this->getMockBuilder('\Epson\Wrappers\SystemCallWrapper')->getMock();
//
//		$this->fsWrapper->expects($this->once())
//			->method('is_writeable')
//			->willReturn(true);
//
//		$this->object = new Network(
//			$this->fsWrapper,
//			self::HOST,
//			self::PORT
//		);
	}

	/**
	 * @test
	 */
	public function testCreate() //Actually it's a constructor test too
	{
		//Overwrite the original $fsWrapper!s return value
		$fsWrapper = $this->getMockBuilder('\Epson\Wrappers\SystemCallWrapper')->getMock();

		$fsWrapper->expects($this->once())
			->method('sockOpen')
			->with($this->equalTo(self::HOST, self::PORT))
			->willReturn(true);


		$this->assertInstanceOf('\Epson\Devices\FileSystem', new Network($fsWrapper, self::HOST, self::PORT));
	}
}
