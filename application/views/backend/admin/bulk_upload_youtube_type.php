
<input type="hidden" name="lesson_type" value="bulk-type">
<input type="hidden" name="lesson_provider" value="youtube">

<!-- This portion is for mobile application video lesson -->
<div class="form-group d-none">
    <label for="lesson_provider"><?php echo get_phrase('lesson_provider'); ?>( <?php echo get_phrase('for_mobile_application'); ?> )</label>
    <select class="form-control select2" data-toggle="select2" name="lesson_provider_for_mobile_application" id="lesson_provider_for_mobile_application">
        <option value="html5" selected>HTML5</option>
    </select>
</div>

<div class="form-group">
    <label><?php echo get_phrase('duration'); ?>( <?php echo get_phrase('csv_file'); ?> )</label>
    <input type="file" class="form-control" name="bulk_youtube" id = "bulk_youtube" accept=".csv" >
</div>
