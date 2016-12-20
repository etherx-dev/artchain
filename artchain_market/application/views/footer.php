<div style="clear: both;"></div>
        <!-- Footer -->
        <div class="footer navbar-fixed-bottom" style="height:40px;background-color:#fff;border-top:#999 solid 1px;">
          <div class="container">
            <nav class="navbar navbar-default" id="footer-fixed" style="background-color:transparent;border: none;">
              <div class="container-fluid">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 over-a" style="text-align: center;padding:0;">
                  <a href="#" class="glyphicon glyphicon-home" title="Home" style="display: block;font-size:24px;line-height: 40px;color:#000;"></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 over-a" style="text-align: center;padding:0;">
                  <a href="#" class="glyphicon glyphicon-search" title="Search" style="display: block;font-size:24px;line-height: 40px;color:#000;"></a>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 over-a" style="text-align: center;padding:0;">
                  <a href="#" class="glyphicon glyphicon-plus" title="New" style="display: block;font-size:24px;line-height: 40px;color:#000;"></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 over-a" style="text-align: center;padding:0;">
                  <a href="#" class="glyphicon glyphicon-heart" title="Feed" style="display: block;font-size:24px;line-height: 40px;color:#000;"></a>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 over-a" style="text-align: center;padding:0;">
                  <a href="index.html" class="glyphicon glyphicon-user" title="My Profile" style="display: block;font-size:24px;line-height: 40px;color:#000;"></a>
                </div>
              </nav>
            </div>
          </div>
          <!-- Footer Finish -->

          <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <!-- Include all compiled plugins (below), or include individual files as needed -->
          <script src="<?=base_url()?>js/bootstrap.min.js"></script>
        </body>
        </html>

        <script type="text/javascript">
          $(document).ready(function(){  

            $('#arrow').click(function(){
              $("#like_this").slideToggle();
            });

            $('#prov_btn').click(function(){
              $('#prov').slideToggle();
            });

            $('#follow_btn').click(function(){
              $(this).popover('show');
            });
/*
          $('#about').click(function(){
            if($(this).css("overflow")==="hidden"){
              $(this).css("overflow","auto");
              $(this).css("text-overflow","inherit");
              $(this).css("white-space","inherit");
            }
            else{
              $(this).css("overflow","hidden");
              $(this).css("text-overflow","ellipsis");
              $(this).css("white-space","nowrap");
            }
          });*/
        });
          function loadmore(){
            $.ajax({
              url:your_controller/loadmore,
              data:{
                offset :$('#offset').val(),
                limit :$('#limit').val()
              },
              type:json, 
              success :function(data){
                $('#load-more').prepand(data.view)
                $('#offset').val(data.offset)
                $('#limit').val(data.limit)
              }
            })
          }
        </script>