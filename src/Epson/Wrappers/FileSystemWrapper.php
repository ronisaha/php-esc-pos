<?php
/**
 * @author gerifield <gerifield@ustream.tv>
 */

namespace Epson\Wrappers;

/**
 * Class FileSystemWrapper
 * @package Epson\Wrappers
 *
 * @codeCoverageIgnore
 *
 * Maybe use https://github.com/mikey179/vfsStream instead!
 */
class FileSystemWrapper
{
	/**
	 * @var resource
	 */
	private $resource;

	/**
	 * @return FileSystemWrapper
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
	 * Write data to file
	 *
	 * @param string $data
	 */
	public function write($data)
	{
		fwrite($this->resource, $data);
	}

	/**
	 * Close file
	 */
	public function close()
	{
		fclose($this->resource);
	}
}
