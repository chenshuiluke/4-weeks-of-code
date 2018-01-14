<img id="logo-image" class="img img-fluid" src="/assets/img/logo.png">
<?php
    if(isset($_SESSION['submissions']) && count($_SESSION['submissions']) > 0){
        require VIEW_PREFIX . '/partials/home/submissions.php';
    }
?>
<?php 
    if(isset($_SESSION['user'])){
?>
        <a id="add-submission" href="/submissions/form" class="button button-glow button-rounded button-raised button-action">Add Submission</a>
<?php   
    }
    else{
?>
        <a id="login-button" class="button button-glow button-rounded button-raised button-action" href="<?php echo $data['github_login_url'] ?>">
            <span class="fa fa-github"></span>
            <span style="padding-left: 5px;">Sign Up With GitHub</span>
        </a>
<?php        
    }
?>