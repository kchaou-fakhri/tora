<template>
  	<div class="wrapper d-flex align-items-stretch ">
			<nav id="sidebar" class="active">
				<h1><a href="index.html" class="logo">M.</a></h1>
        <ul class="list-unstyled components mb-5">
           <router-link to="/test">
          <li class="active">
            <a href="#"><span class="fas fa-home"></span> Home</a>
          </li>
           </router-link>
          <router-link to="/category">
          <li>
              <a href="#"><span class="fas fa-sticky-note"></span> Categories</a>
          </li>
          </router-link>
          <router-link to="/products">
          <li>
            <a href="#"><span class="fas fa-clipboard-list"></span> Products</a>
          </li>
             </router-link>
             <router-link to="createproduct">
                <li>
            <a href="#"><span class="fas fa-plus-circle"></span> Add Product</a>
          </li>

             </router-link>
         
           <li>
            <a href="#"><span class="fas fa-users"></span> Users</a>
          </li>

          
          
          <li>
            <a href="#"><span class="fas fa-cogs"></span> Services</a>
          </li>
          <li>
            <a href="#"><span class="fa fa-paper-plane"></span> Contacts</a>
          </li>
        </ul>

        <div class="footer">
        	<p>
					</p>
        </div>
    	</nav>

        <!-- Page Content  -->
       
      <div id="content" class="p-4 p-md-5 ">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Portfolio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
        <div >
             <router-view></router-view>
        </div>
        </div>
		</div>
</template>


<script>
export default {
  mounted(){
(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);
  }
}
</script>
