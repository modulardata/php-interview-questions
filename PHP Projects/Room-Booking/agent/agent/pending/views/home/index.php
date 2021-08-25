<?php echo $this->load->view('home/header'); ?>
<!-----  Top destination content ----->
 <link rel="stylesheet" href="<?php echo WEB_DIR; ?>public/css/customagent.css">
<div class="accountCntr">
    <div class="container"> 

        <!--hotel search section-->
        <div class="row">

            <div class="col-md-4">

                <div class="white-container">
                    <div class="searchHdr">Agent Login</div>

                    <form class="form-signin marginTop15" name="loginForm" id="loginForm" action="<?php echo WEB_URL; ?>home/agent_login" method="post">
                        <label>Username</label>
                        <input type="text" class="form-control" name="agent_email" id="agent_email" placeholder="Enter Your Account Name" required />
                        <label>Password</label>
                        <input type="password" class="form-control" id="agent_password" name="agent_password" placeholder="Enter Your Password" required />
                        <label class="checkbox">
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br>
                        <a href="#" class="marginTop10"> Forgot Password?</a>
                    </form>
                </div>

            </div>
            <div class="col-md-8">
                <div class="white-container">
                    <div class="row text-center marginTop25">
                        <div class="lock-icon">
                            <i class="fa fa-lock"></i>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 text-center" style="border:0; padding:30px;">
                            <h1>For New member</h1>
                            If you are already a member, please use the form on right to login to our Members Section.
                            If you are not a member, please click on the below to signup. Registration is easy and FREE!<br>
                            <a href="<?php echo WEB_URL; ?>home/agent_register"><button class="btn btn-success btn-join marginTop25">Sign up now</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php echo $this->load->view('home/footer'); ?>