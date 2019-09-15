<div class="login_count">
<h2>User Count Complete</h2>
<?php
echo $count
?>
  accounts exist in the system.
<p>
<?php
	$percent = 0;
	if ($count > 0) {
		$percent = ($verified / $count) * 100.0;
	}
echo $verified
?>
 of those accounts (<?php printf("%.02f", $percent)?>%) 
have been verified.
<p>
<?php
	$upercent = 100.0 - $percent;
echo $unverified
?>
 of those accounts (<?php printf("%.02f", $upercent)?>%) 
were never verified and have therefore never
been used.
<?php
	if ($loginSettings['accountApproval']) {
		echo($approved);
		$apercent = ($approved / $verified) * 100.0;	
?>
 (<?php printf("%.02f", $apercent)?>%) of the verified accounts
have been approved by you. 
<p>
<?php
	$upercent = 100.0 - $apercent;
echo $unapproved;
?>
 of verified accounts (<?php printf("%.02f", $upercent)?>%) 
have not yet been approved or denied by you.
<?php
	}
?>
<p>
Among the verified accounts,
<?php
	$percent = 0;
	if ($verified > 0) {
		$percent = ($closed / $verified) * 100.0;
	}
echo $closed
?>
(<?php printf("%.02f", $percent)?>%) have been closed and
<?php
	$percent = 100.0 - $percent;
echo $verified-$closed
?>
(<?php printf("%.02f", $percent)?>%) are still open.
</div>
