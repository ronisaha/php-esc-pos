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

use Epson\Wrappers\SystemCallWrapper;

class FileSystem extends  Device
{
    //protected $resource;
    /**
     * @var \Epson\Wrappers\SystemCallWrapper
     */
    protected $sysCallWrapper;

    public static function create($path = "php://stdout")
    {
        return new self(
            SystemCallWrapper::create(),
            $path
        );
    }

    public function __construct(SystemCallWrapper $fsWrapper, $path)
    {
        if(empty($path) || !$fsWrapper->is_writeable($path)) {
            throw new \Exception('Resource is not writable', 0);
        }
        $fsWrapper->open($path, 'wb');

        $this->sysCallWrapper = $fsWrapper;
    }

    function close()
    {
        $this->sysCallWrapper->close();
    }

    function write($data)
    {
        $this->sysCallWrapper->write($data);
    }
}