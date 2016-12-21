<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <title>artchain</title>
  <!-- Bootstrap -->
  <link href="<?=base_url()?>css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>css/custom.css" rel="stylesheet">
  <link href="<?=base_url()?>css/font.css" rel="stylesheet">


  <!-- CLIENTS -->
  <script src="<?=base_url()?>js/jssor.slider-22.0.6.min.js" type="text/javascript"></script>


  <!-- VALIDATE FORM AND FOOTER 1_11_1 -->
  <script src="<?=base_url()?>js/jquery_1_11_1.js"></script>

  <link rel="stylesheet" href="http://fortawesome.github.io/Font-Awesome/assets/font-awesome/css/font-awesome.css"> 
  <!-- BUNUN CSS KODLARI DA VAR CUSTOM CSS TE -->
  <script type="text/javascript">
    jssor_1_slider_init = function() {

      var jssor_1_options = {
        $AutoPlay: true,
        $AutoPlaySteps: 4,
        $SlideDuration: 160,
        $SlideWidth: 200,
        $SlideSpacing: 3,
        $Cols: 4,
        $ArrowNavigatorOptions: {
          $Class: $JssorArrowNavigator$,
          $Steps: 4
        },
        $BulletNavigatorOptions: {
          $Class: $JssorBulletNavigator$,
          $SpacingX: 1,
          $SpacingY: 1
        }
      };

      var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

      /*responsive code begin*/
      /*you can remove responsive code if you don't want the slider scales while window resizing*/
      function ScaleSlider() {
        var refSize = jssor_1_slider.$Elmt.parentNode.clientWidth;
        if (refSize) {
          refSize = Math.min(refSize, 809);
          jssor_1_slider.$ScaleWidth(refSize);
        }
        else {
          window.setTimeout(ScaleSlider, 30);
        }
      }
      ScaleSlider();
      $Jssor$.$AddEvent(window, "load", ScaleSlider);
      $Jssor$.$AddEvent(window, "resize", ScaleSlider);
      $Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
      /*responsive code end*/
    };
  </script>
  <!-- CLIENTS FINISH -->

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <div class="container-fluid" style="margin:0 0 14px 0;">
        <header>
          <div class="container">
            <div class="row">
              <div class="col-md-8 col-xs-8" style="color:#000;"><h3 style="font-weight: bold;">artchain</h3></div>
              <div class="col-md-4 col-xs-4" style="text-align: right;margin-top:20px;">
                <div class="btn-group">
                  <button type="button" class="btn btn-default glyphicon glyphicon-align-justify" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  </button>
                  <ul class="dropdown-menu" style="padding-right: 50px;">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Another action</a></li>
                    <li><a href="#">Something else here</a></li>
                    <?php 

                    if ($this->session->userdata('logged_in'))
                    {
                    ?>
                      
                      <li><a href="<?=base_url()?>Home/logout">logout</a></li>
<?php
}
                      ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </header>
      </div>