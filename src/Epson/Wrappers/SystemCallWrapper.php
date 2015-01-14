<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace Epson\Wrappers;

/**
 * Class SystemCallWrapper
 * @package Epson\Wrappers
 *
 * @codeCoverageIgnore
 *
 * Maybe use https://github.com/mikey179/vfsStream instead!
 */
class SystemCallWrapper
{
	/**
	 * @var resource
	 */
	private $resource;

	/**
	 * @var int
	 */
	private $errorNo  = 0;

	/**
	 * @var string
	 */
	private $errorMsg = '';

	/**
	 * @return SystemCallWrapper
	 */
	public static function create()
	{
		return new self();
	}

	/**
	 * Check if file is writeable
	 *
	 * @param string $path
	 * @return bool
	 */
	public function is_writeable($path)
	{
		return is_writeable($path);
	}

	/**
	 * Open a file with $mode
	 *
	 * @param string $path
	 * @param string $mode
	 */
	public function open($path, $mode)
	{
		$this->resource = fopen($path, $mode);
	}

	/**
	 * Open a socket
	 *
	 * @param string $host
	 * @param string $port
	 * @param int    $timeout Default: 30
	 */
	public function sockOpen($host, $port, $timeout = 30)
	{
		$this->resource = fsockopen($host, $port, $this->errorNo, $this->errorMsg, $timeout);
	}

	/**
	 * Write data
	 *
	 * @param string $data
	 */
	public function write($data)
	{
		fwrite($this->resource, $data);
	}

	/**
	 * Close
	 */
	public function close()
	{
		fclose($this->resource);
	}

	public function hasError()
	{
		return $this->errorNo > 0;
	}

	public function getErrorNo()
	{
		return $this->errorNo;
	}

	public function getErrorMsg()
	{
		return $this->errorMsg;
	}
}
