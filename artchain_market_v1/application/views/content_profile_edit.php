<?php
    foreach ($veri as $rs) {
        $forename=$rs->forename;
        $surname=$rs->surname;
        $username=$rs->username;
        $email=$rs->email;
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
        </div>
      </div>
      <div class="container-fluid" id="middle-nav" style="background-color:#fff;border-top:1px solid #CCC;border-bottom:1px solid #CCC;">
        
        </div>

        <!-- Content -->
        <div class="container" style="margin-bottom: 50px;">
  <div class="col-lg-3"></div>
  <div class="col-lg-5" style="text-align: center;margin-bottom: 10px;">
    <h2>edit your profile informations</h2>
  </div>
  <div style="clear:both;"></div>
    <form id="defaultForm" method="post" class="form-horizontal" action="<?=base_url()?>Home/edit_profile/<?=$id?>">


                        <div class="form-group">
                            <label class="col-lg-3 control-label">forename</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="forename" value="<?=$forename?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">surname</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="surname" value="<?=$surname?>" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">email</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="email" value="<?=$email?>" />
                            </div>
                        </div>
<!--
                        <div class="form-group">
                            <label class="col-lg-3 control-label" id="captchaOperation"></label>
                            <div class="col-lg-2">
                                <input type="text" class="form-control" name="captcha" />
                            </div>
                        </div>
                        -->

                        <div class="form-group" style="margin-bottom: 50px;">
                            <div class="col-lg-5 col-lg-offset-3">
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="signup" value="Sign up">save</button>
                               
                            </div>
                        </div>
                    </form>
</div>





<script type="text/javascript">
$(document).ready(function() {
    // Generate a simple captcha
    function randomNumber(min, max) {
        return Math.floor(Math.random() * (max - min + 1) + min);
    };
    $('#captchaOperation').html([randomNumber(1, 100), '+', randomNumber(1, 200), '='].join(' '));

    $('#defaultForm').bootstrapValidator({
//        live: 'disabled',
        message: 'This value is not valid',
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            forename: {
                validators: {
                    notEmpty: {
                        message: 'the forename is required and can\'t be empty'
                    }
                }
            },
            surname: {
                validators: {
                    notEmpty: {
                        message: 'the surname is required and can\'t be empty'
                    }
                }
            },
            username: {
                message: 'the username is not valid',
                validators: {
                    notEmpty: {
                        message: 'the username is required and cannot be empty'
                    },
                    stringLength: {
                        min: 4,
                        max: 20,
                        message: 'the username must be more than 4 and less than 20 characters long'
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_\.]+$/,
                        message: 'the username can only consist of alphabetical, number, dot and underscore'
                    },
                    different: {
                        field: 'password,confirmPassword',
                        message: 'the username and password cannot be the same as each other'
                    }
                }
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'the email address is required and can\'t be empty'
                    },
                    emailAddress: {
                        message: 'the input is not a valid email address'
                    }
                }
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'the password is required and cannot be empty'
                    },
                    identical: {
                        field: 'confirmPassword',
                        message: 'the password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'the password cannot be the same as forename'
                    }
                }
            },
            confirmPassword: {
                validators: {
                    notEmpty: {
                        message: 'the confirm password is required and cannot be empty'
                    },
                    identical: {
                        field: 'password',
                        message: 'the password and its confirm are not the same'
                    },
                    different: {
                        field: 'username',
                        message: 'the password cannot be the same as forename'
                    }
                }
            },
            captcha: {
                validators: {
                    callback: {
                        message: 'Wrong answer',
                        callback: function(value, validator) {
                            var items = $('#captchaOperation').html().split(' '), sum = parseInt(items[0]) + parseInt(items[2]);
                            return value == sum;
                        }
                    }
                }
            }
        }
    });

    // Validate the form manually
    $('#validateBtn').click(function() {
        $('#defaultForm').bootstrapValidator('validate');
    });

  
});
</script>