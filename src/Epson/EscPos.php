<?php
/**
 * ESC/POS Constants Class
 *
 * Class holding all ESC/POS constants
 *
 * @package		ESC/POS command SDK
 * @author		Roni Saha <roni.cse@gmail.com>
 *
 */
namespace Epson;

class EscPos
{
    /* ASCII codes */
    const NUL = "\x00";
    const LF = "\x0a";
    const ESC = "\x1b";
    const GS = "\x1d";

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

    /* Cut types */
    const CUT_FULL = 65;
    const CUT_PARTIAL = 66;

    /* Barcode types */
    const BARCODE_UPCA = 0;
    const BARCODE_UPCE = 1;
    const BARCODE_JAN13 = 2;
    const BARCODE_JAN8 = 3;
    const BARCODE_CODE39 = 4;
    const BARCODE_ITF = 5;
    const BARCODE_CODABAR = 6;
} 