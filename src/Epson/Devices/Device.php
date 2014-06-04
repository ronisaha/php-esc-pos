<?php

/**
 * Abstract Device Class
 *
 * The abstract base class for device
 *
 * @package		ESC/POS command SDK
 * @category	Abstract Class
 * @author		Roni Saha <roni.cse@gmail.com>
 *
 */

namespace Epson\Devices;

use Epson\EscPos;

abstract class Device
{
    abstract public function close();
    abstract public function write($data);

    public function initialize()
    {
        $this->write(EscPos::CTL_ESC . "@");
    }

    public function __destruct()
    {
        $this->close();
    }
}