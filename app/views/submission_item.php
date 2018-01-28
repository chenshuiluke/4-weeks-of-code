
<div class="card">

  <div class="card-body">
    <?php
      if(null !== $_SESSION['submission']->get('picture')){
    ?>
        <img class="img img-fluid" src="<?php echo $_SESSION['submission']->get('picture');?> " alt="Card image cap">
    <?php
      }
    ?>


    <div class="centered">
      <?php 
        if(isset($_SESSION['user']) && $_SESSION['submission']->get('user_id') === $_SESSION['user']->get('id')){
      ?>
        <form action="/submission/delete" method="POST">
          <input name="id" hidden value="<?php echo $_SESSION['submission']->get('id') ?>">
          <button type="submit" class="btn btn-orange">
            <i class="fa fa-trash" aria-hidden="true"></i>
          </button>
        </form>
        <form action="/submission/edit/form" method="GET">
          <button class="btn btn-success">
            <input name="id" hidden value="<?php echo $_SESSION['submission']->get('id') ?>">
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          </button>    
        </form>
      <?php
        }
      ?>          
      <form>
        <a class="btn btn-info" target="_blank" href="<?php echo $_SESSION['submission']->get('code') ?>">
          <i class="fa fa-code" aria-hidden="true"></i>
        </a> 
      </form>
    </div>


    <h5 class="card-title">
        <?php echo $_SESSION['submission']->get('name'); ?>
    </h5>
    <p class="card-text">
      <?php echo $_SESSION['submission']->get('description'); ?>
    </p>
    <!-- <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p> -->
    <div>

    </div>
  </div>
  
</div>