<?php
if (isset($_REQUEST['legclient'])) $filename = 'FogService.zip';
if (isset($_REQUEST['newclient'])) $filename = 'FOGService.msi';
if (isset($_REQUEST['fogprep'])) $filename = 'FogPrep.zip';
if (isset($_REQUEST['fogcrypt'])) $filename = 'FOGCrypt.zip';
if (!file_exists($filename)) exit;
$file = basename($filename);
ob_start();
header("X-Sendfile: $filename");
header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header("Content-Disposition: attachment; filename=$file");
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Connection: close');
if (($fh = fopen($file,'rb')) === false) exit;
while (feof($fh) === false) {
    if (($line = fread($fh,4092)) === false) break;
    echo $line;
}
fclose($fh);
flush();
ob_flush();
ob_end_flush();
exit;
