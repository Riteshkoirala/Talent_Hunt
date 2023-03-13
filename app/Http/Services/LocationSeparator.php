<?php

namespace App\Http\Services;

class LocationSeparator
{

    public function trim($seekers)
    {
        $locationSave = [];
        foreach ($seekers as $seek) {
            $locationClean = preg_replace('/[^A-Za-z\, ]/', '', $seek->location);
            $locationSave[] = trim($locationClean, ', ');
        }

        return array_unique(array_map(function ($location) {
            return strtolower(trim($location, ', '));
        }, $locationSave));
    }

    public function finder($query, $location)
    {

        $makeLocation = $location;
        $locationParts = explode(", ", $makeLocation);

        $front = $locationParts[0];
        if (isset($locationParts[1])) {
            $back = $locationParts[1];
            return $query->where('location', 'LIKE', '%' . $front . '%' . '%' . $back . '%');
        }
        return $query->where('location', 'LIKE', '%' . $front . '%');


    }

    public function  LocationPurifier($location):String
    {

        $location = preg_replace('/[^A-Za-z0-9\- ]/','', $location);
        return str_replace(' ', ', ', $location);
    }

}

