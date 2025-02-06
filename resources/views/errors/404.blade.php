@extends('FrontOffice.layout.layout')
@section('title', '404 Page Not Found')
@section('main')
<style>

#header {
background-color: #112637;
}


/*======================
    404 page
=======================*/


.page_404{ 
    display:grid;
    margin-top: 90px;
    background:#fff;
    font-family: 'poppins';
}

.page_404  img{ width:100%;}

.four_zero_four_bg{
 
 background-image: url(https://cdn.dribbble.com/users/285475/screenshots/2083086/dribbble_1.gif);
    height: 400px;
    background-position: center;
    }
 
 
.four_zero_four_bg h1{
    font-size:80px;
    }
 
.four_zero_four_bg h3{
    font-size:80px;
	}
			 
.link_404{			 
	color: #fff!important;
    padding: 10px 20px;
    background: #142533;
    margin: 20px 0;
    display: inline-block;}
	.contant_box_404{ margin-top:-50px;}

</style>

<main id="main" style="background-image:#ffff">
<!-- ======= About Section ======= -->
<section class="page_404">
	<div class="container">
		<div class="row">	
		<div class="col">
		<div class="col text-center">
		<div class="four_zero_four_bg">
			<h1 class="text-center">404</h1>
		
		
		</div>
		
		<div class="contant_box_404">
		<h3 class="h2">
		Look like you're lost
		</h3>
		
		<p>the page you are looking for not avaible!</p>
		
		<a href=".." class="link_404">Go to Home</a>
	</div>
		</div>
		</div>
		</div>
	</div>
</section><!-- End About Section -->
</main><!-- End #main -->


@endsection
