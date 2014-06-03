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

class FileSystem extends  AbstractDevice
{
    protected $resource;

    public function __construct($path = "php://stdout")
    {
        if(empty($path) || !is_writable($path)) {
            throw new \Exception('Resource is not writable', 0);
        }

        $this->resource = fopen($path, "wb");
    }

    function close()
    {
        fclose($this->resource);
    }

    function write($data)
    {
        fwrite($this->resource, $data);
    }
}