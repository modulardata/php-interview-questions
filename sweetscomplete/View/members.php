<?php
// get Members table
require './Model/Members.php';
$memberTable = new Members();

// do search
if (isset($_GET['keyword'])) {
	// safely quote the value for inclusion in an SQL statement
	$search = $memberTable->pdoQuoteValue($_GET['keyword']);
	$members = $memberTable->getMembersByKeyword($search);
} else {
	// figure out how many members
	$howMany = $memberTable->getHowManyMembers();
	// get current offset
	if (isset($_GET['offset'])) {
		$offset = (int) $_GET['offset'];
	} else {
		$offset = 0;
	}
	// figure out if previous or next
	if (isset($_GET['more'])) {
		if ($_GET['more'] == 'next') {
			$offset += $memberTable->membersPerPage;
		} else {
			$offset -= $memberTable->membersPerPage;
		}
	} else {
		$offset = 0;
	}
	// adjust offset if < 0 or > $howMany
	if ($offset < 0) {
		$offset = $howMany - $memberTable->membersPerPage;
	} elseif ($offset > $howMany) {
		$offset = 0;
	}
	$members = $memberTable->getAllMembers($offset);
}

?>
<div class="content">

<br/>
<div class="product-list">
	<h2>Our Members</h2>
	<br/>
		<form name="search" method="get" action="?page=members" id="search">
			<input type="text" value="keywords" name="keyword" class="s0" />
			<input type="submit" name="search" value="Search Members" class="button marL10" />
			<input type="hidden" name="page" value="members" />
		</form>
	<br/><br/>
	<a class="pages" href="?page=members&more=previous&offset=<?php echo $offset; ?>">&lt;prev</a>
	&nbsp;|&nbsp;
	<a class="pages" href="?page=members&more=next&offset=<?php echo $offset; ?>">next&gt;</a>
	<table>
		<tr>
			<th>Member ID</th><th>Name</th><th>City</th><th>Email</th>
		</tr>
		<?php foreach ($members as $one) { 		?>
		<tr>
			<td><?php echo $one['user_id']; ?></td>
			<td><img src="images/m.gif" /> <?php echo $one['name']; ?></td>
			<td><?php echo $one['city']; ?></td>
			<td><img src="images/e.gif" /> <?php echo $one['email']; ?></td>
		</tr>
		<?php } 								?>
	</table>
	<br/>
	<a href="?page=addmember" class="abutton">&nbsp;&nbsp;&nbsp;Member Sign Up&nbsp;&nbsp;&nbsp;</a>

</div>
<br class="clear-all"/>
</div><!-- content -->
