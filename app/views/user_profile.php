<?php
    $user = $_SESSION['user_being_viewed'];
    $submissions = $user->submissions();

?>
<h2 id="user-profile-username"><?php echo $user->get('username') ?></h2>
<img class="img img-fluid" id="user-profile-img" src="<?php echo $user->get('avatar') ?>">

<div class="container">
    <div class="list-group">
        <a class="list-group-item"><h3>Submissions</h3></a>
    <?php
        foreach($submissions as $submission){
    ?>
            <a href="/submission/view?id=<?php echo $submission->get('id')?>" class="list-group-item">
                <div class="media">
                    <img class="mr-3" src="<?php echo $submission->get('picture') ?>" alt="Generic placeholder image">
                    <div class="media-body">
                        <h5 class="mt-0"><?php echo $submission->get('name') ?></h5>
                        <p class="font-weight-light"><?php echo $submission->get("date"); ?></p>
                    </div>
                </div>
            </a>
    <?php      
        }
    ?>
    </div>
</div>