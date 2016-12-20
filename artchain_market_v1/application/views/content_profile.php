<?php
    foreach ($veri as $rs) {
        $forename=$rs->forename;
        $surname=$rs->surname;
        $username=$rs->username;
    }
?>


<div class="container">
        <div class="row" style="margin:0 0 6px 0;">
          <div class="row">
            <div class="col-md-3 col-sm-3 col-xs-3">
              <img src="<?=base_url()?>img/users/l.png" alt="muk" class="img-circle img-responsive">
            </div>  
            <div class="col-md-6 col-sm-6"></div>
            <div class="col-md-1 col-sm-1 col-xs-3" style="padding:0;"><h4 style="margin:0;text-align: center;">565<br><small>posts</small></h4></div>
            <div class="col-md-1 col-sm-1 col-xs-3" style="padding:0;"><h4 style="margin:0;text-align: center;">123<br><small>followers</small></h4></div>
            <div class="col-md-1 col-sm-1 col-xs-3" style="padding:0;"><h4 style="margin:0;text-align: center;">694<br><small>following</small></h4></div>
            <div class="row" style="margin:0;">
              <div class="col-md-6 col-lg-6 col-sm-6" style="padding:0;"></div>
              <div class="col-md-3 col-lg-3 col-sm-3 col-xs-9" style="padding:0;margin-top:4px;">
                <div class="col-md-9 col-lg-9 col-xs-9 col-sm-9" style="padding:1px;margin-top:1px;">
                  <a class="btn btn-default" href="#" role="button" id="follow_btn" data-container="body" data-html="true" data-toggle="popover" data-placement="bottom" data-content="Example <br> example example example" style="width:100%;height:24px;line-height: 12px;">follow</a>  
                </div>
                <div class="col-md-3 col-lg-3 col-xs-3 col-sm-3" style="padding: 1px;"> 

                  <a class="btn btn-default glyphicon glyphicon-chevron-down" aria-hidden="true" href="#" id="arrow" role="button" style="width:100%;height:24px;line-height: 12px;"></a>  
                </div>
              </div>
            </div> 
          </div> 
        </div>
        <div class="row" style="margin:0 0 14px 0;">
          <div class="col-md-10 col-xs-10 col-lg-10 col-sm-10"><h4 style="margin:0;font-weight: bold;"><?=$forename?> <?=$surname?></h4></div>
          <div class="col-md-10 col-xs-8 col-lg-10 col-sm-10" style="display: -webkit-box;-webkit-line-clamp: 3;-webkit-box-orient: vertical;height: 3.6em;text-overflow:-o-ellipsis-lastline;overflow: hidden;height:62px;">
            About aboutt aboutt aboutt about  aboutt about  aboutt about  aboutt about  aboutt about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about  about 
          </div>
          <div class="col-md-2 col-xs-4 col-lg-2 col-sm-2">
            <a class="btn btn-default glyphicon glyphicon-equalizer" aria-hidden="true" href="#" role="button" style="width:100%;height:28px;line-height:28px;padding:0;" title="Appraise"></a>    
          </div>
          <div style="clear: both;"></div>

          <?php 
if($user_name!=NULL && $user_name==$username){
            ?>

            <div class="row" style="margin:4px 0 0 10px;">            
                <a class="btn btn-default" href="<?=base_url()?>Home/profile_edit/<?=$user_name?>" role="button">edit profile</a> 
            </div>
            <?php
          }
          ?>
        </div>
      </div>
      <div class="container-fluid" id="middle-nav" style="background-color:#fff;border-top:1px solid #CCC;border-bottom:1px solid #CCC;">
        <div class="container" style="height:38px;font-size:16px;">
          <nav class="navbar navbar-default" style="background-color:transparent;border: none;">
            <div class="container-fluid">
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2" style="text-align: center;padding:0;">
                <li class="glyphicon glyphicon-book" id="prov_btn" style="display: block;line-height: 38px;"></li>
              </div>
              <div class="col-xs-3 visible-xs"></div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2" style="text-align: center;padding:0;">
                <a href="#" class="" title="DR#" style="display: block;line-height: 38px;">DR#</a>
              </div>
              <div class="col-xs-3 visible-xs"></div>
              <div class="col-lg-4 col-md-4 col-sm-4 col-xs-2" style="text-align: center;padding:0;">
                <li class="glyphicon glyphicon-earphone" style="display: block;line-height: 38px;"></li>
              </div>
            </nav>
          </div>
        </div>

        <div class="container" style="">
          <div class="row" id="like_this" style="width:100%;height:100px;background-color:#123;color:#fff;margin:0;text-align:center;display:none;">
            Supprriiiisssseee!!!
          </div>


          <div class="row" id="prov" style="width:100%;color:#fff;margin:0;text-align:center;display: none;">

            <!--start-->
            <div id="jssor_1" style="position: relative; margin: 0 auto; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden; visibility: hidden;">
              <!-- Loading Screen -->
              <div data-u="loading" style="position: absolute; top: 0px; left: 0px;">
                <div style="filter: alpha(opacity=70); opacity: 0.7; position: absolute; display: block; top: 0px; left: 0px; width: 100%; height: 100%;"></div>
                <div style="position:absolute;display:block;background:url('<?=base_url()?>img/loading.gif') no-repeat center center;top:0px;left:0px;width:100%;height:100%;"></div>
              </div>
              <div data-u="slides" style="cursor: default; position: relative; top: 0px; left: 0px; width: 809px; height: 150px; overflow: hidden;">
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <a data-u="any" href="http://www.jssor.com" style="display:none">Carousel</a>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
                <div>
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/1.png" />
                </div>
                <div style="display: none;">
                  <img data-u="image" src="<?=base_url()?>img/prov_thumbs/2.png" />
                </div>
              </div>
              <!-- Arrow Navigator -->
              <span data-u="arrowleft" class="jssora03l" style="top:0px;left:8px;width:55px;height:55px;" data-autocenter="2"></span>
              <span data-u="arrowright" class="jssora03r" style="top:0px;right:8px;width:55px;height:55px;" data-autocenter="2"></span>
            </div>
            <script type="text/javascript">jssor_1_slider_init();</script>
            <!--end-->

          </div>


        </div>

        <!-- Content -->
        <div class="container-fluid" style="">
          <div class="container" style="padding:0;margin-bottom: 90px;">
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/1.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/2.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/3.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/2.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/3.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/1.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/1.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/2.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/3.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/2.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/3.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
            <div class="col-md-4 col-sm-4 col-lg-4 col-xs-4" style="padding:1px 1px 1px 1px;">
              <a href="<?=base_url()?>Home/certificate">
                <img src="<?=base_url()?>img/arts/1.png" class="img-responsive" alt="Responsive image">
              </a>
            </div>
          </div>
        </div>