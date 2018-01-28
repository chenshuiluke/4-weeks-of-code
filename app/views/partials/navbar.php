<nav>
<a href="/"><img id="logo-img" class="img img-fluid" src="/assets/img/logo.png"></a>
<br/>
<div id="nav-flex">
<?php
    if(!isset($data)){
        $data = [];
    }
    if(!isset($data['github_login_url'])){
        $url = '/?go=go';
        $data['github_login_url'] = $url;
    }
    if(!isset($_SESSION['user'])){
?>
      <a class="subnav-link" href="<?php echo $data['github_login_url'] ?>">
            <span class="fa fa-github"></span>
            <span style="padding-left: 5px;">Sign Up With GitHub</span>
      </a>

<?php
    }
    if(isset($_SESSION['user'])){
?>
        <a class="subnav-link">
            <i class="fa fa-user-circle"></i>
            <span style="padding-left: 5px;"><?php echo $_SESSION['user']->get('username') ?></span>
        </a>

<?php
    }
?>
    <a class="subnav-link" href="/about">
        <i class="fa fa-info"></i>
        <span style="padding-left: 5px;">About</span>
    </a>
<?php
    if(isset($_SESSION['user'])){
?>
        <a class="subnav-link" href="/logout">
            <i class="fa fa-sign-out"></i>
            <span style="padding-left: 5px;">Logout</span>
        </a>

<?php
    }
?>    
</div>
</nav>
