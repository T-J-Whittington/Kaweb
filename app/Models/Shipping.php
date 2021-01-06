<?php

namespace App\Models;

use mysqli;
use PDO;

class Shipping
{
    private const WIDGET_PACKS = [
        5000,
        2000,
        1000,
        500,
        250
    ];

    /**
     * Calculates the shipping logistics based on the given order volume.
     * 
     * @param int $orderVolume Quantity of units to ship.
     * @return array
     */
    public function calculateShipping($orderVolume){
        $boxes = [];
        $remainingVolume = $orderVolume;
        foreach(self::WIDGET_PACKS as $pack){ //Calculate all the large boxes.
            $boxes[$pack] = floor($remainingVolume / $pack);
            $remainingVolume = $remainingVolume - $pack * $boxes[$pack];
        }

        if($remainingVolume > 0){ //Calculate any neccesarry remaining boxes.
            if($boxes[250] == 0){ //If there aren't any 250 boxes, add 1.
                $boxes[250] = 1;
            } else { //If a 250 box exists already, remove it and add a 500 for less packaging.
                $boxes[250] = null;
                $boxes[500] = $boxes[500] + 1;
            }
        }

        return $boxes;
    }

}

