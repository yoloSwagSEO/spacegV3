<?php
if(!defined('INSIDE')){ die(header ( 'location:../../' ));}

class FleetHelpers {

    static function is_discoverabl($randarRange,$FleetX,$FleetY,$FleetZ,$ColonyX,$ColonyY,$ColonyZ):bool {
        if(self::fleet_distance($FleetX,$FleetY,$FleetZ,$ColonyX,$ColonyY,$ColonyZ) <= $randarRange){
            return true;
        }else{
            return false;
        }
    }

    static function fleet_distance($fleet1X,$fleet1Y,$fleet1Z,$fleet2X,$Fleet2Y,$Fleet2Z){
        return sqrt(($fleet2X-$fleet1X)**2+($Fleet2Y-$fleet1Y)**2+($Fleet2Z-$fleet1Z)**2);
    }


}