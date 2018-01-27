
<div class="card">

  <div class="card-body">
    <img class="img img-fluid" src="<?php echo $_SESSION['submission']->get('picture');?> " alt="Card image cap">

    <?php 
      if(isset($_SESSION['user']) && $_SESSION['submission']->get('user_id') === $_SESSION['user']->get('id')){
    ?>
        <div class="centered">
          <form action="/submission/delete" method="POST">
            <input name="id" hidden value="<?php echo $_SESSION['submission']->get('id') ?>">
            <button type="submit" class="btn btn-orange">
              <i class="fa fa-trash" aria-hidden="true"></i>
            </button>
          </form>
          <form>
            <button action="/submission/edit/form" method="GET" class="btn btn-success">
              <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
            </button>    
          </form>
        </div>
    <?php
      }
    ?>

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