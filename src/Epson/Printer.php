<?php
/**
 * Printer Class
 *
 * The ESC/POS command creator class
 *
 * @package		ESC/POS command SDK
 * @category	Main Class
 * @author		Michael Billington <michael.billington@gmail.com>,
 *			modifications by Roni Saha <roni.cse@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
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
     *
     * @return $this
     */
    public function text($str = "")
    {
        return $this->send($str);
    }

    /**
     * Print and feed line / Print and feed n lines
     *
     * @param int $lines Number of lines to feed
     *
     * @return $this
     */
    public function feed($lines = 1)
    {
        if ($lines <= 1) {
            $this->device->write(EscPos::CTL_LF);
        } else {
            $this->device->write(EscPos::CTL_ESC . "d" . chr($lines));
        }

        return $this;
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
     *
     * @return $this
     */
    public function setPrintMode($mode = EscPos::NUL)
    {
        return $this->send(EscPos::CTL_ESC . "!" . chr($mode));
    }

    /**
     * Turn underline mode on/off
     *
     * @param int $underline 0 for no underline, 1 for underline, 2 for heavy underline
     *
     * @return $this
     */
    public function setUnderline($underline = 1)
    {
        return $this->send(EscPos::CTL_ESC . "-" . chr($underline));
    }

    /**
     * Turn emphasized mode on/off
     *
     * @param boolean $on true for emphasis, false for no emphasis
     *
     * @return $this
     */
    public function setEmphasis($on = true)
    {
        return $this->send(EscPos::CTL_ESC . "E" . ($on ? chr(1) : chr(0)));
    }

    /**
     * Turn double size
     *
     * @param boolean $on true for double size, false for normal
     *
     * @return $this
     */
    public function setDoubleSize($on = true)
    {

        $size = $on ? chr(EscPos::MODE_DOUBLE_HEIGHT + EscPos::MODE_DOUBLE_WIDTH) : chr(0);

        return $this->send(EscPos::CTL_ESC . chr(33) . $size);
    }

    /**
     * Turn double-strike mode on/off
     *
     * @param boolean $on true for double strike, false for no double strike
     *
     * @return $this
     */
    public function setDoubleStrike($on = true)
    {
        return $this->send(EscPos::CTL_ESC . "G" . ($on ? chr(1) : chr(0)));
    }

    /**
     * Select character font.
     * Font must be FONT_A, FONT_B, or FONT_C.
     *
     * @param int $font
     *
     * @return $this
     */
    public function setFont($font)
    {
        return $this->send(EscPos::CTL_ESC . "M" . chr($font));
    }

    /**
     * Select justification
     * Justification must be JUSTIFY_LEFT, JUSTIFY_CENTER, or JUSTIFY_RIGHT.
     */
    public function setJustification($justification)
    {
        return $this->send(EscPos::CTL_ESC . "a" . chr($justification));
    }

    /**
     * Print and reverse feed n lines
     *
     * @param int $lines number of lines to feed
     *
     * @return $this
     */
    public function feedReverse($lines = 1)
    {
        return $this->send(EscPos::CTL_ESC . "e" . chr($lines));
    }

    /**
     * Cut the paper
     *
     * @param int $mode  Cut mode, either CUT_FULL or CUT_PARTIAL
     * @param int $lines Number of lines to feed
     *
     * @return $this
     */
    public function cut($mode = EscPos::PAPER_CUT_FULL, $lines = 3)
    {
        return $this->send(EscPos::CTL_GS . "V" . chr($mode) . chr($lines));
    }

    /**
     * Set barcode height
     *
     * @param int $height Height in dots [1-255]
     *
     * @return $this
     */
    public function setBarcodeHeight($height = 162)
    {
        return $this->send(EscPos::CTL_GS . "h" . chr($height));
    }


    /**
     * Set barcode width
     *
     * @param int $width Widht [1-4]
     *
     * @return $this
     */
    public function setBarcodeWidth($width = 3)
    {
        return $this->send(EscPos::CTL_GS . 'w' . chr($width));
    }

    /**
     * St barcode text position
     *
     * @param int $mode
     *
     * @return $this
     */
    public function setBarcodeTextPosition($mode = EscPos::BARCODE_TXT_BELOW)
    {
        return $this->send(EscPos::CTL_GS . 'H' . chr($mode));
    }

    /**
     * Set barcode font
     *
     * @param int $font
     *
     * @return $this
     */
    public function setBarcodeFont($font = EscPos::BARCODE_FONT_A)
    {
        return $this->send(EscPos::CTL_GS . 'f' . chr($font));
    }

    /**
     * Print a barcode
     *
     * @param string $content
     * @param int    $type
     *
     * @return $this
     */
    public function barcode($content, $type = EscPos::BARCODE_CODE39)
    {
        if($type >= 0 && $type <= 6 ){
            return $this->send(EscPos::CTL_GS . "k" . chr($type) . $content . EscPos::NUL);
        }else if($type >= 65 && $type <= 73 ){
            return $this->send(EscPos::CTL_GS . "k" . chr($type) . chr(strlen($content)) . $content);
        }
    }

    public function image($resource, $width = null, $height = null)
    {
        $img = \Intervention\Image\ImageManagerStatic::make($resource);

        if ($width != null && $height != null) {
            $img->fit($width, $height);
        } elseif ($width != null || $height != null) {
            $img->resize($width, $height, function ($constraint) {

                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        //$w = $img->width();
        $h = $img->height();

        $this->send(EscPos::CTL_GS);
        $this->send('v');
        $this->send(chr(48));
        $this->send(chr(0));
        $this->send(4);
        $this->send(chr(0));
        $this->send(chr($h));
        $im = $img->getCore();

        return $this->send($this->getImageRawData($im));
    }

    protected function getImageRawData($im)
    {

        $data = "";

        $w = imagesx($im); // image width
        $h = imagesy($im); // image height
        for($x = 0; $x < $h; $x++) {
            for($y = 0; $y < $w; $y++) {
                $rgb = imagecolorat($im, $y, $x);
                $r = ($rgb >> 16) & 0xFF;
                $g = ($rgb >> 8) & 0xFF;
                $b = $rgb & 0xFF;
                $gray = (int)(($r + $g + $b) / 3);

                $data .= chr($gray);
            }
        }


        return $data;
    }

    protected function send($data)
    {
        $this->device->write($data);

        return $this;
    }
}
