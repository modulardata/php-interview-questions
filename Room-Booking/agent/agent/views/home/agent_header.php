<!-- agent navigation  -->
<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo WEB_URL; ?>">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li ><a href="<?php echo WEB_URL; ?>home/dashboard">Dashboard</a></li>
                <li><a href="<?php echo WEB_URL; ?>home/view_profile">My Profile</a></li>
                <li><a href="<?php echo WEB_URL; ?>home/booking">Booking History</a></li>
                <li ><a href="<?php echo WEB_URL; ?>home/deposit_history">Deposit History</a></li>
                <li><a href="<?php echo WEB_URL; ?>home/markup_manager">Markup Management</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/custom.css">