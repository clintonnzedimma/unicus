<?php 
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/env/ftf.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/controllers/details.php';

if($userFactory->IsLoggedIn()) :
	$the_user = new User_Singleton($_SESSION['voucher']);
?>
<?php include 'includes/partials.php'; ?>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<?php include 'includes/header.php'; ?>


<!-- Section: intro -->
    <section id="intro" class="intro">
      <div class="intro-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-6">
              <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                <h2 class="h-ultra"  style="
    color: #f90909;
    text-transform:  uppercase;
">Emmapassions fitness</h2>
              </div>
              <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                <h4 class="h-light"   style="
                color:#ffffff; ">Fitness for total wellness</h4>
              </div>
            <!--   <div class="well well-trans">
                <div class="wow fadeInRight" data-wow-delay="0.1s">

                  <ul class="lead-list">
                    <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Affordable monthly premium packages</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                    <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Choose your favourite doctor</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                    <li><span class="fa fa-check fa-2x icon-success"></span> <span class="list"><strong>Only use friendly environment</strong><br />Lorem ipsum dolor sit amet, in verterem persecuti vix, sit te meis</span></li>
                  </ul>
                  <p class="text-right wow bounceIn" data-wow-delay="0.4s">
                   <a href="index-form.html" class="btn btn-skin btn-lg">Register Now <i class="fa fa-angle-right"></i></a>
                  </p>
                </div>
              </div> -->

         <div class="site-main" id="sTop" style="
  /*  background-image:  url(img/fitness-01.jpg);
    background-size:  cover;*/
   
   /* box-sizing:  
    */
    

">

<!-- 
<div id="banner"> -->
  
    <h6 id="headerchange" style=" 

    text-align: center;
    font-size: 28px;
    font-weight: 800;
    text-transform: uppercase;
    color: red;

    "> Event Details</h6><br>

   <p id="parachange" style="
    color:  black;
    font-weight:  800;


    /* display:  inline-block; */
    /* width: 20%; */
    /* min-width: 100px; */
">
    <span class="King" style="
    display: inline-block;
    width: 28%;
    min-width: 150px;

">     Name of Event</span>      <span class="royale"><i><?php echo $the_user->event->get('name_of_event') ?> </i></span><br>
<span class="King" style="
    display:  inline-block;
    width: 28%;
    min-width: 140px;
    
">   Description</span>    <span class="royale"><?php echo $the_user->event->get('description') ?></span><br>
<span class="King" style="
    display:  inline-block;
    width: 28%;
    min-width:  140px;
"> Date of Event</span>              <span class="royale"><?php echo $the_user->event->get('start_date') ?></span><br>
<span class="King" style="
    display:  inline-block;
    width:  28%;
    min-width:  140px;
">        Location</span> <span class="royale"><?php echo $the_user->event->get('location') ?></span><br> 
<span class="King" style="
    display:  inline-block;
    width: 28%;
    min-width:  140px;
">        Full Name</span>    <span class="royale"> <?php echo $the_user->get('full_name') ?></span><br>
<span class="King" style="
    display:  inline-block;
    width: 28%;
    min-width:  140px;
">        Phone Number</span>   <span class="royale"><?php echo $the_user->get('phone') ?></span><br>
<span class="king" style="
    display:  inline-block;
    width:  28%;
    min-width:  140px;
">        Email</span> <span class="royale"><?php echo $the_user->get('email') ?></span> <br>
<span class="king"  style="
    display: inline-block;
    width:  28%;
    min-width:  140px;
    ">
            Voucher Pin</span> <span class="royale"><?php echo $the_user->get('slip_voucher') ?></span><br>


<form method="post">

        <input type="submit" name="log-out" style="
    background-color: #2f0000;
    border-color:  #2f0000;
  
    color: white;
    padding: 8px ;
    text-align: center;
    font-weight: 600;  
    border-radius: 8px; 
   /* margin-bottom: 600px;*/
" value="Log out"></input>

</form>              
</div>
 </div>
           <!-- <div class="col-lg-6">
              <div class="wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.2s">
                <img src="img/dummy/img-1.png" class="img-responsive" alt="" /> 
              </div>
            </div>  
          </div> -->
        </div>
      </div>
    </section>
<?php endif ?>

<?php 
if (!$userFactory->IsLoggedIn()) {
	header("Location:check.php?not_logged");
	exit();	
}

?>

<?php include 'includes/footer.php'; ?>
</body>
