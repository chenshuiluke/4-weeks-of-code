<?php
    $user = $_SESSION['user_being_viewed'];
    $submissions = $user->submissions();

?>
<h2 id="user-profile-username"><?php echo $user->get('username') ?></h2>
<img class="img img-fluid" id="user-profile-img" src="<?php echo $user->get('avatar') ?>">

<ol class="progress-indicator stepped stacked">
<?php
    foreach($submissions as $submission){
?>
        <li class="completed">
            <span class="bubble"></span>
            <a href="#">
                <span class="stacked-text montserrat">
                    <div> <?php echo $submission->get('name') ?> </div>
                    <span class="fa fa-calendar"></span>
                    <span class="subdued"><?php echo $submission->get("date"); ?></span>
                </span>
            </a>
        </li>
<?php      
    }
?>
</ol>