
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container-fluid">
					<a href="#" class="brand">
						<small>
							EBPLS
						</small>
					</a><!--/.brand-->

					<ul class="nav ace-nav pull-right">
						
					

						

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="{{ URL::asset('assets/img/avatar2.png') }}" alt="photo" />
								<span class="user-info">
									<small>Welcome,</small>
									{{$username}}
								</span>

								<i class="icon-caret-down"></i>
							</a>

							<ul class="user-menu pull-right dropdown-menu dropdown-yellow dropdown-caret dropdown-closer">
								<li>
									<a href="#">
										<i class="icon-cog"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="/auth/logout">
										<i class="icon-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul><!--/.ace-nav-->
				</div><!--/.container-fluid-->
			</div><!--/.navbar-inner-->
		</div>

