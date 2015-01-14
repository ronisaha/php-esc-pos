<?php

/**
 * Network Device Class
 *
 * A device implementation to communicate with printer connected on serial port
 *
 * @package		ESC/POS command SDK
 * @category	Device Class
 * @author		Roni Saha <roni.cse@gmail.com>
 *
 */

namespace Epson\Devices;

class Serial extends Device
{
    protected $resource;

    /**
     * @param string $devfile
     * @param int $baudRate
     * @param int $byteSize
     * @param string $parity
     *
     * @return Serial
     *
     * @codeCoverageIgnore
     */
    public static function create($devfile = "/dev/ttyS0", $baudRate = 9600, $byteSize = 8, $parity = 'none')
    {
        return new self(
            new \PhpSerial(),
            $devfile,
            $baudRate,
            $byteSize,
            $parity
        );
    }

    public function __construct(\PhpSerial $phpSerial, $devfile, $baudRate, $byteSize, $parity)
    {
        $this->resource = $phpSerial;
        $this->resource->deviceSet($devfile);
        $this->resource->confBaudRate($baudRate);
        $this->resource->confCharacterLength($byteSize);
        $this->resource->confParity($parity);
        $this->resource->deviceOpen();
    }

    function close()
    {
        $this->resource->deviceClose();
    }

    function write($data)
    {
        $this->resource->sendMessage($data);
    }
}