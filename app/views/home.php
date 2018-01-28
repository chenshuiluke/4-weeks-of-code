<div class="row">
    <div class="col-md-4">
        
    </div>
    <div class="col-md-4">
        <br />
        <?php
            if(isset($_SESSION['submissions']) && count($_SESSION['submissions']) > 0){
                require VIEW_PREFIX . '/partials/home/submissions.php';
            }
        ?>
    </div>
    <div class="col-md-4">
    </div>
</div>

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