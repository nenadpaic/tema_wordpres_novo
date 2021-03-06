<?php
/**
 * Created by CodeCrew.
 * User: Nenad Paic
 * Date: 4/30/14
 * Time: 7:08 PM
 */

?>

<div id="footer">
    <div id="newsletter" class="row">
        <div id="wrapper-header">
            <div id="logo" class="col-md-4">
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>
    <div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>

        <div class='modal-dialog'>
            <div class='modal-content'><?php add_logo(); ?>
                <div id="login">
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel' align='center'><b>LOG IN </b><span class='small'>OR</span><b> CREATE NEW ACCOUNT</b></h4>
                    </div>
                    <div class='modal-body' id="modalBody">
                        <?php if(!is_user_logged_in()): ?>
                        <div id="message"></div>

                        <form method='post' action='' onsubmit="return login_ajax()" class='form-horizontal' role='form'>
                            <div class="form-group">
                                <label for="inputUsername" class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input type='text' class="form-control" id='inputUsername' placeholder="Username">
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <button type="submit" class="btn btn-success">Log in</button>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-10">
                                    <a href='#' id='register-button' class="btn btn-default">Create new Account</a>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
                <!-- registracija -->
                <div id='register'>
                    <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel' align='center'><b> CREATE NEW ACCOUNT</b></h4>
                    </div>
                    <div class='modal-body' id="modalBody">
                        <div id="messagereg"></div>
                        <form class='form-horizontal' onsubmit="return register_ajax_form()" role='form' id="registerform" method="post" action="" name="registerform">

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Username</label>
                                <div class="col-sm-6">
                                    <input id="user_login" class="form-control" type="text" size="20" value="" name="user_login"></input>
                                </div>
                            </div>
                            <div class='form-group'>
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input id="user_email" class="form-control" type="text" size="25" value="" name="user_email"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-10">
                                    <input id="wp-submit" class="btn btn-success" type="submit" value="Register" name="wp-submit"></input>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-6 col-sm-10">
                                    <a href='#' id='login-button' class="btn btn-default">Back to Login</a>
                                </div>
                            </div>
                        </form>
                    </div>




                </div>
            <?php  else:?>
                <h1>You are already logged in.</h1>
                <h2><a href="<?php echo wp_logout_url($_SERVER['REQUEST_URI']); ?>">Logout</a> </h2>
                <h2><a href="<?php echo get_acc_url();?>">Profile</a> </h2>
            <?php endif; ?>
            </div>
        </div>
    </div>
    <?php
    if(is_user_logged_in()){
        $log = "yes";
    }
    ?>
    <?php
    //function calls necessary script for modal window(login, register via ajax)
    after_footer();
    ?>






</body>
</html>