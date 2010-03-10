<?php
require_once dirname(__FILE__).'/../bootstrap/unit.php';

$t = new lime_test(3);

$http=new exTransmissionBaseApi('192.168.1.250','9091');

//Get the session
$t->info("::getTransmissionSeessionId()");
$ret = $http->getTransmissionSessionId();
$t->info('Got '.$ret);
$t->isnt($ret,'','The return shouldn\'t be empty null');


//Add a torrent using the api
$method="torrent-add";
$download_dir="download-dir";
$filename="";

$method = 'torrent-get';
$data= array(
					'fields'=>array(
											'torrentFile',
											'doneDate',
											'percentDone',
											'seedRatioLimit'));
$ret = $http->callTransmission('torrent-get',$data);

$size = sizeof($ret->arguments->torrents);
$t->is($ret->result,'success','The result set was successfull');
$t->is($size > 0,true,'The array is greater than 0 '.$size);






