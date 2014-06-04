<?php
/**
 * Printer Class
 *
 * The ESC/POS command creator class
 *
 * @package		ESC/POS command SDK
 * @category	Main Class
 * @author		Roni Saha <roni.cse@gmail.com>
 *
 */

namespace Epson;

use Epson\Devices\Device;
use Epson\Devices\FileSystem;

class Printer
{
    /**
     * @var Device
     */
    protected $device;

    public function __construct(Device $device = null)
    {
        $this->device = ($device == null) ? new FileSystem() : $device;

        $this->device->initialize();
    }

    /**
     * Add text to the buffer
     *
     * @param string $str Text to print
     */
    function text($str = "")
    {
        $this->device->write($str);
    }

    /**
     * Print and feed line / Print and feed n lines
     *
     * @param int $lines Number of lines to feed
     */
    function feed($lines = 1)
    {
        if ($lines <= 1) {
            $this->device->write(EscPos::CTL_LF);
        } else {
            $this->device->write(EscPos::CTL_ESC . "d" . chr($lines));
        }
    }

    /**
     * Select print mode(s).
     *
     * Arguments should be OR'd together MODE_* constants:
     * MODE_FONT_A
     * MODE_FONT_B
     * MODE_EMPHASIZED
     * MODE_DOUBLE_HEIGHT
     * MODE_DOUBLE_WIDTH
     * MODE_UNDERLINE
     *
     * @param int|string $mode
     */
    function setPrintMode($mode = EscPos::NUL)
    {
        $this->device->write(EscPos::CTL_ESC . "!" . chr($mode));
    }

    /**
     * Turn underline mode on/off
     *
     * @param int $underline 0 for no underline, 1 for underline, 2 for heavy underline
     */
    function setUnderline($underline = 1)
    {
        $this->device->write(EscPos::CTL_ESC . "-" . chr($underline));
    }

    /**
     * Turn emphasized mode on/off
     *
     * @param boolean $on true for emphasis, false for no emphasis
     */
    function setEmphasis($on = true)
    {
        $this->device->write(EscPos::CTL_ESC . "E" . ($on ? chr(1) : chr(0)));
    }

    /**
     * Turn double-strike mode on/off
     *
     * @param boolean $on true for double strike, false for no double strike
     */
    function setDoubleStrike($on)
    {
        $this->device->write(EscPos::CTL_ESC . "G" . ($on ? chr(1) : chr(0)));
    }

    /**
     * Select character font.
     * Font must be FONT_A, FONT_B, or FONT_C.
     *
     * @param int $font
     */
    function setFont($font)
    {
        $this->device->write(EscPos::CTL_ESC . "M" . chr($font));
    }

    /**
     * Select justification
     * Justification must be JUSTIFY_LEFT, JUSTIFY_CENTER, or JUSTIFY_RIGHT.
     */
    function setJustification($justification)
    {
        $this->device->write(EscPos::CTL_ESC . "a" . chr($justification));
    }

    /**
     * Print and reverse feed n lines
     *
     * @param int $lines number of lines to feed
     */
    function feedReverse($lines = 1)
    {
        $this->device->write(EscPos::CTL_ESC . "e" . chr($lines));
    }

    /**
     * Cut the paper
     *
     * @param int $mode Cut mode, either CUT_FULL or CUT_PARTIAL
     * @param int $lines Number of lines to feed
     */
    function cut($mode = EscPos::PAPER_CUT_FULL, $lines = 3)
    {
        $this->device->write(EscPos::CTL_GS . "V" . chr($mode) . chr($lines));
    }

    /**
     * Set barcode height
     *
     * @param int $height Height in dots
     */
    function setBarcodeHeight($height = 8)
    {
        $this->device->write(EscPos::CTL_GS . "h" . chr($height));
    }

    /**
     * Print a barcode
     *
     * @param string $content
     * @param int $type
     */
    function barcode($content, $type = EscPos::BARCODE_CODE39)
    {
        $this->device->write(EscPos::CTL_GS . "k" . chr($type) . $content . EscPos::NUL);
    }

}