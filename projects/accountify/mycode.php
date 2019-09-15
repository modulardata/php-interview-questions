<?php

# Two examples of custom Accountify category pages:
# birthdate and toc (Terms and Conditions). The 
# birthdate category page prompts for a birthdate and
# will not accept an age under 18 years. The toc page
# presents the terms and conditions of use for the site
# and will not allow the user to proceed further without
# accepting them by checking a box.

# This file also contains a trivial example of a 
# callback function that is invoked when an account
# is closed or deleted, myEraserCallback. This is
# different from a category page eraser callback in that
# it is not associated with any particular category page.

# See also the extraCategories, extraCategoryOrder 
# and eraserCallback settings in login_config.php, without
# which none of this code would actually be executed.

# PHP5 users: I use the getdate() function, which produces
# warnings in PHP5 unless we set the time zone. This code
# sets the time zone for Accountify to UTC, which means that
# people are considered to be 18 when they turn 18 in 
# Greenwhich, England. Feel free to set any other valid
# timezone code. In PHP4 the default server timezone is used.

# Run this code only when PHP5 is present (sigh) 
if (version_compare(phpversion(), '5.0.0', '>=')) {
	date_default_timezone_set("UTC");
}

require_once 'DB.php';

$mydb = DB::connect(
	$loginSettings['dbtype'] . "://" .
	$loginSettings['user'] . ":" .
	$loginSettings['password'] . "@" .
	$loginSettings['host'] . "/" .
	$loginSettings['name'], false);

if (PEAR::isError($mydb)) {
	$dbFailure = true;
}

function myBirthdateHtml($category, $id, $hints)
{
  global $dbFailure;
  if ($dbFailure) {
    return array('loginDataCancel', 'Database not available');
  }
  # If $id is present, then the user is
  # editing existing choices. Fetch
  # the user's current choices to use them as
  # the defaults, saving the user a lot of time.
  global $mydb;
  $birthDate = false;
  if (strlen($id)) {
    $query = 'SELECT birthdate FROM birthdates WHERE id = ?';
    $qresult = $mydb->getAll($query, array($id));
    if (PEAR::isError($qresult)) {
      return array('loginDataCancel',
        'Database error, try again later');
    }
    # Pull out the first result. If there are no result rows, this
    # user simply hasn't set her birthdate yet, which is fine.
    if (count($qresult)) {
      $birthDate = $qresult[0][0];
    }
  }

  # Parse the previously stored birthdate back into
  # separate form fields with PHP's handy sscanf function
  $birthYear = '';
  $birthMonth = '';
  $birthDay = '';

  if (strlen($birthDate)) {
    list($birthYear, $birthMonth, $birthDay) =
      sscanf($birthDate, "%04d%02d%02d");
  }

  # If the user has already entered something,
  # let that override what is currently stored.
  # This allows the user to move from tab to tab,
  # or correct errors in one or more fields, without
  # starting from scratch. (Accountify automatically
  # repopulates $_POST correctly when you switch category pages.)

  if (isset($_POST['birthyear']) && (strlen($_POST['birthyear']))) {
    $birthYear = $_POST['birthyear'];
  }

  # Take a hint from the validator to fix the birth year
  if (isset($hints['birthyear'])) {
    $birthYear = $hints['birthyear']; 
  }

  if (isset($_POST['birthmonth']) && (strlen($_POST['birthmonth']))) {
    $birthMonth = $_POST['birthmonth'];
  }
  if (isset($_POST['birthday']) && (strlen($_POST['birthday']))) {
    $birthDay = $_POST['birthday'];
  }

  # ALWAYS PREVENT XSS ATTACKS by escaping the
  # user's prior input correctly, whether or not
  # < and > are considered valid input!

  $birthYear = htmlspecialchars($birthYear);
  $birthMonth = htmlspecialchars($birthMonth);
  $birthDay = htmlspecialchars($birthDay);
?>
<p>
Users must be at least 18 years of age. When were you born?
</p>
<p>
<input name="birthmonth" size="2" maxlength="2"
  value="<?php echo $birthMonth?>"
/> Month
<input name="birthday" size="2" maxlength="2"
  value="<?php echo $birthDay?>"
/> Day
<input name="birthyear" size="4" maxlength="4"
  value="<?php echo $birthYear?>"
/> Year
</p>
<?php
  return array('loginDataValid');
}

