<?php
/**
 * Chart! Module Entry Point
 *
 * @package		Joomla 2.5.0
 * @subpackage	mod_chart
 * @author		Daniel Huber
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Include the syndicate functions only once
require_once (dirname(__FILE__) . DS . 'helper.php');

$uniqid = $module -> id;
$db = &JFactory::getDBO();
$db2 = &JFactory::getDBO();
$db3 = &JFactory::getDBO();
$query = "SELECT time, trend, spi FROM a514u_trend";

$button = "B1";
$button2 = "B2";
$button3 = "B3";

$BCtitle = "Bond Corporates" ;
$BGtitle = "Bond Government"; 
$Ctitle = "Commodity"; 
$PMtitle = "Precious Metals";
$Etitle = "Equity"; 
$REtitle = "Real Estate"; 
$Rtitle = "Asset Allocation"; 
$Ftitle = "Filter"; 


$tester = 'Heute ist der ';

$width = 900;

$height = 500;


$hello = modChartHelper::getFunktion();
$datum_ausgabe = modChartHelper::getFunktion2($tester);
$text_ausgabe = modChartHelper::getFunktion3('Sirtaki');
$corporates = modChartHelper::createBondCorporateChart($uniqid, $BCtitle, $width, $height);
$government = modChartHelper::createBondGovernmentChart($uniqid, $BGtitle, $width, $height);
$commodity = modChartHelper::createCommodityChart($uniqid, $Ctitle, $width, $height);
$preciousMetals = modChartHelper::createPreciousMetalsChart($uniqid, $PMtitle, $width, $height);
$equity= modChartHelper::createEquityChart($uniqid, $Etitle, $width, $height);
$realEstate= modChartHelper::createRealEstateChart($uniqid, $REtitle, $width, $height);
$bubble= modChartHelper::createBubbleChart($uniqid, $Rtitle , $width, $height);
//$filter= modChartHelper::createFilterChart($uniqid, $Ftitle, $width, $height);
//$test3 = modChartHelper::createChart3($uniqid, $title3, $width, $height, $dbcontent3);
$doc = JFactory::getDocument();
$doc -> addScript('https://www.google.com/jsapi');
//Add chart api script
//$doc -> addScriptDeclaration($scripts);
require (JModuleHelper::getLayoutPath('mod_chart'));
?>
