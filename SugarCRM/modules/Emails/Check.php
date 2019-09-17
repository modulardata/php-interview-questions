<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2012 SugarCRM Inc.
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 * 
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 * 
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 * 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by SugarCRM".
 ********************************************************************************/


global $current_user;

if(isset($_REQUEST['type']) && $_REQUEST['type'] == 'personal') {
	if($current_user->hasPersonalEmail()) {
		
		$ie = new InboundEmail();
		$beans = $ie->retrieveByGroupId($current_user->id);
		if(!empty($beans)) {
			foreach($beans as $bean) {
				$bean->connectMailserver();
				$newMsgs = array();
				if ($bean->isPop3Protocol()) {
					$newMsgs = $bean->getPop3NewMessagesToDownload();
				} else {
					$newMsgs = $bean->getNewMessageIds();
				}
				//$newMsgs = $bean->getNewMessageIds();
				if(is_array($newMsgs)) {
					foreach($newMsgs as $k => $msgNo) {
						$uid = $msgNo;
						if ($bean->isPop3Protocol()) {
							$uid = $bean->getUIDLForMessage($msgNo);
						} else {
							$uid = imap_uid($bean->conn, $msgNo);
						} // else					
						$bean->importOneEmail($msgNo, $uid);
					}
				}
				imap_expunge($bean->conn);
				imap_close($bean->conn);
			}	
		}
	}
	header('Location: index.php?module=Emails&action=ListView&type=inbound&assigned_user_id='.$current_user->id);
} elseif(isset($_REQUEST['type']) && $_REQUEST['type'] == 'group') {
	$ie = new InboundEmail();
	// this query only polls Group Inboxes
	$r = $ie->db->query('SELECT inbound_email.id FROM inbound_email JOIN users ON inbound_email.group_id = users.id WHERE inbound_email.deleted=0 AND inbound_email.status = \'Active\' AND mailbox_type != \'bounce\' AND users.deleted = 0 AND users.is_group = 1');

	while($a = $ie->db->fetchByAssoc($r)) {
		$ieX = new InboundEmail();
		$ieX->retrieve($a['id']);
		$ieX->connectMailserver();
		//$newMsgs = $ieX->getNewMessageIds();
		$newMsgs = array();
		if ($ieX->isPop3Protocol()) {
			$newMsgs = $ieX->getPop3NewMessagesToDownload();
		} else {
			$newMsgs = $ieX->getNewMessageIds();
		}

		if(is_array($newMsgs)) {
			foreach($newMsgs as $k => $msgNo) {
				$uid = $msgNo;
				if ($ieX->isPop3Protocol()) {
					$uid = $ieX->getUIDLForMessage($msgNo);
				} else {
					$uid = imap_uid($ieX->conn, $msgNo);
				} // else					
				$ieX->importOneEmail($msgNo, $uid);
			}
		}
		imap_expunge($ieX->conn);
		imap_close($ieX->conn);
	}
	
	header('Location: index.php?module=Emails&action=ListViewGroup');
} else { // fail gracefully
	header('Location: index.php?module=Emails&action=index');
}


?>