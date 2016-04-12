ESC/POS command SDK in PHP
==========================

**Note:** This library is no longer being maintained. I'm not responding to issues or pull requests, since I don't use this project anymore and don't have time to work on it. Please feel free to fork it if you want to continue development on it. Or you can use [this](https://github.com/mike42/escpos-php) library instead.


This library implements a subset of Epson's ESC/POS protocol for thermal receipt printers. It allows you to print receipts with basic formatting, cutting, and barcode printing on a compatible printer.

It is intended for **Epson TM-T70** model, But other printers, produced by Epson or other vendors use the same standard, may also work.

Basic usage
-----------

```php
<?php
//$device = new \Epson\Devices\NetworkPrinter('10.x.x.x');
$device = \Epson\Devices\Serial::create('/dev/tty0');
$printer = new \Epson\Printer($device);
$printer -> text("Hello World!\n");
$printer -> cut();

```

Attribution
-----------
This library is a modified version of escpos-php, a Library to work with ESC/POS thermal printers, implemented by Michael Billington. Further documentation is available at [https://github.com/mike42/escpos-php](https://github.com/mike42/escpos-php).

Unit testing
------------
After the composer install in the same folder:

`./vendor/bin/phpunit`

Reference
==========

* [FAQ about ESC/POS® from Epson](http://content.epson.de/fileadmin/content/files/RSD/downloads/escpos.pdf)   
* [TM-T70 supported commands](https://reference.epson-biz.com/modules/ref_escpos/index.php?content_id=80)




