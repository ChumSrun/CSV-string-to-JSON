<?php
header('Content-Type: Application/JSON');
$csvData = file_get_contents('https://raw.githubusercontent.com/CSSEGISandData/COVID-19/master/csse_covid_19_data/csse_covid_19_time_series/time_series_19-covid-Confirmed.csv');

function stringCSVtoJSON($csv)
{
  $lines = explode("\n", $csv);
  $result = [];
  $headers = explode(",", $lines[0]);
  for ($i = 1; $i < count($lines); $i++) {
    $currentArray = [];
    $currentLines = explode(',', $lines[$i]);
    for ($j = 0; $j < count($headers); $j++) {
      $currentArray[str_replace("\r", "", $headers[$j])] = str_replace("\r", "", $currentLines[$j]);
    }
    array_push($result, $currentArray);
  }
  return json_encode($result);
}
echo stringCSVtoJSON($csvData);
