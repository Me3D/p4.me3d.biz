

<div class="container">
	
	<div class="row text-center pseudo-jumbotron">
		<img src="/img/stormchat.png">
	</div>

	<div class="row-fluid padtop">
            	<div class="left">
			<div class="row">
				<div class="col-md-6 col-md-offset-3">
					<div class="panel panel-default">
					  	<div class="panel-heading">
						    	<h3 class="panel-title">Please sign in</h3>
					 	</div>
						<div class="panel-body">
							<form accept-charset="UTF-8" role="form" method='POST' action='/users/p_login'>
								<fieldset>
									<div class="form-group controls control-group">
									    <input class="form-control" placeholder="Username" name="username" type="text" required/>
									 <p class="help-block"></p>
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="" required/>
									</div>
									
									<input class="btn btn-lg btn-success btn-block" type="submit" value="Sign in">
									<div class="checkbox">
										<label>
											<input type="checkbox" name="checkbox" > New user?? Check if true.
										</label>
									</div>
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
            	
        </div>	
</div>
