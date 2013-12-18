<!-- Add the logout button -->

<script>
        $(".right-add").append('<li><a id="help_user">Help</a></li>')
	$(".right-add").append('<li><a href="/users/logout">Logout</a></li>')
        $(".left-add").append('<li><a id="add_target">Add Target</a></li>')
        $(".left-add").append('<li><a id="username_button">Logged in as: <?php echo $username; ?> </a></li>')
</script>


 <!-- top half of screen for targets -->   
 <div class="row">
    <div class="col-md-1"></div>
        <div class="col-md-10">
            <div id="target_table">
                <!--Targets Table -->
                <div id="tableContainer" class="tableContainer">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%" class="scrollTable" id="example">
                                <thead class="fixedHeader">
                                        <tr>
                                                <th class="t_head">Target ID</th>
                                                <th class="t_head">IP</th>
                                                <th class="t_head">OS</th>
                                                <th class="t_head">Scanned</th>
                                                <th class="t_head">Description</th>
                                        </tr>
                                </thead>
                        <tbody class="scrollContent" id="bod">
                        <!--table guts go here via ajax call in scripts.js-->
                        </tbody>
                        </table>
                </div>
                <!--Targets Table -->
            </div>
        </div>
    <div class="col-md-1"></div>
 </div> <!-- end row-->
  <!-- top half of screen for targets -->
  
<!-- alert text -->
<div class = "row" >
    <div class="col-md-1"></div> <!-- spacer to align with targets table -->
            <div class="col-md-10">
            <div>
               <br>
               <span id="alert_label" class="">Latest alert: </span><span id="alert_text" class=""></span>
               <br>
               <br>
            </div> <!-- chat -->
            </div>
    <div class="col-md-1"></div><!-- spacer to align with targets table -->
</div>


<!-- chat section -->

<div class = "row" >
    <div class="col-md-1"></div> <!-- spacer to align with targets table -->
        <div class="col-md-10">
            <div id="chat" >
                
            </div> <!-- chat -->
        </div><!-- Chat section -->
    <div class="col-md-1"></div><!-- spacer to align with targets table -->
    
</div> <!-- End chat row div-->


<!-- help text -->
<div class = "row" >
    <div class="col-md-1"></div> <!-- spacer to align with targets table -->
            <div class="col-md-10">
            <div id="help_text" >
                <p class="text-primary">Available commands: /help, /users, etc...</p>
            </div> <!-- chat -->
            </div>
    <div class="col-md-1"></div><!-- spacer to align with targets table -->
</div>


<!-- send section -->
<div class = "row" >
    <div class="col-md-1"></div> <!-- spacer to align with targets table method='POST' action='/chat/send' -->
        <div class="col-md-10">
            <form id="send" class="form-inline" role="form" >
                <div class="form-group"> 
                    <textarea type="text" id="message" name="message" class="form-control message" row="3" placeholder="Message input"></textarea> 
                   
                </div>
                <div class="form-group">
                    <button id="send-message-button" class="btn btn-default" >Send</button>
                </div>
            </form> <!-- send form -->
        </div><!-- send section -->
    <div class="col-md-1"></div>
</div> <!-- End send row div-->



<!--Modal pop up to edit target data -->
<div class="modal fade" id="target_modal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="target_modal_title"></h4>
      </div>
      <div class="modal-body" id="in_modal">
        
            <form id="change_action" role="form" method='POST' action='/target/update_target'>
              <input type="hidden" id="tid" name="tid">
                
                <div class="form-group">
                 <label for="description">Description</label>
                 <textarea type="text" class="form-control" id="description" name="description" rows="1"></textarea>
                </div>
                
              <div class="form-group">
                <label for="ip_address">IP Address</label>
                <input type="text" class="form-control" id="ip_address" name="ip_address">
              </div>
              
              <div class="form-group">
                <label for="os">OS</label>
                <input type="text" class="form-control" id="os" name="os">
              </div>
              
              <div class="form-group">
                <label for="scanned">Scanned</label>
                <input type="text" class="form-control" id="scanned" name="scanned"> 
              </div>
              
                <div class="form-group">
                <label for="notes">Notes</label>
                <textarea type="text" class="form-control" id="notes" name="notes" rows="10"></textarea>
     
                <p class="help-block">Hitting submit will replace current target record with the above.</p>
      
              </div>
                
                <div class="row">
                    <div class="col-md-1"><button type="submit" name="update" class="btn btn-primary">Submit</button></div>
                    <div class="col-md-5"></div>
                    <div class="col-md-1"><button type="submit" name="delete" id="del_but" class="btn btn-danger">Delete</button></div>
                </div>
            </form>
            
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div><!--Modal body-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal pop up to edit target data -->



<!--Modal pop up for help text -->
<div class="modal fade" id="modal_help" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="help_modal_title">Help For You</h4>
      </div>

      <div class="modal-body" id="in_modal_help">
               <p><strong>/help or /?</strong> - This dialog.</p> 
               <p><strong>/users or /u</strong> - List all known users and last seen time.</p>
               <p><strong>/red or /r</strong> - Send team a RED alert.</p> 
               <p><strong>/info or /i</strong> - Send team an INFO alert.</p>
               <p>Pro-tip: Use [ESC]ape key to close all pop up dialogs.</p>
      </div>
	
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal pop up for help text -->



<!--Modal pop up users list-->
<div class="modal fade" id="modal_users" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="help_modal_title">Users List</h4>
      </div>
        
      <div class="modal-body" id="in_modal_users">
        
        
      </div>
	
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal pop up users list-->

<!--Modal pop up useredit -->
<div class="modal fade" id="modal_useredit" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="useredit_modal_title">User Edit</h4>
      </div>
        
      <div class="modal-body" id="in_modal_useredit">
              <form id="change_action" role="form" method='POST' action='/users/useredit'>
               <div id="edit_warning" class=""></div> 
                <div class="form-group">
                 <label for="username">Username</label>
                 <textarea type="text" class="form-control" id="username" name="username" rows="1"></textarea>
                </div>
                
              <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
  
                <p class="help-block">Enter new username or password (min 1 char each). Invalid values are silently ignored...</p>
                   <div class="row">
                    <div class="col-md-1"><button type="submit" name="update" class="btn btn-primary">Submit</button></div>
                  </div>
              </div>
      </div>
	
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal pop up users list-->