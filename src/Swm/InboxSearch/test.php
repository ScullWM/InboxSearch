<?php

use Swm\InboxSearch\Factory\InboxSearchFactory;

include('Model/InboxSearchInterface.php');
include('Factory/InboxSearchFactory.php');
include('Model/DatesTrait.php');
include('Model/InboxSearch.php');
include('FilterModel/FilterInterface.php');
include('FilterModel/FilenameFilter.php');

include('FilterModel/SizeFilter.php');
include('FilterModel/HasFilter.php');
include('FilterModel/FromFilter.php');
include('FilterModel/ToFilter.php');
include('FilterModel/SubjectFilter.php');
include('FilterModel/LabelFilter.php');
include('FilterModel/DeliveredToFilter.php');
include('FilterModel/AfterFilter.php');
include('FilterModel/BeforeFilter.php');
include('FilterModel/OlderFilter.php');
include('FilterModel/NewerFilter.php');
include('FilterModel/InFilter.php');



$factory = new InboxSearchFactory('from:thomas@scullwm.com forum');
$r = $factory->process();

var_dump($r);