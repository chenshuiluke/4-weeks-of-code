<?php
    require "../app/views/partials/header.php";
?>
<h1>Home</h1>
<?php
    if(isset($data) && isset($data['github_login_url'])){
?>
        <a href="<?php echo $data['github_login_url'] ?>">Sign Up With GitHub</a>
<?php
    }
    else{

    }
    
?>