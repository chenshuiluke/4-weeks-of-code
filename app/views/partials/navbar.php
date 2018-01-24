<nav>
<h1 id="nav-header">Code Everyday</h1>
<?php
    if(isset($data) && isset($data['github_login_url']) && !isset($_SESSION['user'])){
?>
      <a id="nav-profile" href="<?php echo $data['github_login_url'] ?>">
            <span class="fa fa-github"></span>
            <span style="padding-left: 5px;">Sign Up With GitHub</span>
      </a>

<?php
    }
    if(isset($_SESSION['user'])){
?>
      <a id="nav-profile"><?php echo $_SESSION['user']->get('username') ?></a>

<?php
    }
?>
</nav>
