<div class="container" style="margin-bottom: 50px;">
  <div class="col-lg-3"></div>
  <div class="col-lg-5" style="text-align: center;margin-bottom: 10px;">
    <h2><?=$type?></h2>
  </div>
  <div style="clear:both;"></div>
    <form id="defaultForm" method="post" class="form-horizontal" action="<?=base_url()?>Home/sign_up/".<?=$type?>>

    <input type="hidden" name="type" value="<?=$type?>"/>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">forename</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="forename" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">surname</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="surname" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">username</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="username" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">email</label>
                            <div class="col-lg-5">
                                <input type="text" class="form-control" name="email" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">password</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control" name="password" />
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-lg-3 control-label">retype password</label>
                            <div class="col-lg-5">
                                <input type="password" class="form-control" name="confirmPassword" />
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
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="signup" value="Sign up">sign up</button>
                               
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