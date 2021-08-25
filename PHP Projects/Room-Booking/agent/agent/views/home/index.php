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
                        <a href="#" class="marginTop10" data-toggle="modal" data-target="#modalForgot"> Forgot Password?</a>
                    </form>
                </div>

            </div>
<!--            forgot password-->
 <div class="modal fade" id="modalForgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h3 class="modal-title" id="myModalLabel">Forgot Password</h3>
                    </div>
                    <div class="modal-body">
                        <form class="form-signin" role="form" action="<?php echo WEB_URL; ?>home/forgot_password" method="post">
                            <h2 class="form-signin-heading">Please enter your registered emailid</h2>
                            <input type="email" class="form-control form-group" placeholder="Email address" name="user_email" required autofocus="">
                    
                            
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Submit</button>
                            
                            
                        </form>
                    </div>

                </div>
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