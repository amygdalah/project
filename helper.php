<?php
/**
 * Helper class for chart module
 *
 * @package		Joomla 2.5.0
 * @subpackage	mod_chart
 * @author		Daniel Huber
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

date_default_timezone_set('UTC');
class modChartHelper {
	/**
	 * Retrieves the hello message
	 *
	 * @param array $params An object containing the module parameters
	 * @access public
	 */
	public static function getFunktion() {
		return 'Anlageklassen';

	}

	public static function getFunktion2($params) {
		$datum = date('l jS \of F Y h:i:s A');
		$ausgabe = $params . $datum;

		return $ausgabe;
	}

	public static function getFunktion3($parameter_aus_controller) {

		$textwert = 'Wir lesen Parameter aus: ';
		$ausgelesen = $parameter_aus_controller;
		$ausgabe2 = $textwert . $ausgelesen;

		return $ausgabe2;
	}

	public static function getDBcontent($db, $query) {
		$db = &JFactory::getDBO();
		$query = "SELECT time, trend, spi FROM a514u_trend";
		$db -> setQuery($query);
		$results = $db -> loadObjectList();
		$res = "['time', 'Trend', 'SPI'],";
		$counter = 0;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				//$trend2 = $trend * 10 + 700;
				$trend2 = $trend;
				$spi = $result -> spi;
				$res .= "['$time2', $trend, $spi],";
			}
			$counter = $counter + 1;
		}
		$neu = substr($res, 0, -1);
		return $neu;
	}

	public static function getDBcontent2($db, $query) {
		$db2 = &JFactory::getDBO();
		$query = "SELECT time, trend, data FROM a514u_edelmetall";
		$db2 -> setQuery($query);
		$results = $db2 -> loadObjectList();
		$res = "['time', 'Trend', 'Data'],";
		$counter = 0;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				//$trend2 = $trend * 10 + 700;
				$trend2 = $trend;
				$spi = $result -> data;
				$res .= "['$time2', $trend, $spi],";
			}
			$counter = $counter + 1;
		}
		$neu = substr($res, 0, -1);
		return $neu;
	}

	public static function createBondCorporateChart($tmp, $title, $width, $height) {
		$dbBC = &JFactory::getDBO();
		$query = "SELECT time, trend, value FROM a514u_bondcorporate";
		$dbBC -> setQuery($query);
		$results = $dbBC -> loadObjectList();
		$res = "['time', 'trend', 'value'],";
		$counter = 0;
		$test = 0.0;
		$trend2 = '';
		$flag = true;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				$value = $result -> value;
				if ($trend == $test && $flag) {
					$res .= "['$time2', $trend2, $value],";
				} else {
					$flag = false;
					$value = $result -> value;
					$res .= "['$time2', $trend, $value],";
				}
				//$trend2 = $trend * 10 + 700;
			}
			$counter = $counter + 1;
		}
		$BCData = substr($res, 0, -1);
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom'}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		$options .= ",lineWidth: 2.5";
		$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		$chart_data = $BCData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "LineChart";
		$chart_galllery2 = "ScatterChart";
		$package = 'corechart';
		//$package = 'controls';
		$scripts = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart);
				function drawChart() {
				var data = google.visualization.arrayToDataTable([' . trim($chart_data, ',') . ']);
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("bondcorporates_div_' . $uniqid . '"));
				chart.draw(data, options);
				}';

		$doc = JFactory::getDocument();
		$doc -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc -> addScriptDeclaration($scripts);
	}

	public static function createBondGovernmentChart($tmp, $title, $width, $height) {
		$dbBG = &JFactory::getDBO();
		$query = "SELECT time, trend, value FROM a514u_bondgovernment";
		$dbBG -> setQuery($query);
		$results = $dbBG -> loadObjectList();
		$res = "['time', 'trend', 'value'],";
		$counter = 0;
		$test = 0.0;
		$trend2 = '';
		$flag = true;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				$value = $result -> value;
				if ($trend == $test && $flag) {
					$res .= "['$time2', $trend2, $value],";
				} else {
					$flag = false;
					$value = $result -> value;
					$res .= "['$time2', $trend, $value],";
				}
				//$trend2 = $trend * 10 + 700;
			}
			$counter = $counter + 1;
		}
		$BGData = substr($res, 0, -1);
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 12}}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		$options .= ",lineWidth: 2.5";
		$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		$chart_data2 = $BGData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "LineChart";
		$chart_galllery2 = "ScatterChart";
		$package = 'corechart';
		//$package = 'controls';
		$scripts2 = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart2);
				function drawChart2() {
				var data = google.visualization.arrayToDataTable([' . trim($chart_data2, ',') . ']);
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("bondgovernment_div_' . $uniqid . '"));
				chart.draw(data, options);
				}';

		$doc2 = JFactory::getDocument();
		$doc2 -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc2 -> addScriptDeclaration($scripts2);
	}

	public static function createCommodityChart($tmp, $title, $width, $height) {
		$dbC = &JFactory::getDBO();
		$query = "SELECT time, trend, value FROM a514u_commodity";
		$dbC -> setQuery($query);
		$results = $dbC -> loadObjectList();
		$res = "['time', 'trend', 'value'],";
		$counter = 0;
		$test = 0.0;
		$trend2 = '';
		$flag = true;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				$value = $result -> value;
				if ($trend == $test && $flag) {
					$res .= "['$time2', $trend2, $value],";
				} else {
					$flag = false;
					$value = $result -> value;
					$res .= "['$time2', $trend, $value],";
				}
				//$trend2 = $trend * 10 + 700;
			}
			$counter = $counter + 1;
		}
		$CData = substr($res, 0, -1);
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 12}}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		$options .= ",lineWidth: 2.5";
		$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		$chart_data2 = $CData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "LineChart";
		$chart_galllery2 = "ScatterChart";
		$package = 'corechart';
		//$package = 'controls';
		$scripts = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart3);
				function drawChart3() {
				var data = google.visualization.arrayToDataTable([' . trim($chart_data2, ',') . ']);
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("commodity_div_' . $uniqid . '"));
				chart.draw(data, options);
				}';

		$doc2 = JFactory::getDocument();
		$doc2 -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc2 -> addScriptDeclaration($scripts);
	}

	public static function createEquityChart($tmp, $title, $width, $height) {
		$dbE = &JFactory::getDBO();
		$query = "SELECT time, trend, value FROM a514u_equity";
		$dbE -> setQuery($query);
		$results = $dbE -> loadObjectList();
		$res = "['time', 'trend', 'value'],";
		$counter = 0;
		$test = 0.0;
		$trend2 = '';
		$flag = true;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				$value = $result -> value;
				if ($trend == $test && $flag) {
					$res .= "['$time2', $trend2, $value],";
				} else {
					$flag = false;
					$value = $result -> value;
					$res .= "['$time2', $trend, $value],";
				}
				//$trend2 = $trend * 10 + 700;
			}
			$counter = $counter + 1;
		}
		$EData = substr($res, 0, -1);
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 12}}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		$options .= ",lineWidth: 2.5";
		$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		$chart_data2 = $EData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "LineChart";
		$chart_galllery2 = "ScatterChart";
		$package = 'corechart';
		//$package = 'controls';
		$scripts2 = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart4);
				function drawChart4() {
				var data = google.visualization.arrayToDataTable([' . trim($chart_data2, ',') . ']);
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("equity_div_' . $uniqid . '"));
				chart.draw(data, options);
				}';

		$doc2 = JFactory::getDocument();
		$doc2 -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc2 -> addScriptDeclaration($scripts2);
	}

	public static function createPreciousMetalsChart($tmp, $title, $width, $height) {
		$dbPM = &JFactory::getDBO();
		$query = "SELECT time, trend, value FROM a514u_preciousmetals";
		$dbPM -> setQuery($query);
		$results = $dbPM -> loadObjectList();
		$res = "['time', 'trend', 'value'],";
		$counter = 0;
		$test = 0.0;
		$trend2 = '';
		$flag = true;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				$value = $result -> value;
				if ($trend == $test && $flag) {
					$res .= "['$time2', $trend2, $value],";
				} else {
					$flag = false;
					$value = $result -> value;
					$res .= "['$time2', $trend, $value],";
				}
				//$trend2 = $trend * 10 + 700;
			}
			$counter = $counter + 1;
		}
		$PMData = substr($res, 0, -1);
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 12}}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		$options .= ",lineWidth: 2.5";
		$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		$chart_data2 = $PMData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "LineChart";
		$chart_galllery2 = "ScatterChart";
		$package = 'corechart';
		//$package = 'controls';
		$scripts2 = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart5);
				function drawChart5() {
				var data = google.visualization.arrayToDataTable([' . trim($chart_data2, ',') . ']);
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("preciousmetals_div_' . $uniqid . '"));
				chart.draw(data, options);
				}';

		$doc2 = JFactory::getDocument();
		$doc2 -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc2 -> addScriptDeclaration($scripts2);
	}

	public static function createRealEstateChart($tmp, $title, $width, $height) {
		$dbRE = &JFactory::getDBO();
		$query = "SELECT time, trend, value FROM a514u_realestate";
		$dbRE -> setQuery($query);
		$results = $dbRE -> loadObjectList();
		$res = "['time', 'trend', 'value'],";
		$counter = 0;
		$test = 0.0;
		$trend2 = '';
		$flag = true;
		date_default_timezone_set('UTC');

		// Start date
		$date = '2009-12-06';
		// End date
		$end_date = '2020-12-31';
		$dataArray = array();
		$indexCounter = 0;
		foreach ($results as $result) {
			if ($counter % 1 == 0) {
				$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
				$dateArray = explode('-', $date);
				$year = $dateArray[0];
   				$month = $dateArray[1] - 1; // subtract 1 since javascript months are zero-indexed
    			$day = $dateArray[2];
				$date2 = $year.','.$month.','.$day;
				
				$time = $result -> time;
				$time2 = "";
				$trend = $result -> trend;
				$value = $result -> value;
				$month2 = $month;
				$dataArray[$indexCounter] = "new Date($year, $month2, $day)";
				$indexCounter++;
				$dataArray[$indexCounter] = $trend;
				$indexCounter++;
				$dataArray[$indexCounter] = $value;
				$indexCounter++;
				/*if ($trend == $test && $flag) {
					$res .= "[$year,$month,$day,$trend2, $value],";
				} else {
					$flag = false;
					$value = $result -> value;
					$res .= "[$year,$month,$day,$date2, $trend, $value],";
				}*/
				//$trend2 = $trend * 10 + 700;
			}
			$counter = $counter + 1;
		}
		$js_array = json_encode($dataArray);
		//echo $js_array;
		// $REData = substr($res, 0, -1);
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 12}}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		$options .= ",lineWidth: 2.5";
		$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		//$chart_data2 = $REData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "LineChart";
		$chart_galllery2 = "ScatterChart";
		$package = 'corechart';
		//var data2 = google.visualization.arrayToDataTable([' . trim($js_array, ',') . ']);
		//$package = 'controls';
		$scripts2 = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart6);
				function drawChart6() {
				var data2 = google.visualization.arrayToDataTable([' . trim($js_array, ',') . ']);
				var data =var data = new google.visualization.DataTable();
				data.addColumn(\'date\', \'Task\');
				data.addColumn(\'number\', \'trend\');
				data.addColumn(\'number\', \'value\');
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("realestate_div_' . $uniqid . '"));
				chart.draw(data2, options);
				}';

		$doc2 = JFactory::getDocument();
		$doc2 -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc2 -> addScriptDeclaration($scripts2);
	}

	public static function createBubbleChart($tmp, $title, $width, $height) {
		$uniqid = $tmp;
		$options2 = '';
		$options2 .= ",width: {$width}";
		$options2 .= ",height: {$height}";
		$options = '';
		$options .= ",title: \"{$title}\"";
		$options .= ",titlePosition: \"out\"";
		$options .= ",legend: {position: 'bottom', textStyle: {color: 'black', fontSize: 12}}";
		$options .= ",width: {$width}";
		$options .= ",height: {$height}";
		//$options .= ",vAxis: {minValue: 500, maxValue: 1100}";
		//$options .= ",lineWidth: 2.5";
		//$options .= ",pointSize: 0";
		//$options .= ",seriesType: \"steppedArea\"";
		//$options .= ",curveType: \"function\"";
		//$options .= ",seriesType: \"line\"";
		//$options .= ",series: {0: {type: \"line\"}}";
		//$options .= ", animation:{duration: 1000, easing: 'inAndOut',}";
		//$options .= ", vAxes: {0: {logScale: false,  title: \"Value-Axis\"}, 1: {logScale: false, title: \"Trend-Axis\"}}";
		//$options .= ", series:{0:{targetAxisIndex:1}, 1:{targetAxisIndex:0}}";
		//$options .=  ",selectionMode: 'multiple', tooltip: { trigger: 'selection' }, aggregationTarget: 'category'";
		//$width = 600;
		//$height = 1200;
		//$chart_data = "['Task', 'Hours per Day'],['Work', 11],['Eat', 2],['Commute',2],['Watch TV', 2],['Sleep', 7]";
		//$chart_data2 = $REData;
		//$chart_data2 = $dbString;
		//$chart_title = "PieChart";
		//$hAxis = $params -> get('hAxis');
		//$vAxis = $params -> get('vAxis');
		//$colors = $params -> get('colors');
		//$is3D = $params -> get('is3D');
		//$chart_galllery = "ComboChart";
		$chart_galllery = "BubbleChart";
		$package = 'corechart';
		//$package = 'controls';
		$scripts2 = 'google.load("visualization", "1", {packages:["' . $package . '"]});
				google.setOnLoadCallback(drawChart8);
				function drawChart8() {
				 var data = google.visualization.arrayToDataTable([
     					 [\'ID\', \'Trend\', \'Prozent\'],
      					 [\'Bond Corporates\',    24.66,  30.00],
     					 [\'Bond Government\',    12.09,  35.00],
     					 [\'Commodity\',    10.00,         20.00],
     					 [\'Precious Metals\',    15.09,   45.00],
     					 [\'Equity\',    9.09,           20.00],
     					 [\'Real Estate"\',    8.09,      30.00]
   				 ]);
				var options = {' . trim($options, ',') . '};
				var chart = new google.visualization.' . $chart_galllery . '(document.getElementById("bubble_div_' . $uniqid . '"));
				chart.draw(data, options);
				}';

		$doc2 = JFactory::getDocument();
		$doc2 -> addScript('https://www.google.com/jsapi');
		//Add chart api script*/
		//$doc -> addScriptDeclaration($scripts);
		$doc2 -> addScriptDeclaration($scripts2);
	}


	function get_youtube_embed($youtube_video_id, $autoplay = false) {
		$embed_code = "";

		if ($autoplay)
			$embed_code = '<embed src="http://www.youtube.com/v/' . $youtube_video_id . '&rel=1&autoplay=1" pluginspage="http://adobe.com/go/getflashplayer" type="application/x-shockwave-flash" quality="high" width="480" height="395" bgcolor="#ffffff" loop="false"></embed>';
		else
			$embed_code = '<embed src="http://www.youtube.com/v/' . $youtube_video_id . '&rel=1" pluginspage="http://adobe.com/go/getflashplayer" type="application/x-shockwave-flash" quality="high" width="450" height="376" bgcolor="#ffffff" loop="false"></embed>';
		return $embed_code;
	}

}
?>
