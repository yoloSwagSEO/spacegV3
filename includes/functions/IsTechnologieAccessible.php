<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

	function IsTechnologieAccessible($user, $planet, $Element)
	{
		global $requeriments, $resource,$itemDb;
		
		if (isset($requeriments[$Element]))
		{
			
                        $enabled = TRUE;

                        foreach($requeriments[$Element] as $ReqElement => $EleLevel)
			{
                               
				if (@$user[$resource[$ReqElement]] && $user[$resource[$ReqElement]] >= $EleLevel)
				{
					//BREAK
				}
				elseif (isset($planet[$resource[$ReqElement]]) && $planet[$resource[$ReqElement]] >= $EleLevel)
				{
					$enabled = TRUE;
				}
				else
				{
                                        //echo $Element.' | '.$planet[$resource[$ReqElement]].' - '.$resource[$ReqElement].'<br />' ;
					return FALSE;
				}
			}
			return $enabled;
		}elseif(in_array($Element,$itemDb['noBuildable'])&&$planet[$resource[$Element]]<1){
			return false;
		}
		else
		{
			return TRUE;
		}
	}
?>