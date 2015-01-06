<?php

/**
 * Network Device Class
 *
 * A device implementation to communicate with network printer
 *
 * @package		ESC/POS command SDK
 * @category	Device Class
 * @author		Roni Saha <roni.cse@gmail.com>
 *
 */

namespace Epson\Devices;

use Epson\Wrappers\SystemCallWrapper;

class Network extends FileSystem
{
//    public function __construct($host, $port = 9100, $timeout = 30)
//    {
//        $this->resource = fsockopen($host, $port, $errorNo, $errString, $timeout);
//
//        if (!$this->resource) {
//            throw new \Exception($errString, $errorNo);
//        }
//    }

    public function __construct(SystemCallWrapper $networkWrapper, $host, $port)
    {
        $networkWrapper->sockOpen($host, $port);
        $this->sysCallWrapper = $networkWrapper;
    }
}