<div class="container">
    <h1>Edit Code Submission</h1>
    <?php
        $name_flash = '';
        $description_flash = '';
        $picture_flash = '';
        $demo_flash = '';
        $code_flash = '';

        if(isset($_SESSION['flashed_edit_submission']) && count($_SESSION['flashed_edit_submission']) > 0){
            $flashed_data = $_SESSION['flashed_edit_submission'];

            $name_flash = $flashed_data['name'];
            $description_flash = $flashed_data['description'];
            $picture_flash = $flashed_data['picture'];
            $demo_flash = $flashed_data['demo'];
            $code_flash = $flashed_data['code'];

        }
        else{
            $original_submission = $_SESSION['submission_to_edit'];

            $name_flash = $original_submission->get('name');
            $description_flash = $original_submission->get('description');
            $picture_flash = $original_submission->get('picture');
            $demo_flash = $original_submission->get('demo');
            $code_flash = $original_submission->get('code');
        }

        if(isset($_SESSION['errors_edit_submission']) && count($_SESSION['errors_edit_submission']) > 0){
            foreach($_SESSION['errors_edit_submission'] as $error){
    ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $error ?>
            </div>
    <?php
            }
        }
    ?>
    <form action="/submission/edit" method="POST">
        <div class="form-group">
            <label for="name">Title *</label>
            <input type="text" value="<?php echo $name_flash?>" name="name" class="form-control" placeholder="Title" id="name">
        </div>

        <div class="form-group">
            <label for="description">Description *</label>
            <textarea class="form-control" name="description" id="description" rows="3" placeholder="Description"><?php echo $description_flash?></textarea>
        </div>

        <div class="row">
            <div class="col">
                <input type="text" value="<?php echo $picture_flash?>" name="picture" class="form-control" placeholder="Photo URL">
            </div>
            <div class="col">
                <input type="text" value="<?php echo $demo_flash?>" name="demo" class="form-control" placeholder="Demo URL">
            </div>
        </div>
        <br />
        <div class="form-group">
            <label for="code">Link to Code *</label>
            <input type="text" value="<?php echo $code_flash?>" name="code" class="form-control" placeholder="Code URL">
        </div>

        <script src="https://authedmine.com/lib/captcha.min.js" async></script>
        <div class="coinhive-captcha" data-hashes="1024" data-key="QliGBVREn55rxtTRa0K3revWcm9tq2C7">
            <em>Loading Captcha...<br>
            If it doesn't load, please disable Adblock!</em>
        </div>

        <button id="submit-button" class="button button-glow button-circle button-action button-jumbo"><i class="fa fa-check"></i></button>
    </form>
</div>