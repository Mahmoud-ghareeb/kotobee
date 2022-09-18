<input type="hidden" name="lesson_type" value="other-iframe">

<div class="form-group">
    <label><?php echo get_phrase('iframe_source'); ?>( <?php echo get_phrase('provide_the_source_only'); ?> )</label>
    <?php 
        $random_folder = $this->session->userdata('random_folder_name');
        $folder_url = site_url('uploads/books/' . $random_folder . '/book/index.html')
    ?>
    <input type="text" id = "iframe_source" name = "iframe_source" class="form-control" value="<?php echo $folder_url; ?>">
</div>
