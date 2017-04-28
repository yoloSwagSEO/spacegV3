<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

	function GetElementPrice ($user, $planet, $Element, $userfactor = TRUE, $level = FALSE)
	{
		global $pricelist, $resource, $lang;

		//if ($userfactor) // OLD CODE
		if ($userfactor && ($level === FALSE)) // FIX BY JSTAR
			$level = (isset($planet[$resource[$Element]])) ? $planet[$resource[$Element]] : $user[$resource[$Element]];

		$is_buyeable = TRUE;

		$array = array(
			'metal'      => '<img border="0" src="styles/skins/xgproyect/images/metall.png" width="28">',
			'crystal'    => '<img border="0" src="styles/skins/xgproyect/images/cristal.png" width="28">',
			'deuterium'  => '<img border="0" src="styles/skins/xgproyect/images/uradium.png" width="28">',
			'energy_max' => $lang['Energy']
		);

		$text = '';
		foreach ($array as $ResType => $ResTitle)
		{
			if (isset ( $pricelist[$Element][$ResType] ) && $pricelist[$Element][$ResType] != 0)
			{
				$text .= "<div class=\"ressource_$ResType\">".$ResTitle . " ";
				if ($userfactor)
					$cost = floor($pricelist[$Element][$ResType] * pow($pricelist[$Element]['factor'], $level));
				else
					$cost = floor($pricelist[$Element][$ResType]);

				if ($cost > $planet[$ResType])
				{
					$text .= "<b style=\"color:red;\"> <t title=\"-" . Format::pretty_number ($cost - $planet[$ResType]) . "\">";
					$text .= "<span class=\"noresources\">" . Format::pretty_number($cost) . "</span></t></b></div>";
					$is_buyeable = FALSE;
				}
				else
					$text .= "<b style=\"color:lime;\">" . Format::pretty_number($cost) . "</b></div>";
			}
		}
		return $text;
	}
?>