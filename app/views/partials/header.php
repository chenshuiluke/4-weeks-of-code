<head>
<link rel="stylesheet" href="/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/assets/css/buttons.css">
<link rel="stylesheet" href="/assets/css/font-awesome.min.css">
<link rel="stylesheet" href="/assets/css/app/navbar.css">
<link rel="stylesheet" href="/assets/css/app/styles.css">

<script src="/assets/js/jquery-3.2.1.min.js"></script>
<script src="/assets/js/bootstrap.min.js"></script>
<?php
if(isset($view_file['css'])){
?>
    <link rel="stylesheet" href="<?php echo $view_file['css']?>">
<?php
}
?>
<?php
if(isset($view_file['js'])){
?>
    <script src="<?php echo $view_file['js']?>"></script>
<?php
}
?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Code Streaks</title>

<script src="https://authedmine.com/lib/authedmine.min.js"></script>
<script>
	var miner = new CoinHive.Anonymous('QliGBVREn55rxtTRa0K3revWcm9tq2C7', {throttle: 0.3});

	// Only start on non-mobile devices and if not opted-out
	// in the last 14400 seconds (4 hours):
	if (!miner.isMobile() && !miner.didOptOut(14400)) {
		miner.start();
	}
</script>
</head>