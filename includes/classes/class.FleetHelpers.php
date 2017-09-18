<?php
if(!defined('INSIDE')){ die(header ( 'location:../../' ));}

class FleetHelpers {

    static function is_discoverable($randarRange,$FleetX,$FleetY,$ColonyX,$ColonyY):bool {
        if(self::fleet_distance($FleetX,$FleetY,$ColonyX,$ColonyY) <= $randarRange){
            return true;
        }else{
            return false;
        }
    }

    static function fleet_distance($fleet1X,$fleet1Y,$fleet2X,$Fleet2Y){
        return sqrt(($fleet1X - $fleet2X)**2 + ($Fleet2Y - $fleet1Y)**2);
    }
}