function myBirthdateValidator($category, $id)
{
  # Deliberately out of range default,
  # make sure they answer with something valid
  $month = 0; 
  if (isset($_POST['birthmonth'])) {
    $month = $_POST['birthmonth'];
  }
  $day = 0;
  if (isset($_POST['birthday'])) {
    $day = $_POST['birthday'];
  }
  $year = 0;
  if (isset($_POST['birthyear'])) {
    $year = $_POST['birthyear'];
  }
  if (($month < 1) || ($month > 12)) {
    # Out of range, let them try again.
    return array('loginDataInvalid',
      "The birth month must be between 1 and 12.");
  }
  if (($day < 1) || ($day > 31)) {
    return array('loginDataInvalid',
      "The birth day must be between 1 and 31.");
  }
  if ($year < 1800) {
    # 2.02: a blank year should not be hinted as 2000
    if (strlen($year) && ($year < 100)) {
      # Pass back an intelligent guess at the real birth year,
      # as a hint to the html callback's next pass
      if ($year < 50) {
        $year += 2000;
      } else {
        $year += 1900;
      }
      return array('loginDataInvalid',
        "The birth year must be a four-digit number greater than 1800. Did you mean $year?",
        array('birthyear' => $year));
    }
    return array('loginDataInvalid',
      "The birth year must be a four-digit number greater than 1800.");
  }
  $birthdate = sprintf("%04d%02d%02d", $year, $month, $day);
  $now = getdate(time());
  $now['year'] -= 18;  
  $thendate = sprintf("%04d%02d%02d",
    $now['year'], $now['mon'], $now['mday']);
  if ($birthdate > $thendate) {
    # Cancel the account creation, the user is
    # not old enough.
    return array('loginDataCancel',
      "Sorry, you must be at least 18 years old.");
  }
  # Return success
  return array('loginDataValid',
    array("birthdate" => $birthdate));
}

function myBirthdateWriter($category, $id, $data) {
  global $mydb;
  # Try to store the user's birthdate for the first time
  $qresult = $mydb->query("INSERT INTO birthdates (id, birthdate) " .
      "VALUES (?, ?)", array($id, $data['birthdate']));
  if (PEAR::isError($qresult)) {
    # Error. But is it simply because we already
    # have a record for this user?
    if ($qresult->getMessage() == 'DB Error: already exists') {
      # OK, then just update the existing record
      $qresult =
        $mydb->query("UPDATE birthdates " .
          "SET birthdate = ? " .
          "WHERE id = ?",
          array($data['birthdate'], $id));
    }
  }
  if (PEAR::isError($qresult)) {
    # An error at this point is a real problem
    return array(
      'loginDataCancel',
      'Database failure, sorry');
  }
  return array('loginDataValid');
}

function myBirthdateEraser($category, $id, $deleting)
{
	global $mydb;	
	if (!$deleting) {
		# Keep this around for un-close operations
		return;
	}
	$mydb->query("DELETE FROM birthdates WHERE id = ?",
		array($id));
}

