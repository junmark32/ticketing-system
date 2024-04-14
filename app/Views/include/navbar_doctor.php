<!-- Header -->
<header class="header">
				<nav class="navbar navbar-expand-lg header-nav">
					<div class="navbar-header">
						<a id="mobile_btn" href="javascript:void(0);">
							<span class="bar-icon">
								<span></span>
								<span></span>
								<span></span>
							</span>
						</a>
						<a href="index-2.html" class="navbar-brand logo">
							<img src="<?php echo base_url('assets/img/logo.png')?>" class="img-fluid" alt="Logo">
						</a>
					</div>
					<div class="main-menu-wrapper">
						<div class="menu-header">
							<a href="index-2.html" class="menu-logo">
								<img src="<?php echo base_url('assets/img/logo.png')?>" class="img-fluid" alt="Logo">
							</a>
							<a id="menu_close" class="menu-close" href="javascript:void(0);">
								<i class="fas fa-times"></i>
							</a>
						</div>
						<ul class="main-nav">
							<li>
								<a href="index-2.html">Home</a>
							</li>
							<li>
								<a href="index-2.html">Appointments</a>
							</li>
							<li>
								<a href="index-2.html">Shop</a>
							</li>
						</ul>	 
					</div>		 
					<ul class="nav header-navbar-rht">
						<li class="nav-item contact-item">
							<div class="header-contact-img">
								<i class="far fa-hospital"></i>							
							</div>
							<div class="header-contact-detail">
								<p class="contact-header">Contact</p>
								<p class="contact-info-header"> +1 315 369 5943</p>
							</div>
						</li>
						
						<!-- User Menu -->
						<li class="nav-item dropdown has-arrow logged-item">
                            <?php foreach ($doctors as $doctor): ?>
                                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                                    <span class="user-img">
                                        <img class="rounded-circle" src="<?= base_url('uploads/' . $doctor['Profile_url']) ?>" width="31" alt="Darren Elder">
                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <div class="user-header">
                                        <div class="avatar avatar-sm">
                                            <img src="<?= base_url('uploads/' . $doctor['Profile_url']) ?>" alt="User Image" class="avatar-img rounded-circle">
                                        </div>
                                        <div class="user-text">
                                            <h6><?= $doctor['FirstName'] ?> <?= $doctor['LastName'] ?></h6>
                                            <p class="text-muted mb-0">Doctor</p>
                                        </div>
                                    </div>
                                    <a class="dropdown-item" href="doctor-dashboard.html">Dashboard</a>
                                    <a class="dropdown-item" href="doctor-profile-settings.html">Profile Settings</a>
                                    <a class="dropdown-item" href="login.html">Logout</a>
                                </div>
                            <?php endforeach; ?>
						</li>
						<!-- /User Menu -->
						
					</ul>
				</nav>
			</header>
			<!-- /Header -->