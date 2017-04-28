<?php

class LangImplementation implements Lang
{
    private $lang;
    public function __construct()
    {
        global $lang;
        if (empty($lang))
        {
            includeLang('INGAME');
        }
        $this->lang = $lang;
    }

    public function getShipName($id)
    {
        return $this->lang['tech_rc'][$id];
    }
    public function getAttackersAttackingDescr($amount, $damage)
    {
        return $this->lang['fleet_attack_1'] . ' ' . $damage . " " . $this->lang['damage'] . " ($amount " . $this->lang['sys_attack_shots'] . ") ";
    }
    public function getDefendersDefendingDescr($damage)
    {
        return $this->lang['fleet_attack_2'] . ' ' . $damage . ' ' . $this->lang['damage'];
    }
    public function getDefendersAttackingDescr($amount, $damage)
    {
        return $this->lang['fleet_defs_1'] . ' ' . $damage . " " . $this->lang['damage'] . " ($amount " . $this->lang['sys_attack_shots'] . ") ";
    }
    public function getAttackersDefendingDescr($damage)
    {
        return $this->lang['fleet_defs_2'] . ' ' . $damage . ' ' . $this->lang['damage'];
    }
    public function getAttackerHasWon()
    {
        return $this->lang['sys_attacker_won'];
    }
    public function getDefendersHasWon()
    {
        return $this->lang['sys_defender_won'];
    }
    public function getDraw()
    {
        return $this->lang['sys_both_won'];
    }
    public function getStoleDescr($metal, $crystal, $deuterium)
    {
        return $this->lang['sys_stealed_ressources'] . " $metal " . $this->lang['Metal'] . ", $crystal " . $this->lang['Crystal'] . " " . $this->lang['sys_and'] . " $deuterium " . $this->lang['Deuterium'];
    }
    public function getAttackersLostUnits($units)
    {
        return $this->lang['sys_attacker_lostunits'] . " $units " . $this->lang['sys_units'] . '.';
    }
    public function getDefendersLostUnits($units)
    {
        return $this->lang['sys_defender_lostunits'] . " $units " . $this->lang['sys_units'] . '.';
    }
    public function getFloatingDebris($metal, $crystal)
    {
        return $this->lang['debree_field_1'] . ":  $metal " . $this->lang['Metal'] . " $crystal " . $this->lang['Crystal'] . ' ' . $this->lang['debree_field_2'] . '.';
    }
    public function getMoonProb($prob)
    {
        return $this->lang['sys_moonproba'] . " $prob% .";
    }
    public function getNewMoon()
    {
        return $this->lang['sys_moonbuilt'];
    }
	public function getAttackerLibelle()
	{
		return $this->lang['sys_attack_attacker_pos'];
	}
	public function getDefenderLibelle()
	{
		return $this->lang['sys_attack_defender_pos'];
	}
	public function getRoundLibelle()
	{
		return $this->lang['sys_attack_round'];
	}
	public function getBattleBeginningLibelle()
	{
		return $this->lang['sys_attack_beginning'];
	}
	public function getBattleEndingLibelle()
	{
		return $this->lang['sys_attack_ending'];
	}
	public function getRepairedDefenseLibelle()
	{
		return $this->lang['sys_repaired_defense'];
	}
}

LangManager::getInstance()->setImplementation(new LangImplementation());

?>