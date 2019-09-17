
			<div class="row-fluid no-margin">
				<div class="span12">
					
							<ul class="quicktasks">                          
<!-- 								<li>
									<a href="<?php echo site_url();?>/sdadmin/manage_admin">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/statistics.png" alt="">
										<span>Statisitics Overview</span>
									</a>
								</li>-->
								<li>
									<a href="<?php echo site_url();?>b2c/user_manager">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/user.png" alt="">
										<span>B2C User</span>
									</a>
								</li>
								<li>
									<a href="<?php echo site_url();?>b2b/agent_manager">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/business-contact.png" alt="">
										<span>B2B User</span>
									</a>
								</li>
								<li>
									<a href="<?php echo site_url();?>home/view_deposit">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/bank.png" alt="">
										<span>Agent Deposit</span>
									</a>
								</li>
<!--								<li>
									<a href="<?php echo site_url();?>home/promotion_manager">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/cost.png" alt="">
										<span>Promo Manager</span>
									</a>
								</li>-->
                            <?php if($this->session->userdata('role_id') == 1) {?>
                                <li>
									<a href="<?php echo site_url();?>b2b/b2b_reports_manager">
                                    	<img src="<?php echo base_url();?>public/img/icons/essen/32/business-contact.png" alt="">
										<img alt="" src="<?php echo base_url();?>public/img/icons/essen/32/order-149.png">
										<span>B2B Reports Manager</span>
									</a>
								</li>
                                 <li>
									<a href="<?php echo site_url();?>b2c/b2c_reports_manager">
                                    	<img src="<?php echo base_url();?>public/img/icons/essen/32/user.png" alt="">
										<img alt="" src="<?php echo base_url();?>public/img/icons/essen/32/order-149.png">
										<span>B2C Reports Manager</span>
									</a>
								</li>
                              <?php } ?>
								<!--<li>
									<a href="#">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/check.png" alt="">
										<span>Confirmed Bookings</span>
									</a>
								</li>
                                <li>
									<a href="#">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/busy.png" alt="">
										<span>Cancelled Bookings</span>
									</a>
								</li>
								<li>
									<a href="#">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/featured.png" alt="">
										<span>Failed Bookings</span>
									</a>
								</li>-->
								
								<li>
									<a href="<?php echo site_url();?>home/api_manager">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/flag.png" alt="">
										<span> API Mangement </span>
									</a>
								</li>
								
                             
								
                                <li>
									<a href="<?php echo site_url();?>home/payment_manager">
										<img src="<?php echo base_url();?>public/img/icons/essen/32/credit-card.png" alt="">
										<span>Payment Gateway</span>
									</a>
								</li>
                                                                <!--                                  <li>
                                                                                                                                        <a href="<?php echo site_url(); ?>home/currency_manager">
                                                                                                                                                <img src="<?php echo base_url(); ?>public/img/icons/essen/32/Cash.png" alt="">
                                                                                                                                                <span>Currency Convertor</span>
                                                                                                                                        </a>
                                                                                                                                </li>-->
                                                                <!--                                  <li>
                                                                                                                                        <a href="<?php echo site_url(); ?>/sdadmin/manage_admin">
                                                                                                                                                <img src="<?php echo base_url(); ?>public/img/icons/essen/32/order.png" alt="">
                                                                                                                                                <span>Notice Board</span>
                                                                                                                                        </a>
                                                                                                                                </li>-->
<!--                                 <li>
									<a href="<?php echo site_url();?>/messages/inbox">										
                                        <img alt="" src="<?php echo base_url();?>public/img/icons/essen/32/sign-out.png">
										<span>Email Management</span>
									</a>
								</li>-->
                                
								
							</ul>
				</div>
			</div>