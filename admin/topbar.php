<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 5px 15px;
    border-radius: 50% 50%;
    color: #000000b3;
}
</style>

<nav class="navbar navbar-light fixed-top" style="padding:0; background-color: #FE7A36; font-size: 25px;">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  			<div class="logo">
  				<span class="fa fa-shoe-prints"></span>
  			</div>
  		</div>
      <div class="col-md-4 float-left text-white" style="margin-left: -50px;">
        <large><b>KickStart</b></large>
      </div>
	  	<div class="col-md-2 float-right text-white">
      <a href="ajax.php?action=logout" class="text-white" id="logout" style="font-size: 25px;"><?php echo $_SESSION['login_name'] ?> <i class="fa fa-power-off"></i></a>
     
    </div> 
    </div>
     
  </div>
  
</nav>

<script>
  $("#logout").click(function(event){
    var confirmLogout = window.confirm("Are you sure you want to logout?");
    if (!confirmLogout) {
      event.preventDefault();
    }
  
  });
</script>