<?php
$get=false;
$error=false;
if($_GET)
{
	$get=true;
	if(isset($_GET['error']))
		$error=true;
}
?>
<!DOCTYPE html>
	<head>
		<title></title>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
		<link href='https://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="https://ramity.com/apps/surl/css/index.css">
	</head>
	<body>
		<div id="topbar">
			<b id="targetname">SURL</b> - Shorten your <font id="target">url</font>
		</div>
		<div class="page" id="one">
			<div class="center">
				<form id="input" method="post" action="https://ramity.com/apps/surl/create">
					<input type="text" id="url" placeholder="url" autocomplete="off" name="url"<?php
					if($get&&$error&&$_GET['error']==1)
						echo 'value="URL does not seem valid..."';
					?>>
				</form>
			</div>
		</div>
		<script>
		$(document).ready(function()
		{
			var borderColor=<?php if($error)echo '"red"';else echo '"#fff"';?>;
			
			$("#topbar").hover(function()
			{
				$("#target").stop().animate({color:'#0cf'},200);
				$("#topbar").stop().animate({borderBottomColor:'#0cf'},200);
			},
			function()
			{
				$("#target").stop().animate({color:'#000'},200);
				$("#topbar").stop().animate({borderBottomColor:'#000'},200);
			});
			
			$("#one").hover(function()
			{
				$("#targetname").stop().animate({color:'#FF7D00'},200);
				$("#topbar").stop().animate({borderBottomColor:'#FF7D00'},200);
			},
			function()
			{
				$("#targetname").stop().animate({color:'#000'},200);
				$("#topbar").stop().animate({borderBottomColor:'#000'},200);
			});
			
			$("#url").hover(function()
			{
				$("#input").stop().animate({borderBottomColor:borderColor},200);
			},
			function()
			{
				$("#input").stop().animate({borderBottomColor:'#161616'},200);
			});
		});
		</script>
	</body>
</html>