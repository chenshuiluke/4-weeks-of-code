<?php
    require VIEW_PREFIX . '/partials/header.php';    
?>
<body>
    <?php require VIEW_PREFIX . '/partials/navbar.php'; ?>
    <<?php echo "{$view}" ?>>
<?php
    
    require $view_file['view'];
?>
    </<?php echo "{$view}" ?>>
    <script>
	    AOS.init();
    </script>
</body>