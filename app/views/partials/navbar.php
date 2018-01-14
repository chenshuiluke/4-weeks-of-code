<nav class="navbar navbar-dark bg-primary navbar-expand-lg">
  <a class="navbar-brand" href="/">4 Weeks of Code</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <?php
    if(isset($data) && isset($data['github_login_url']) && !isset($_SESSION['user'])){
?>
      <li class="nav-item">
      <a class="nav-link" href="<?php echo $data['github_login_url'] ?>">
            <span class="fa fa-github"></span>
            <span style="padding-left: 5px;">Sign Up With GitHub</span>
        </a>
      </li>

<?php
    }
    if(isset($_SESSION['user'])){
?>
      <li class="nav-item dropdown">
        <span class="two-column" >
          <img class="img img-fluid" src="<?php echo $_SESSION['user']->get('avatar') ?>">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $_SESSION['user']->get('username'); ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">View Profile</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="/logout">Logout</a>
        </div>
        </span>

      </li>

      <li class="nav-item two-column">

      </li>
<?php
      
    }
?>

      
    </ul>
  </div>
</nav>
