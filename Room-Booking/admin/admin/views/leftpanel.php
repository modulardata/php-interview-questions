<div class="navi">
    <ul class='main-nav'>
        <li>
            <a href="<?php echo site_url(); ?>home" class='light'>
                <div class="ico"><i class="icon-home icon-white"></i></div>
                Dashboard
                <span class="label label-warning">1</span>
            </a>
        </li>
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-th-large icon-white"></i></div>
                Manage Profile 
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav'>
                <li>
                    <a href="<?php echo site_url(); ?>home/my_profile">
                        My Profile
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>home/change_password">
                        Change Password
                    </a>
                </li>				
            </ul>
        </li>

        

        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-user icon-white"></i></div>
                B2B User Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav'>
                <li>
                    <a href="<?php echo site_url(); ?>b2b/create_agent">
                        Create B2B User
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>b2b/agent_manager">
                        B2B Users List
                    </a>
                </li>				
            </ul>
        </li>		

        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-user icon-white"></i></div>
                B2C User Management
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav'>
                <li>
                    <a href="<?php echo site_url(); ?>b2c/create_user">
                        Create B2C User
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>b2c/user_manager">
                        B2C Users List
                    </a>
                </li>				
            </ul>
        </li>
        <?php if ($this->session->userdata('role_id') == 1) { ?>    
            <li>
                <a href="#" class='light toggle-collapsed'>
                    <div class="ico"><i class="icon-gift icon-white"></i></div>
                    B2B Markup Manager
                    <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
                </a>
                <ul class='collapsed-nav'>
                    <li>
                        <a href="<?php echo site_url(); ?>b2b/hotel_markup_manager">
                            Hotel Markup Manager
                        </a>
                    </li>                 
                    
                    
                </ul>
            </li>

            <li>
                <a href="#" class='light toggle-collapsed'>
                    <div class="ico"><i class="icon-gift icon-white"></i></div>
                    B2C Markup Manager
                    <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
                </a>
                <ul class='collapsed-nav'>
                    <li>
                        <a href="<?php echo site_url(); ?>b2c/hotel_markup_manager">
                            Hotel Markup Manager
                        </a>
                    </li>                 
                    
                    
                </ul>
            </li>	
        <?php } ?>  
        <li>
            <a href="#" class='light toggle-collapsed'>
                <div class="ico"><i class="icon-globe icon-white"></i></div>
                My Control Panel
                <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
            </a>
            <ul class='collapsed-nav'>
                <li>
                    <a href="<?php echo site_url(); ?>home/currency_manager">
                        Currency Manager
                    </a>
                </li>                 
                <li>
                    <a href="<?php echo site_url(); ?>home/api_manager">
                        API Manager
                    </a>
                </li>
                <li>
                    <a href="<?php echo site_url(); ?>home/payment_manager">
                        Payment Gateway Manager
                    </a>
                </li>
               
                
            </ul>
        </li>  
        <?php if ($this->session->userdata('role_id') == 1) { ?>     
            <li>
                <a href="#" class='light toggle-collapsed'>
                    <div class="ico"><i class="icon-gift icon-gift"></i></div>
                    Booking Reports Manager
                    <img src="<?php echo base_url(); ?>public/img/toggle-subnav-down.png" alt="">
                </a>
                <ul class='collapsed-nav'>
                    <li>
                        <a href="<?php echo site_url(); ?>b2b/b2b_reports_manager">
                            B2B Reports Manager
                        </a>
                    </li>                 
                    <li>
                        <a href="<?php echo site_url(); ?>b2c/b2c_reports_manager">
                            B2C Reports Manager
                        </a>
                    </li>

                </ul>
            </li>
        <?php } ?>
    </ul>

</div>