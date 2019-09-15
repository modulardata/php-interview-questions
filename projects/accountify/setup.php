<?php
# 1.3: just a stub to run the new setup

$loginNoSessionsYet = 1;
require_once 'login.php';
?>
<html>
<head>
<title>Accountify Setup</title>
</head>
<body>
<h1>Accountify Setup</h1>
<h2>Creating and/or upgrading tables...</h2>
<?php
$login->tableCreate();
?>
<b>If no errors were reported,</b> then
Accountify is ready to use. You can
log in to the administrative account now. If you do see error messages above, 
then you probably need to edit <tt>login_config.php</tt> and specify
the right settings for <i>your</i> web hosting account.
</body>
</html>
