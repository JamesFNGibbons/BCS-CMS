<div class='col-md-9'>
    <div class='jumbotron'>
        <div class='container'>
            <h2>Contact Support</h2>
            <p>Get help with using your software</p>
        </div>
    </div>
    <div class='panel panel-default'>
        <div class='panel-heading'>
            Open a ticket with customer support
        </div>
        <div class='panel-body'>
            <div class='row'>
                <form method='post'>
                    <div class='col-md-6'>
                       <div class='form-group'>
                           <lable>Your info</lable>
                           <input disabled='disabled' name='userinfo' class='form-control' value='<?php print $name; ?> (<?php print $url; ?>)'>
                       </div>
                       <div class='form-group'>
                           <lable>Please describe your issue</lable>
                           <textarea name='issue' class='form-control'></textarea>
                       </div> 
                    </div>
                    <div class='col-md-6'>
                        <br>
                        <div class='well'>
                            <p><b>Allowing access to your software</b></p>
                            Please check the box below to allow us to access your software
                            and assist you with your issue.
                           <div class='checkbox col-md-offset-1'>
                               <lable>
                                    <input type='checkbox' name='allow-access'>
                                    Allow access to software
                               </lable>
                           </div>
                        </div>
                    </div>
                    <div class='col-md-12'>
                        <input type='submit' class='btn btn-primary pull-right' value='Submit'>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>