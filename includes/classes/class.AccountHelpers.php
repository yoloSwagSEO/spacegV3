<?php
/**
 * Created by PhpStorm.
 * User: Isabelle
 * Date: 16/09/2017
 * Time: 10:56
 */


if(!defined('INSIDE')){ die(header("location:../../"));}

class AccountHelpers{
    public static function writeAccountBook($operation,$account,$credits,$debits){

    }
    public static function createAccount($planet,$proprio,$type=1){
        $name = $planet.$proprio.time();
        doquery('INSERT INTO {{table}} (accountNumber,accountProprio,accountName,accountValue,accountType) 
                                      VALUES ('.$name.','.$proprio.',"Compte_'.$planet.$proprio.'",'.$type.')','account');
    }
}


