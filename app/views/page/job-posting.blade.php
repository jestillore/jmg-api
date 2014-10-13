@extends('layout.main')

@section('content')
<div class="col-md-8 col-lg-8">
	<div>
		<a ui-sref="addcompany" class="btn btn-info">Add Company</a>
		<a ui-sref="addjob" class="btn btn-primary">Add Job</a>
	</div>
	<div ui-view></div>
</div>
<div class="col-md-4 col-lg-4">
	<section id="sidebar">
		<div class="gencon">
			<h4>General Conditions</h4>
			<ol>
				<li>
					<p>This site fully confirms with Rule V-Advertisement for Maritime Employment of Part II - Licensing and Regulation of the POEA Rules and Regulations Governing the Recruitment and Employment of Seafarers.</p>
				</li>
				<li>
					<p>The Advertiser certifies that the information contained in this Agreement is authentic and that the prospective principal/s is/are duly accredited with POEA.</p>
				</li>
				<li>
					<p>The ad will be automatically removed from the website upon expiry of the job posts as indicated in this Agreement.</p>
				</li>
				<li>
					<p>The advertiser assumes liability for all contents published and assumes all risk and agrees to indemnify and hold Seafarer Center and JMG free and harmless for any and all suits, claims, liabilities of any kind and damage that arise from the sponsorship and any additional marketing and promotions.</p>
				</li>
			</ol>
		</div>
	</section>
</div>
@stop

@section('js')
<script type="text/javascript" src="{{URL::to('js/angular.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/angular-route.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/angular-ui-router.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/angular-resource.js')}}"></script>
<script type="text/javascript" src="{{URL::to('js/jmg.js')}}"></script>
@stop
