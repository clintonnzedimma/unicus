<?php
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/env/ftf.php';  
include 'includes/partials.php'; 
include $_SERVER['DOCUMENT_ROOT'].'/emmapassions/engine/controllers/check.php'; 
?>
<body id="page-top" data-spy="scroll" data-target=".navbar-custom">
<?php include 'includes/header.php'; ?>
 
<div>
  <data id="errors_hide">
   <?php if (!empty($errors)) {
     echo $ERROR_MESSAGE;
   }
    ?>
  </data>

   <data id="success_hide">
   <?php if (empty($errors)) {
    echo $SUCCESS_MESSAGE;
   }
    ?>
  </data> 
</div>



 <!-- Section: intro -->
    <section id="intro" class="intro">
      <div class="intro-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-6" style="width: 80%;" >
              <div class="wow fadeInDown" data-wow-offset="0" data-wow-delay="0.1s">
                <h2 class="h-ultra"  style="
    color: #f90909;
    text-transform:  uppercase;
">Emmapassions fitness</h2>
              </div>
              <div class="wow fadeInUp" data-wow-offset="0" data-wow-delay="0.1s">
                <h4 class="h-light" style="
                color:#ffffff; ">Fitness for total wellness</h4>
              </div>


       
              <div class="container this-form">
<div class="row" >
                    <div class="heading-section col-md-12 text-center" style="
                        margin-bottom: 30px;
                    ">




         <div class="container">
                <div class="row" style="
    padding: 15px;
">
            
                <div class="">

                        <center class="contact-form">
                            <form method="post" name="contactform" id="contactform" style="
    max-width: 30em;
    text-align: center;
">


             <label class="col-md-3" for="arrival" style="
    padding: 0;
    padding-right: 15px;
    width: 100%;
    display: inline-block;
    text-align: left;
"> Voucher
<input name="voucher" type="voucher" value="" id="voucher-1" placeholder="" minlength="8" maxlength="8"  style="
    height: 3em;
    width: 98px;
    min-width:  100%;
    display: block;
    font-size: 15px;
    box-shadow: 0 0 0 0.9;
   "></label>
<br>
 <input type="submit" class="mainBtn" id="submit" value="check " name="check" style="
     background-color:  #e00203;
     border-color: #e00203;
     display: block;
     font-weight: 600;
     text-transform: uppercase;
     font-size: 14px;
     color: #ffe8e8;
     padding: 4px;
     border-radius: 2px;
">
</div>


                            </form>
                        </center> <!-- /.contact-form -->
                    </div> <!-- /.col-md-5 -->
        </div> <!-- /.site-main -->
</div>





           <!--  <center>
               <div class="voucher-check-main-container check-container" style="">
                <form>
                  <table>
                    <tr>
                      <td><input type="text" name="voucher1" placeholder="voucher1" style="text-align: center; font-size: 16pt"></td>
                      <td><input type="text" name="voucher2" placeholder="voucher2" style="text-align: left; font-size: 16pt"></td>
                    </tr>

                    <tr>
                      <td colspan="2" width="40%" style="text-align: center;"><input type="button" name="check" value="check" size="70%" style="margin-bottom: 20px;"></td>
                    </tr>

                    
                  </table>
                </form>

               </div>
             </center>                
 -->

            
            </div>
          </div>
        </div>
      </div>
    </section>

         <!--    footer -->

<?php include 'includes/footer.php'; ?>
<?php if (!empty($errors) && submit_btn_clicked('check')): ?>
  <script type="text/javascript">
    alert($("#errors_hide").text());
  </script>
<?php endif ?>

<?php if (empty($errors) && submit_btn_clicked('check')): ?>
  <script type="text/javascript">
  alert($("#success_hide").text());
  </script>
<?php endif ?>
</body>
</html>
