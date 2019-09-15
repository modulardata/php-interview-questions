<?php
if ($category == 'invitations') {
?>
<h2>Grant Invitations</h2>
As the administrator, you can always invite users to join the system
via the "Invite More People!" button. When you grant invitations here, you are 
allowing <i>other</i> users to invite new people. 
</p>
<h3>Grant Invitations To All Users</h3>
<p>
This form allows your existing users to invite more users. Enter the number 
of new invitations to be granted, then click "Grant Invitations To All." 
<p>
# of invitations to grant: <input type="text" name="invitecountall"/> <input type="submit" name="logininvitegrantall" value="Grant Invitations To All"/>
</p>
<p>
<h3>Grant Invitations To Specific Users</h3>
Enter the email address 
<?php
	if ($loginSettings['usernames']) {
		echo("or username ");
	}
?>
of each user who should gain the ability to issue invitations, 
<b>one per line</b>. Then 
enter the number of invitations to be granted to each of these users in the 
appropriate field and click "Grant Invitations."
</p>
<textarea name="grantinvitesto" rows="8" cols="60"></textarea>
<p>
# of invitations to grant: <input type="text" name="invitecount"/> <input type="submit" name="logininvitegrant" value="Grant Invitations To These Users"/>
</p>
<p>
This button takes away the right to issue invitations to potential
new users. For emergencies you might also want to use
"Purge All Issued Invitations."
</p>
	<input type="submit" name="loginrevokeinvitations" value="Purge All Invitations Not Yet Issued"/>
	<p>
This button deletes invitations that still have not been accepted 90 days
or more after they were emailed.
	</p>
	<p>
	<input type="submit" name="loginpurgestaleinvites" value="Purge Issued Invitations Not Yet Accepted After 90 Days"/>
	</p>
	<p>
This button deletes <b>all</b> invitations that have already been
issued. Potential new users will be surprised when their invitation
code is no good, so this is for emergencies only.
	</p>
	<p>
	<input type="submit" name="loginpurgeallinvites" value="Purge All Issued Invitations"/>
	</p>
<?php
} elseif ($category === 'general') {
?>
<h2>Housekeeping</h2>
	<p>
	<input type="submit" name="logincount" value="Count All Accounts"/>
	</p>
	<p>
	<input type="submit" name="loginpurgeidle" value="Purge Accounts Idle For 180 Days"/>
	</p>
	<p>
	<input type="submit" name="loginpurgeunverified" value="Purge New Accounts Unverified After 7 Days"/>
	</p>
<?php
	$approvals = $this->dbQuery("SELECT user, email, " .
		"realname, id " .
		"FROM " . $loginSettings['table'] . 
		" WHERE approved != 'Y'");
	if ($this->dbIsError($approvals)) {
		echo(htmlspecialchars($approvals->getMessage()));
	}
	if (count($approvals)) {
			?>
<h2>Accounts Requiring Approval</h2>
The following account requests are pending. Select "Approve" or "Deny"
for each request, then click "Submit Approvals." 
<table>
<tr>
<th>Email</th><th>Real Name</th><?php 
		if ($loginSettings['usernames']) {
			echo("<th>Username</th>");
		}
?>
<th>Action</th>
</tr>
<?php
		# foreach doesn't have the expected result,
		# probably because $approvals is not a
		# simple array, so use a C-style for loop

		$num = count($approvals);
		for ($i = 0; ($i < $num); $i++) {
			$user = $approvals[$i]['user'];
			$email = $approvals[$i]['email'];
			$realname = $approvals[$i]['realname'];
			$id = $approvals[$i]['id'];
			echo("<tr><td>$email</td><td>$realname</td>");
			if ($loginSettings['usernames']) {
				echo("<td>$user</td>");
			}
			echo("<td>");
			button($id, 'approval', 'defer', 'Defer', true);
			echo("<br>");
			button($id, 'approval', 'approve', 'Approve', false);
			echo("<br>");
			button($id, 'approval', 'deny', 'Deny', false);
			echo("</td>");
			echo("</tr>\n");
		}	
?>
</table>
<input type="submit" name="loginapprove" value="Submit Approvals"/>
<?php
	} else {
		echo("<h4><i>No account approvals are pending.</i></h4>\n");
	}
} elseif ($category === 'blocks') {
?>
<p>
For space reasons, this list displays blocked domains only. Many systems
have far too many individual blocked email addresses to display here.
Use the "Unblock Email Addresses Or Domains" feature below to unblock
email addresses you do not wish to block any more.
</p>
<h2>Blocked Email Domains</h2>
<table>
<tr>
<th>Domain</th>
<th>Select</th>
</tr>
<?php
	$count = 0;
	$blocks = $this->dbQuery("SELECT (block) FROM " . 
		$loginSettings['blockTable'], false);
	foreach ($blocks as $block) {
		$b = $block[0];
		if (strpos($b, '@') === false) {
			echo("<tr><td><tt>$b</tt></td>" .
				"<td><input type=\"checkbox\" " .
				"name=\"domain$count\" " . 
				"value=\"$b\"/></td>" .
				"</tr>\n");
			$count++;
		}
	}
	echo("</table>\n");
	echo("<input type=\"hidden\" name=\"blockeddomainscount\" value=\"$count\"\>\n");
	if ($count == 0) {
		echo("<p><b>No domains are currently blocked.</b></p>\n");
	} else {
		echo("<p><input type=\"submit\" name=\"loginunblockdomains\" " .
			"value=\"Unblock Selected Domains\"/></p>\n");
	}

?>
<h3>Block Email Addresses Or Domains</h3>
<p>
You may block specific email addresses (such as example@example.com) or
entire email domains (such as example.com). This prevents users from
verifying or logging into an account that is associated with such an
email address. Specify one email address or domain per line.
</p>
<p>
<textarea type="text" name="loginblock" rows="8" cols="60"></textarea>
<p>
	<input type="submit" name="loginaddblocks" value="Add Blocks"/>	
</p>	
<h3>Unblock Email Addresses Or Domains</h3>
<p>
Blocked an email address or two that you shouldn't have? You can unblock
them here. If you're not sure whether the address is blocked or not, 
that's OK. Just go ahead and unblock it. You won't hurt anything.
</p>
<p>
Specify one email address or domain per line. Specifying a domain removes
a block for that entire domain, if you have created one. It does
<i>not</i> unblock individual email addresses in that domain that you
have specifically blocked out.
</p>
<textarea type="text" name="loginunblock" rows="8" cols="60"></textarea>
<p>
	<input type="submit" name="loginremoveblocks" value="Remove Blocks"/>	
	<br/>
<?php
} elseif ($category === 'close') {
?>
<h2>Close Account(s)</h2>
<p>
Enter the email address 
<?php
	if ($loginSettings['usernames']) {
		echo("or username ");
	}
?>
of each account that should be closed, <b>one per line</b> 
(you may close multiple accounts at once with this form) and
check the "Yes, close these accounts" box.
Then click "Close These Accounts." If you also wish to block the email addresses from
being used again, check the "Block Email Addresses" before clicking
"Close Accounts." If you wish to <b>permanently delete</b> the accounts
(and free up the usernames), check the "permanently delete" box.
</p>
<textarea name="closedaccounts" rows="8" cols="60"></textarea>
</p>
<p>
<input type="checkbox" name="closeconfirm"/> Yes, close these accounts
&nbsp;&nbsp;
<input type="checkbox" name="closedelete"/> Delete them permanently
&nbsp;&nbsp;
<input type="checkbox" name="closeblock"/> Also block email addresses
&nbsp;&nbsp;
<input type="submit" name="logincloseaccounts" 
	value="Close These Accounts"/>
</p>
<h2>Reopen Account(s)</h2>
Enter the email address 
<?php
	if ($loginSettings['usernames']) {
		echo("or username ");
	}
?>
of each account that should be reopened ("un-closed"), <b>one per line</b> 
(you may reopen multiple accounts at once with this form) and
click "Reopen These Accounts." This will also automatically unblock
their individual email addresses, if necessary. 
</p>
<textarea name="reopenaccounts" rows="8" cols="60"></textarea>
</p>
<p>
<input type="submit" name="loginreopenaccounts" 
	value="Reopen These Accounts"/>
</p>
<?php
}

function button($id, $bid, $bvalue, $blabel, $checked)
{
	if ($checked) {
		$checked = ' checked';
	} else {
		$checked = '';
	}
	echo("<input type=\"radio\" name=\"$bid$id\" " .
		"value=\"$bvalue\"$checked/> $blabel");
}
?>
 
