@extends('layouts.master')

@section('title', 'Sample')

@section('navbars')
    @parent
    @include('includes.navbar')
@endsection

@section('sidebar')
    @parent
    @include('includes.sidebar')
@endsection


@section('breadcrumps')

				<div class="breadcrumbs" id="breadcrumbs">
					<ul class="breadcrumb">
						<li>
							<i class="icon-home home-icon"></i>
							<a href="#">Home</a>

							<span class="divider">
								<i class="icon-angle-right arrow-icon"></i>
							</span>
						</li>
						<li class="active">Announcements</li>
					</ul><!--.breadcrumb-->
				</div>
@endsection				
				
@section('content')

							<div id="announcement_preview" style="border: 1px solid #d3d3d3; padding:20px; display:none;" >
								<h1 id="announce_title">Announcement!</h1>
								<p >Posted:&nbsp;&nbsp;<i class="icon-time" id="announce_date"></i></p>
								<br />
								<p id="announce_desc">This alert needs your attention, but it's not super important.</p>
								<br />
								<br />
								<br />
							</div>

							<table id="sample-table-2" class="table table-striped table-bordered table-hover">
									<thead>
									<tr>
										<th ></th>
										<th >Title</th>
										<th >Description</th>
										<th >Date Posted</th>
										<th ></th>

									</tr>
								</thead>

								<tbody>
								<?php $i=1;?>
									@foreach($announcement as $announce)
									<?php
												$announcement_id	= htmlspecialchars($announce->id);
												$title	= htmlspecialchars($announce->title);
												$desc	= htmlspecialchars($announce->description);														
												$mydate	= strtotime($announce->created_at);	
												$date = date('F jS Y', $mydate);
																						
									?>
									<tr>
										<td class="center">
											{{$i++}}
										</td>
											
										<td>
											<p style="white-space: nowrap; text-overflow: ellipsis;">{{$title}}</p>
										</td>
										<td>{{$desc}}</td>
										<td>
										{{$date}}
										</td>

										<td>
											<div class="hidden-phone visible-desktop btn-group">
												<button class="btn btn-mini btn-success" onClick= "viewAnnouncement('{{$announcement_id}}','{{$date}}')">
													view
												</button>
												<span class="label label-important arrowed">New</span>

											</div>

											<div class="hidden-desktop visible-phone">
												<div class="inline position-relative">
													<button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown">
														<i class="icon-cog icon-only bigger-110"></i>
													</button>

													<ul class="dropdown-menu dropdown-icon-only dropdown-yellow pull-right dropdown-caret dropdown-close">
														<li>
															<button class="btn btn-mini btn-success" onClick='alert()'>
																view
															</button>
														</li>
													</ul>
												</div>
											</div>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>

							
							
							
@endsection


@section('page-script')
	

	<script type="text/javascript">
	
		function viewAnnouncement(id,date){
			var announcement_id = id;
			var announcement_date = date;
			$.post("/getAnnouncement", {announcement_id: announcement_id}, function(result){	
				var obj = JSON.parse(result);
				$("#announcement_preview").show();
				document.getElementById("announce_title").innerHTML = obj[0].title.replace(/\n/g, "<br />");;
				document.getElementById("announce_desc").innerHTML = obj[0].description.replace(/\n/g, "<br />");;
				document.getElementById("announce_date").innerHTML = "&nbsp;&nbsp;"+announcement_date;
				$('html, body').animate({ scrollTop: 0 }, 'fast');
			});
		}
		
		$(function() {
				var oTable1 = $('#sample-table-2').dataTable( {
				"aoColumns": [
			      { "bSortable": false },
			      null, null, null,
				  { "bSortable": false }
				] } );
				

			})

	</script>
@endsection