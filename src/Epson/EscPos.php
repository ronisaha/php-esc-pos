<?php
/**
 * ESC/POS Constants Class
 *
 * Class holding all ESC/POS constants
 *
 * @package		ESC/POS command SDK
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

class EscPos
{
    /* Feed Control */
    const NUL = "\x00";
    const CTL_ESC = "\x1b";
    const CTL_LF = "\x0a";                # Print and line feed
    const CTL_GS = "\x1d";
    const CTL_FF    = "\x0c";             # Form feed
    const CTL_CR    = "\x0d";             # Carriage return
    const CTL_HT    = "\x09";             # Horizontal tab
    const CTL_VT    = "\x0b";             # Vertical tab

    /* Print mode constants */
    const MODE_FONT_A = 0;
    const MODE_FONT_B = 1;
    const MODE_EMPHASIZED = 8;
    const MODE_DOUBLE_HEIGHT = 16;
    const MODE_DOUBLE_WIDTH = 32;
    const MODE_UNDERLINE = 128;

    /* Fonts */
    const FONT_A = 0;
    const FONT_B = 1;
    const FONT_C = 2;

    /* Justifications */
    const JUSTIFY_LEFT = 0;
    const JUSTIFY_CENTER = 1;
    const JUSTIFY_RIGHT = 2;

    /* Paper Cut types */
    const PAPER_CUT_FULL = 65;
    const PAPER_CUT_PARTIAL = 66;

    /* Barcode types */
    const BARCODE_UPCA = 0;
    const BARCODE_UPCE = 1;
    const BARCODE_JAN13 = 2;
    const BARCODE_JAN8 = 3;
    const BARCODE_CODE39 = 4;
    const BARCODE_ITF = 5;
    const BARCODE_NW7 = 6;
    const BARCODE2_UPCA = 65;
    const BARCODE2_UPCE = 66;
    const BARCODE2_JAN13 = 67;
    const BARCODE2_JAN8 = 68;
    const BARCODE2_CODE39 = 69;
    const BARCODE2_ITF = 70;
    const BARCODE2_NW7 = 71;
    const BARCODE2_CODE93 = 72;
    const BARCODE2_CODE128 = 73;

    # Barcode format
    const BARCODE_TXT_OFF = 0; # HRI barcode chars OFF
    const BARCODE_TXT_ABOVE = 1; # HRI barcode chars above
    const BARCODE_TXT_BELOW = 2; # HRI barcode chars below
    const BARCODE_TXT_BOTH = 3; # HRI barcode chars both above and below
    const BARCODE_FONT_A = 0; # Font type A for HRI barcode chars
    const BARCODE_FONT_B = 1; # Font type B for HRI barcode chars
    const BARCODE_HEIGHT = 104; # Barcode Height [1-255]
    const BARCODE_WIDTH = 3; # Barcode Width  [2-6]
}
