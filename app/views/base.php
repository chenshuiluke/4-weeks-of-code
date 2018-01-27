<?php
    require VIEW_PREFIX . '/partials/header.php';    
?>
<body>
    <<?php echo "{$view}" ?>>
<?php
    require VIEW_PREFIX . '/partials/navbar.php';
    require $view_file['view'];
?>
    </<?php echo "{$view}" ?>>
    <script>
	    AOS.init();
    </script>
</body>