<?php
/**
 * Created by PhpStorm.
 * User: gerifield
 * Date: 2015.01.04.
 * Time: 21:50
 */

namespace test\Epson\Devices;


use Epson\Devices\FileSystem;

class FileSystemTest extends \PHPUnit_Framework_TestCase
{
	const TEST_PATH = 'testPath';
	/**
	 * @var \Epson\Devices\FileSystem
	 */
	private $object;

	/**
	 * @var \PHPUnit_Framework_MockObject_MockObject
	 */
	private $fsWrapper;

	protected function setUp()
	{
		parent::setUp();

		$this->fsWrapper = $this->getMockBuilder('\Epson\Wrappers\SystemCallWrapper')->getMock();

		$this->fsWrapper->expects($this->once())
			->method('is_writeable')
			->willReturn(true);

		$this->object = new FileSystem(
			$this->fsWrapper,
			self::TEST_PATH
		);
	}

	/**
	 * @test
	 */
	public function testCreateWithoutWriteable()
	{
		$this->setExpectedException('\Exception');
		FileSystem::create(null);
	}

	/**
	 * @test
	 */
	public function testCreateWithNonWriteable() //Actually it's a constructor test
	{
		//Overwrite the original $fsWrapper!s return value
		$fsWrapper = $this->getMockBuilder('\Epson\Wrappers\SystemCallWrapper')->getMock();

		$fsWrapper->expects($this->once())
			->method('is_writeable')
			->with($this->equalTo('wrongPath'))
			->willReturn(false);

		$this->setExpectedException('\Exception');
		new FileSystem($fsWrapper, 'wrongPath');
	}

	/**
	 * @test
	 */
	public function testCreate() //Actually it's a constructor test too
	{
		//Overwrite the original $fsWrapper!s return value
		$fsWrapper = $this->getMockBuilder('\Epson\Wrappers\SystemCallWrapper')->getMock();

		$fsWrapper->expects($this->once())
			->method('is_writeable')
			->with($this->equalTo(self::TEST_PATH))
			->willReturn(true);


		$fsWrapper->expects($this->once())
			->method('open')
			->with($this->equalTo(self::TEST_PATH));

		$this->assertInstanceOf('\Epson\Devices\FileSystem', new FileSystem($fsWrapper, self::TEST_PATH));
	}

	/**
	 * @test
	 */
	public function testClose()
	{
		$this->fsWrapper->expects($this->once())
			->method('close');
		$this->object->close();
	}

	/**
	 * @test
	 */
	public function testWrite()
	{
		$this->fsWrapper->expects($this->once())
			->method('write')
			->with($this->equalTo('testWriteData'));

		$this->object->write('testWriteData');
	}
}
