<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

function HandleElementCasernQueue ( $CurrentUser, &$CurrentPlanet, $ProductionTime )
{
	global $resource;

	if ($CurrentPlanet['b_casern_id'] != 0)
	{
		$Builded                    = array ();
		$CurrentPlanet['b_casern'] += $ProductionTime;
		$BuildQueue                 = explode(';', $CurrentPlanet['b_casern_id']);
		$BuildArray					= array();

		foreach ($BuildQueue as $Node => $Array)
		{
			if ($Array != '')
			{
				$Item              = explode(',', $Array);
				$AcumTime		   = GetBuildingTime ($CurrentUser, $CurrentPlanet, $Item[0]);
				$BuildArray[$Node] = array($Item[0], $Item[1], $AcumTime);
			}
		}

		$CurrentPlanet['b_casern_id'] 	= '';
		$UnFinished 					= FALSE;

		foreach ( $BuildArray as $Node => $Item )
		{
			$Element   			= $Item[0];
			$Count     			= $Item[1];
			$BuildTime 			= $Item[2];
			$Builded[$Element] 	= 0;

			if (!$UnFinished and $BuildTime > 0)
			{
				$AllTime = $BuildTime * $Count;

				if($CurrentPlanet['b_casern'] >= $BuildTime)
				{
					$Done = min($Count, floor( $CurrentPlanet['b_casern'] / $BuildTime));

					if($Count > $Done)
					{
						$CurrentPlanet['b_casern'] -= $BuildTime * $Done;
						$UnFinished = TRUE;
						$Count -= $Done;
					}
					else
					{
						$CurrentPlanet['b_casern'] -= $AllTime;
						$Count = 0;
					}

					$Builded[$Element] += $Done;
					$CurrentPlanet[$resource[$Element]] += $Done;

				}
				else
				{
					$UnFinished = TRUE;
				}
			}
			elseif(!$UnFinished)
			{
				$Builded[$Element] += $Count;
				$CurrentPlanet[$resource[$Element]] += $Count;
				$Count = 0;
			}
			if ( $Count != 0 )
			{
				$CurrentPlanet['b_casern_id'] .= $Element.",".$Count.";";
			}
		}
	}
	else
	{
		$Builded                   = '';
		$CurrentPlanet['b_casern'] = 0;
	}

	return $Builded;
}
?>