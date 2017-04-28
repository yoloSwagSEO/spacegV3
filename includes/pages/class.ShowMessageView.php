<?php

/**
 * @project XG Proyect
 * @version 2.10.x build 0000
 * @copyright Copyright (C) 2008 - 2012
 */

if(!defined('INSIDE')){ die(header("location:../../"));}

class ShowMessageView
{

    public function __construct ($CurrentUser)
    {
        global $lang, $resource, $pricelist;
        $Message =  doquery("SELECT 
		message.message_id, 
		message.message_owner,
		message.message_subject,
		message.message_sender,
		message.message_time,
		message.message_type,
		message.message_type,
		message.message_from,
		message.message_text,
		user.username
		FROM {{table}}messages AS message 
		LEFT join {{table}}users AS user ON user.id = message.message_owner
		WHERE `message_owner` = '" . intval ( $CurrentUser['id'] ) . "' AND message_id = '".$_GET['id']."'" , '',true );

		
		$parse['message_id']		=	$Message['message_id'];
		$parse['message_owner']		=	$Message['message_owner'];
		$parse['to']				=	$Message['username'];
		$parse['objet']				=	$Message['message_subject'];
		$parse['message_sender']	=	$Message['message_sender'];
		$parse['time']		=	'Le '.date('d/m/Y', $Message['message_time']).' &agrave; '.date('H:i:s', $Message['message_time']); 
		$parse['message_type']		=	$Message['message_type'];
		$parse['from']		=	$Message['message_from'];
		$parse['text']		=	$Message['message_text'];
		
		//$page = print_r($Message,true);
		
        return display2(parsetemplate(gettemplate('messages/messages_view'),$parse));
    }
}