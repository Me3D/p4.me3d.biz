<!-- Add the logout button -->

<script>
	$(".right-add").append('<li><a href="/users/logout">Logout</a></li>')
        $(".left-add").append('<li><a id="add_target">Add Target</a></li>')
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
 
 
 
 
 
<!-- test zone -->

<div>

</div>



<!--Modal pop up to edit target data -->
<div class="modal fade" id="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modal_title"></h4>
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
                <div class="col-md-1"> <button type="submit" name="update" class="btn btn-primary">Submit</button></div>
                <div class="col-md-5"></div>
                <div class="col-md-1"><button id="del_but" type="submit" name="delete" class="btn btn-danger">Delete</button></div>
            </div>
        </form>
	
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--Modal pop up to edit target data -->
