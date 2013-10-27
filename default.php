<?php /**
 * default class for Chart module
 *
 * @package		Joomla 2.5.0
 * @subpackage	mod_chart
 * @author		Daniel Huber
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
$doc = JFactory::getDocument();
$doc2 = JFactory::getDocument();
$chart = "";
$chart2 = "";
$chart3 = "";
defined('_JEXEC') or die('Restricted access');
?>

<table>
<form id="form1" name="tets" method="post">
<td><input name='$button7' class="myButton2"  type="submit" value="Home" /></td>
<td><input name='$button' class="myButton" type="submit" value="Bond Corporates" /></td>
<td><input name='$button2' class="myButton"  type="submit" value="Bond Government" /></td>
<td><input name='$button3' class="myButton"  type="submit" value="Commodity"/></td>
<td><input name='$button4' class="myButton"  type="submit" value="Precious Metals"/></td>
<td><input name='$button5' class="myButton"  type="submit" value="Equity" /></td>
<td><input name='$button6' class="myButton"  type="submit" value="Real Estate" /></td>
</form>
</table>

<?php
if (isset($_POST['$button'])){
	$chart = "bondcorporates_div_";
}
if (isset($_POST['$button2'])){
	$chart = "bondgovernment_div_";
}
if (isset($_POST['$button3'])){
	$chart = "commodity_div_";
}
if (isset($_POST['$button4'])){
	$chart = "preciousmetals_div_";
}
if (isset($_POST['$button5'])){
	$chart = "equity_div_";
}
if (isset($_POST['$button6'])){
	$chart = "realestate_div_";
}
if(isset($_POST['$button7']) || !(isset($_POST['$button6'])) && !(isset($_POST['$button5'])) && !(isset($_POST['$button4'])) && !(isset($_POST['$button3'])) && !(isset($_POST['$button2'])) && !(isset($_POST['$button']))){
	$chart = "bubble_div_";
}
?>

<div id="<?php echo $chart ?><?php echo $uniqid ?>" class="chart"></div>
<div id="<?php echo $chart2 ?><?php echo $uniqid ?>" class="chart"></div>
<div id="<?php echo $chart3 ?><?php echo $uniqid ?>" class="chart"></div>


<style>

    .myButton {
        
        -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
        box-shadow:inset 0px 1px 0px 0px #ffffff;
        
        background-color:#ffffff;
        
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        
        border:1px solid #dcdcdc;
        
        display:inline-block;
        color:#666666;
        font-family:arial;
        font-size:12px;
        font-weight:bold;
        padding:6px 24px;
        text-decoration:none;
        
        text-shadow:0px 1px 0px #ffffff;
        
    }
    .myButton:hover {
        
        background-color:#f6f6f6;
    }
    .myButton:active {
        position:relative;
        top:1px;
    }
    
    
    .myButton2 {
        
        -moz-box-shadow:inset 0px 1px 0px 0px #ffffff;
        -webkit-box-shadow:inset 0px 1px 0px 0px #ffffff;
        box-shadow:inset 0px 1px 0px 0px #ffffff;
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #ededed), color-stop(1, #dfdfdf));
        background:-moz-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
        background:-webkit-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
        background:-o-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
        background:-ms-linear-gradient(top, #ededed 5%, #dfdfdf 100%);
        background:linear-gradient(to bottom, #ededed 5%, #dfdfdf 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#ededed', endColorstr='#dfdfdf',GradientType=0);
        
        background-color:#ededed;
        
        -moz-border-radius:6px;
        -webkit-border-radius:6px;
        border-radius:6px;
        
        border:1px solid #dcdcdc;
        
        display:inline-block;
        color:#777777;
        font-family:arial;
        font-size:12px;
        font-weight:bold;
        padding:6px 24px;
        text-decoration:none;
        
        text-shadow:0px 1px 0px #ffffff;
        
    }
    .myButton2:hover {
        
        background:-webkit-gradient(linear, left top, left bottom, color-stop(0.05, #dfdfdf), color-stop(1, #ededed));
        background:-moz-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
        background:-webkit-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
        background:-o-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
        background:-ms-linear-gradient(top, #dfdfdf 5%, #ededed 100%);
        background:linear-gradient(to bottom, #dfdfdf 5%, #ededed 100%);
        filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#dfdfdf', endColorstr='#ededed',GradientType=0);
        
        background-color:#dfdfdf;
    }
    .myButton2:active {
        position:relative;
        top:1px;
    }

</style>
