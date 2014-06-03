ESC/POS command SDK in PHP
==========================

This library implements a subset of Epson's ESC/POS protocol for thermal receipt printers. It allows you to print receipts with basic formatting, cutting, and barcode printing on a compatible printer.

It is intended for **Epson TM-T70** model, But other printers, produced by Epson or other vendors use the same standard, may also work.

Basic usage
-----------

```php
<?php
$device = new \Epson\Devices\NetworkPrinter('"10.x.x.x"');
$printer = new \Epson\Printer($device);
$printer -> text("Hello World!\n");
$printer -> cut();

```


Reference
==========

* [FAQ about ESC/POS® from Epson](http://content.epson.de/fileadmin/content/files/RSD/downloads/escpos.pdf)   
* [TM-T70 supported commands](https://reference.epson-biz.com/modules/ref_escpos/index.php?content_id=80)




