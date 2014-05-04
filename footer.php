<?php
/**
 * Created by CodeCrew.
 * User: Nenad Paic
 * Date: 4/30/14
 * Time: 7:08 PM
 */

?>
</div>
</div>
<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
    <div class='modal-dialog'>
        <div class='modal-content'>
            <div class='modal-header'>
                <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                <h4 class='modal-title' id='myModalLabel'>LOG IN OR CREATE NEW ACOUNT</h4>
            </div>
            <div class='modal-body'>
                <div id='login'>
                    <form method='post' action=''>
                        <label>Username</label>
                        <input type='text' name='' placeholder='Your username' />
                        <label>Password</label>
                        <input type='password' name='' placeholder='Your password' />

                        <a href='#' id='register-button'>Register</a>
                    </form>
                </div>
                <div id='register'>
                    <form method='post' action=''>
                        <h1>Registracija</h1>


                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#forma-log").click(function(){
            $("#register").hide();
        });
        $("#register-button").click(function(){
            $("#login").hide();
            $("#myModalLabel").html("REGISTER");
            $("#register").show();


        });
    </script>
</html>
