<img id="logo-image" class="img img-fluid" src="/assets/img/logo.png">
<?php 
    if(isset($_SESSION['user'])){
?>
    <a id="add-submission" href="/submissions/form" class="button button-glow button-rounded button-raised button-primary">Add Submission</a>
<?php   
    }
    if(isset($_SESSION['submissions']) && count($_SESSION['submissions']) > 0){
        require VIEW_PREFIX . '/partials/home/submissions.php';
    }
?>