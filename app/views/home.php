<?php
    require "../app/views/partials/header.php";
?>
<h1>Home</h1>
<?php
    if(isset($data) && isset($data['github_login_url'])){
?>
        <a href="<?php echo $data['github_login_url'] ?>">
            <span class="fa fa-github"></span>
            <span style="padding-left: 5px;">Sign Up With GitHub</span>
        </a>
<?php
    }
    else{

    }
    
?>