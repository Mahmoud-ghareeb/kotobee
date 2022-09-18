
<div class="form-group">
    <label> <?php echo get_phrase('copy_this_folder_name'); ?></label>
    
    <div>
        <?php 
            $random_folder_name = md5(uniqid(rand(), true));
            $this->session->set_userdata('random_folder_name', $random_folder_name);
        ?>
        <div class="form-group">
            <input type="text" class="form-control" id="attachment" name="attachment" value="<?php echo $random_folder_name ?>">
        </div>
    </div>

</div>
