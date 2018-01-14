<div id="submissions">
    <h2 id="submissions-heading">Submissions</h2>
    <?php
        foreach($_SESSION['submissions'] as $submission){
    ?>

            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
            <?php
                if(null !== $submission->get('picture')){
            ?>            
                    <img class="card-img-top" src="<?php echo $submission->get('picture') ?>">
            <?php
                }
            ?>            
                <div class="card-body">
                    <h5 class="card-title"><?php echo $submission->get('name') ?></h5>
                    <p class="card-text"><?php echo $submission->get('description') ?></p>
                    <a href="#" class="btn btn-light">View</a>
                </div>
            </div>    
    <?php        
        }
    ?>
</div>