<?php
$pathinfo = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
if(!$pathinfo)
    exit;
$pathinfo = str_replace('%3F','?', $pathinfo);
$xml = file_get_contents('http://pb.voip.ovh.net'.$pathinfo);

$xml = preg_replace_callback('#<URL>http://pb.voip.ovh.net(.+)</URL>#',function($matches){
    return '<URL>http'.(isset($_SERVER['HTTPS']) ? 's' : '').'://'.$_SERVER['HTTP_HOST'].$_SERVER['SCRIPT_NAME'].str_replace('?','%3F',$matches[1]).'</URL>';
}, $xml);

$xml = preg_replace_callback('#<Telephone>0033(.*)</Telephone>#',function($matches){
    return '<Telephone>'.($matches[1] ? '0'.$matches[1] : '').'</Telephone>';
}, $xml);

header('Content-Type: application/xml');
echo $xml;
