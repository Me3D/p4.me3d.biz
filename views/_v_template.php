<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">				
	<!-- Controller Specific JS/CSS -->
	
	<link rel="stylesheet" href="/css/style.css">
	<link rel="stylesheet" href="/css/bootstrap.css" >
	<link rel="stylesheet" type="text/css" href="http://w2ui.com/src/w2ui-1.3.min.css" />
	<script type="text/javascript" src="/js/jquery.min.js"></script>
	<script type="text/javascript" src="/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="/js/scripts.js"></script>
	<script type="text/javascript" src="/js/jqBootstrapValidation.js"></script>
	<script type="text/javascript" src="/js/jquery.fixedheadertable.min.js"></script>
	<script type="text/javascript" src="http://w2ui.com/src/w2ui-1.3.min.js"></script>
	
	<?php if(isset($client_files_head)) echo $client_files_head; ?>
	
	<script>
		$(function () { $("input,select,textarea").jqBootstrapValidation(); } )
	</script>
	
</head>

<body>	
<nav class="navbar navbar-default" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="/">Storm Chat</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav">
	<ul class="nav navbar-nav navbar-left left-add">
     <!-- Menu items get added here via JQUERY in each page-->
	</ul>
    </ul>

    <ul class="nav navbar-nav navbar-right right-add">
     <!-- Menu items get added here via JQUERY in each page-->
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
	
		<?php if(isset($content)) echo $content; ?>
	
		<?php if(isset($client_files_body)) echo $client_files_body; ?>
		

		
	</div>	 <!--container-->
</body>
</html>
