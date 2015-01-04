<?php

/**
 * FileSystem Device Class
 *
 * A device implementation to write the print job to a file
 *
 * @package		ESC/POS command SDK
 * @category	Device Class
 * @author		Roni Saha <roni.cse@gmail.com>
 *
 */

namespace Epson\Devices;

use Epson\Wrappers\FileSystemWrapper;

class FileSystem extends  Device
{
    //protected $resource;
    /**
     * @var \Epson\Wrappers\FileSystemWrapper
     */
    private $fsWrapper;

    public static function create($path = "php://stdout")
    {
        return new self(
            FileSystemWrapper::create(),
            $path
        );
    }

    public function __construct(FileSystemWrapper $fsWrapper, $path)
    {
        if(empty($path) || !$fsWrapper->is_writeable($path)) {
            throw new \Exception('Resource is not writable', 0);
        }
        $fsWrapper->open($path, 'wb');

        $this->fsWrapper = $fsWrapper;
    }

    function close()
    {
        $this->fsWrapper->close();
    }

    function write($data)
    {
        $this->fsWrapper->write($data);
    }
}