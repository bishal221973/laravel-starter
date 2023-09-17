<?php
function getTime($date)
{
    $dateTime = new DateTime($date);
    $formattedTime = $dateTime->format("g:i A");

    return $formattedTime; // Output: "10:55 PM"
}
function getDates($date)
{
    $dateTime = new DateTime($date);
    $formattedTime = $dateTime->format("M d");

    return $formattedTime; // Output: "10:55 PM"
}
function computeTime($from, $to)
{

    $startDateTime = new DateTime($from);
    $endDateTime = new DateTime($to);
    $interval = $startDateTime->diff($endDateTime);
    $formattedDuration = $interval->format("%hh %im");

    return $formattedDuration; // Output: "2 hours 0 minutes"
}
function countArray($array)
{
    return count($array) - 1;
}

function getCity($codes)
{
    $jsonFilePath = public_path('airport.json');
    $jsonData = file_get_contents($jsonFilePath);

    $dataArray = json_decode($jsonData, true);

    if ($dataArray === null) {
        return "Error decoding JSON data.";
    } else {
        $cityNames = []; // Create an array to store matching city names

        foreach ($dataArray as $item) {
            if ($item['code'] == $codes) {
                $cityNames[] = $item['city'];
            }
        }

        if (empty($cityNames)) {
            return "No data found matching the filter condition.";
        } else {
            return $cityNames[0];
        }
    }
}

function getCountry($codes)
{
    $jsonFilePath = public_path('airport.json');
    $jsonData = file_get_contents($jsonFilePath);

    $dataArray = json_decode($jsonData, true);

    if ($dataArray === null) {
        return "Error decoding JSON data.";
    } else {
        $countryName = []; // Create an array to store matching city names

        foreach ($dataArray as $item) {
            if ($item['code'] == $codes) {
                $countryName[] = $item['country'];
            }
        }

        if (empty($countryName)) {
            return "No data found matching the filter condition.";
        } else {
            return $countryName[0];
        }
    }
}

function segment($segmentId){
    return $segmentId;
}
