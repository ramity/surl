<?php
function alpha($num)
{
	$return="";
	$alpha="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+-_";
	$n=floor($num/strlen($alpha));
	if($n>0)
		$return.=alpha($n);
	$return.=$alpha[$num%strlen($alpha)];
	return $return;
}
if($_POST)
{
	if(filter_var($_POST['url'],FILTER_VALIDATE_URL))
	{
		try
		{
			$db=new PDO('mysql:host=localhost;dbname=App_surl;charset=utf8','ramity','PASSWORD');
			$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			$db->setAttribute(PDO::ATTR_EMULATE_PREPARES,false);

			$st=$db->prepare('SELECT id FROM redir ORDER BY id DESC LIMIT 0,1');
			$st->execute();
			$op=$st->fetchAll();

			if($op)
				$id=$op[0][0];
			else
				$id=0;

			$st=$db->prepare('INSERT INTO redir (id,end,bridge,ip,time,clicks) VALUES("",:end,:bridge,:ip,:time,:clicks)');
			$st->bindValue(':end',$_POST['url']);
			$st->bindValue(':bridge',alpha($id));
			$st->bindValue(':ip',$_SERVER['REMOTE_ADDR']);
			$st->bindValue(':time',time());
			$st->bindValue(':clicks',0);
			$st->execute();
		}
		catch(PDOException $e)
		{

		}
	}
	else
	{
		header('Location: https://ramity.com/apps/surl/?error=1');
	}
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
			<div class="center" style="margin:-250px;">
				<img src="https://ramity.com/apps/surl/img/loading.gif">
			</div>
		</div>
		<script>
		$(document).ready(function()
		{
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
		});
		</script>
	</body>
</html>
