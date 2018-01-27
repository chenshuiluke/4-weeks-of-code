<div id="submissions">
    <h2 id="submissions-heading">Submissions</h2>
    <?php
        foreach($_SESSION['submissions'] as $key => $submission){
    ?>
            <?php
                $animation = $key % 2 === 0 ? 'fade-up-right' : 'fade-up-left';
            ?>
            <div class="card mb-3" data-aos="<?php echo $animation ?>" style="max-width: 18rem;">
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
                    <a href="/submission/view?id=<?php echo $submission->get('id') ?>" class="btn btn-primary">View</a>
                </div>
            </div>    
    <?php        
        }
    ?>
</div>