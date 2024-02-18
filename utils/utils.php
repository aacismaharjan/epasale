<?php

// This alert is use show javascript alert
// This dd function is to used to debug
// Also, It is used to print values of any variable.
class Alert {
    public static function show($message) {
        echo "<script>alert('$message');</script>";
    }

    public static function dd($myvar) {
        $arrayString = print_r($myvar, true);
        echo "<pre>{$arrayString}</pre>";
    }
}


// Takes allowed roles and returns true if a user has that role
function hasRole($userRoles, $allowedRoles) {
    if (isset($_SESSION["roles"]) && is_array($_SESSION["roles"])) {
        return count(array_intersect($_SESSION["roles"], $allowedRoles)) > 0;
    }
    return false;
}


// If user not not allowed, redirect to homepages
function hasPermission($allowedRoles) {
    if(hasRole($_SESSION["roles"], $allowedRoles) == false) {
        header("Location: /epasale?error=err_no_access");
        exit;
    }
}



// Simple GeoLocation class to represent location co-ordinates
class GeoLocation {
    public $latitude;
    public $longitude;

    public function __construct($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }
}


// This class has haversine formula
// This calculates the distance between
// Two locations and returns in km
class Locator {
    public GeoLocation $source;
    public GeoLocation $target;

    public function __construct($source, $target) {
        $this->source = $source;
        $this->target = $target;
    }

    public static function haversineDistance(GeoLocation $source, GeoLocation $target) {
        // Radius of the Earth in kilometers
        $earthRadius = 6371;
    
        // Convert latitude and longitude from degrees to radians
        $sourceLat = deg2rad($source->getLatitude());
        $sourceLng = deg2rad($source->getLongitude());
        $targetLat = deg2rad($target->getLatitude());
        $targetLng = deg2rad($target->getLongitude());
    
        // Calculate the change in coordinates
        $deltaLat = $targetLat - $sourceLat;
        $deltaLng = $targetLng - $sourceLng;
    
        // Haversine formula
        $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
            cos($sourceLat) * cos($targetLat) *
            sin($deltaLng / 2) * sin($deltaLng / 2);
    
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
    
        // Calculate the distance
        $distance = $earthRadius * $c;
    
        return $distance;
    }

    public function getDistance() {
       $distance = $this->haversineDistance($this->source, $this->target);
       return number_format($distance, 1);
    }

    public function showDistance() {
        return ("(<i class=\"fas fa-bicycle\"></i> " . $this->getDistance() . "km)");
    }
}