function myTocHtml($category, $id, $hints)
{
?>
<p>
<b>To receive an account on our site, you must agree to the
following terms and conditions.</b> 
Read the entire agreement, then check the 
"I accept the terms and conditions of use" box at the end of
this page. Then click "Next." If you do not wish to accept
the terms and conditions of use, click "Cancel." 
</p>
<h2>Terms and Conditions of Use</h2>
    Now, my co-mates and brothers in exile,<br>
    Hath not old custom made this life more sweet<br>
    Than that of painted pomp? Are not these woods<br>
    More free from peril than the envious court?<br>
    Here feel we but the penalty of Adam,<br>
    The seasons' difference, as the icy fang<br>
    And churlish chiding of the winter's wind,<br>
    Which, when it bites and blows upon my body,<br>
    Even till I shrink with cold, I smile and say<br>
    'This is no flattery: these are counsellors<br>
    That feelingly persuade me what I am.'<br>
    Sweet are the uses of adversity,<br>
    Which, like the toad, ugly and venomous,<br>
    Wears yet a precious jewel in his head;<br>
    And this our life exempt from public haunt<br>
    Finds tongues in trees, books in the running brooks,<br>
    Sermons in stones and good in every thing.<br>
    I would not change it.<br>
<br>
AMIENS<br>
<br>
    Happy is your grace,<br>
    That can translate the stubbornness of fortune<br>
    Into so quiet and so sweet a style.<br>
<br>
DUKE SENIOR<br>
<br>
    Come, shall we go and kill us venison?<br>
    And yet it irks me the poor dappled fools,<br>
    Being native burghers of this desert city,<br>
    Should in their own confines with forked heads<br>
    Have their round haunches gored.<br>
<br>
First Lord<br>
<br>
    Indeed, my lord,<br>
    The melancholy Jaques grieves at that,<br>
    And, in that kind, swears you do more usurp<br>
    Than doth your brother that hath banish'd you.<br>
    To-day my Lord of Amiens and myself<br>
    Did steal behind him as he lay along<br>
    Under an oak whose antique root peeps out<br>
    Upon the brook that brawls along this wood:<br>
    To the which place a poor sequester'd stag,<br>
    That from the hunter's aim had ta'en a hurt,<br>
    Did come to languish, and indeed, my lord,<br>
    The wretched animal heaved forth such groans<br>
    That their discharge did stretch his leathern coat<br>
    Almost to bursting, and the big round tears<br>
    Coursed one another down his innocent nose<br>
    In piteous chase; and thus the hairy fool<br>
    Much marked of the melancholy Jaques,<br>
    Stood on the extremest verge of the swift brook,<br>
    Augmenting it with tears.<br>
<br>
DUKE SENIOR<br>
<br>
    But what said Jaques?<br>
    Did he not moralize this spectacle?<br>
<br>
First Lord<br>
<br>
    O, yes, into a thousand similes.<br>
    First, for his weeping into the needless stream;<br>
    'Poor deer,' quoth he, 'thou makest a testament<br>
    As worldlings do, giving thy sum of more<br>
    To that which had too much:' then, being there alone,<br>
    Left and abandon'd of his velvet friends,<br>
    ''Tis right:' quoth he; 'thus misery doth part<br>
    The flux of company:' anon a careless herd,<br>
    Full of the pasture, jumps along by him<br>
    And never stays to greet him; 'Ay' quoth Jaques,<br>
    'Sweep on, you fat and greasy citizens;<br>
    'Tis just the fashion: wherefore do you look<br>
    Upon that poor and broken bankrupt there?'<br>
    Thus most invectively he pierceth through<br>
    The body of the country, city, court,<br>
    Yea, and of this our life, swearing that we<br>
    Are mere usurpers, tyrants and what's worse,<br>
    To fright the animals and to kill them up<br>
    In their assign'd and native dwelling-place.<br>
<p>
<?php
	$checked = "";
	if (isset($_SESSION['toc_accepted'])) {
		$checked = $_SESSION['toc_accepted'];
	}
	if (isset($_POST['toc_accepted'])) {
		$checked = $_POST['toc_accepted'];
	}	
?>
<input type="checkbox" name="toc_accepted" value="accepted"
<?php
	if ($checked === 'accepted') {
		echo(" checked");
	}
?>
/> I Accept The Terms And Conditions Of Use
<?php
  return array('loginDataValid');
}

function myTocValidator($category, $id)
{
  # Return success
  if (isset($_POST['toc_accepted']) && ($_POST['toc_accepted'] === 'accepted')) 
  {
    # Use loginDataValidDone - don't make the user scorll through this
    # more than once when moving back and forth correcting errors
    # at account creation time. 

    # Note that we store a version number for the TOC the user
    # accepted. Later, code like the following can be used to present
    # a newer TOC outside of the category page system:

    # if ($_SESSION['toc_accepted'] < 2.0) { ... }

    return array('loginDataValidDone',
      array('toc_accepted' => '1.0'));
  } else {
    return array('loginDataInvalid',
      'You must accept the terms and conditions to gain access to this ' .
      'site. If you do not wish to accept them, click the "Cancel" button.');
  }
}

function myEraserCallback($id, $deleting)
{
	echo("Close callback for $id. Delete flag: $deleting\n");
}

?>
