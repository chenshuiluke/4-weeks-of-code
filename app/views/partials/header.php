<head>
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/font-awesome.min.css">
<script src="assets/js/jquery-3.2.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
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
<title>4 Weeks of Code</title>
</head>