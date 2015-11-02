<div class="sidebar" id="sidebar">
				
				<ul class="nav nav-list">
					@if($page == 'Home')
						<li class="active">
					@else
						<li>
					@endif
						<a href="/">
							<i class="icon-volume-up"></i>
							<span class="menu-text"> Announcements </span>
						</a>
					</li>

					@if($page == 'Permits')
						<li class="active">
					@else
						<li>
					@endif
						<a href="#" class="dropdown-toggle">
							<i class="icon-tag"></i>
							<span class="menu-text">Permits </span>

							<b class="arrow icon-angle-down"></b>
						</a>
						
						@if($main_page == 'Business Permits')
							<ul class="submenu active">
							<li class="active">
						@else
							<ul class="submenu">
							<li>
						@endif
								<a href="#" class="dropdown-toggle">
									<span class="menu-text"> Business Permits </span>

									<b class="arrow icon-angle-down"></b>
								</a>
								<ul class="submenu">
								
								
								@if($sub_page == 'Application')
									<li class="active">
								@else
									<li>
								@endif
										<a href="/Permits/Business-Permits/Application">
											<i class="icon-double-angle-right"></i>
											Application
										</a>
									</li>

									<li>
										<a href="pricing.html">
											<i class="icon-double-angle-right"></i>
											Assesment
										</a>
									</li>

									<li>
										<a href="invoice.html">
											<i class="icon-double-angle-right"></i>
											Approval
										</a>
									</li>

									<li>
										<a href="login.html">
											<i class="icon-double-angle-right"></i>
											Payment
										</a>
									</li>
									<li>
										<a href="login.html">
											<i class="icon-double-angle-right"></i>
											Releasing
										</a>
									</li>
								</ul>
							</li>

						
						</ul>
					</li>
					
					@if($page == 'Reference')
						<li class="active">
					@else
						<li>
					@endif
						<a href="#" class="dropdown-toggle">
							<i class="icon-cog"></i>
							<span class="menu-text">References</span>
							<b class="arrow icon-angle-down"></b>
						</a>

						
						<ul class="submenu">
									
									@if($main_page == 'Province')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Province">
											<i class="icon-double-angle-right"></i>
											Province
										</a>
									</li>
									
									@if($main_page == 'Lgu')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Lgu">
											<i class="icon-double-angle-right"></i>
											LGU
										</a>
									</li>

									@if($main_page == 'District')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/District">
											<i class="icon-double-angle-right"></i>
											District
										</a>
									</li>

									@if($main_page == 'Barangay')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Barangay">
											<i class="icon-double-angle-right"></i>
											Barangay
										</a>
									</li>

									@if($main_page == 'Zone')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Zone">
											<i class="icon-double-angle-right"></i>
											Zone
										</a>
									</li>
									
									@if($main_page == 'Business Permit')
										<li class="active">
									@else
										<li>
									@endif
										<a href="#" class="dropdown-toggle">
											<i class="icon-double-angle-right"></i>
											<span class="menu-text">Business Permit</span>
											<b class="arrow icon-angle-down"></b>
										</a>
										<ul class="submenu">
											@if($sub_page == 'Tax Fees and Charges')
												<li class="active">
											@else
												<li>
											@endif
													<a href="/References/Business-Permit/Tax-Fees-Charges">
														<i class="icon-double-angle-right"></i>
														Tax , Fees and Other Charges
													</a>
												</li>
											@if($sub_page == 'Business Nature')
												<li class="active">
											@else
												<li>
											@endif
													<a href="/References/Business-Permit/Business-Nature">
														<i class="icon-double-angle-right"></i>
														Business Nature
													</a>
												</li>													
										</ul>
									</li>
									
									@if($main_page == 'Occupancy Type')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Occupancy-Type">
											<i class="icon-double-angle-right"></i>
											Occupancy Type
										</a>
									</li>
									
									@if($main_page == 'Ownership Type')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Ownership-Type">
											<i class="icon-double-angle-right"></i>
											Ownership Type
										</a>
									</li>
									
									@if($main_page == 'Requirements')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Requirements">
											<i class="icon-double-angle-right"></i>
											Requirements
										</a>
									</li>
									
									
									
									
									
									
									@if($main_page == 'Payment Mode')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Payment-Mode">
											<i class="icon-double-angle-right"></i>
											Payment Mode
										</a>
									</li>	
									
									@if($main_page == 'Citizenship')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Citizenship">
											<i class="icon-double-angle-right"></i>
											Citizenship
										</a>
									</li>									
									
									@if($main_page == 'Economic Area')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Economic-Area">
											<i class="icon-double-angle-right"></i>
											Economic Area
										</a>
									</li>
									
									@if($main_page == 'Economic Organization')
										<li class="active">
									@else
										<li>
									@endif
										<a href="/References/Economic-Organization">
											<i class="icon-double-angle-right"></i>
											Economic Organization
										</a>
									</li>
									<li>
										<a href="/References/Industry-Sector">
											<i class="icon-double-angle-right"></i>
											Industry Sector
										</a>
									</li>
								<!-- ctc settings -->
									@if($main_page == 'ctc')
										<li class="active">
									@else
										<li>
									@endif
									<li>
										<a href="/References/CTC-Settings">
											<i class="icon-double-angle-right"></i>
											CTC settings
										</a>
									</li>
										
										
										
										
										
										
									
									
						</ul>
					</li>
				</ul><!--/.nav-list-->

				<div class="sidebar-collapse" id="sidebar-collapse">
					<i class="icon-double-angle-left"></i>
				</div>
			</div>