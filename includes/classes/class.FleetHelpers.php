<?php
if(!defined('INSIDE')){ die(header ( 'location:../../' ));}

class FleetHelpers {

    static function is_discoverable($randarRange,$fleetX,$FleetY,$ColonyX,$colonyY):bool {
        if(sqrt(($fleetX - $ColonyX)**2 + ($colonyY - $FleetY)) <= $randarRange){
            return true;
        }else{
            return false;
        }
    }
    
}