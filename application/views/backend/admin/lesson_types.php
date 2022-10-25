
<?php
    $selected_lesson = "youtube";
    if (isset($param3) && !empty($param3)) {
        $selected_lesson = $param3;
    }
 ?>
 <?php if($param2 == 'add_shortcut_lesson'): ?>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <select class="select2" id="course_id_for_lesson" name="course_id_for_lesson">
                    <option value=""><?= get_phrase('select_a_course'); ?></option>
                    <?php foreach($this->crud_model->get_course_by_course_type('general')->result_array() as $course): ?>
                        <option value="<?= $course['id']; ?>"><?= $course['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="alert alert-info" role="alert">
        Course: <strong><?= $this->crud_model->get_course_by_id($param2)->row('title'); ?></strong>
    </div>
    <input id="course_id_for_lesson" type="hidden" value="<?= $param2; ?>" name="course_id_for_lesson">
<?php endif; ?>

<h5 class="header-title mt-5 mt-sm-0"><?php echo get_phrase('select_book_to upload') ?></h5>

<div class="mt-3">
    <div class="custom-control custom-radio">
        <input type="radio" id="youtube" name="lesson_type" class="custom-control-input" value="youtube" <?php if($selected_lesson == 'youtube') echo 'checked'; ?>>
        <label class="custom-control-label" for="youtube">YouTube <?php echo get_phrase('video'); ?></label>
    </div>
    <!-- 
    <div class="custom-control custom-radio">
        <input type="radio" id="vimeo" name="lesson_type" class="custom-control-input" value="vimeo" <?php if($selected_lesson == 'vimeo') echo 'checked'; ?>>
        <label class="custom-control-label" for="vimeo">Vimeo <?php echo get_phrase('video'); ?></label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="video_file" name="lesson_type" class="custom-control-input" value="video" <?php if($selected_lesson == 'video') echo 'checked'; ?>>
        <label class="custom-control-label" for="video_file"><?php echo get_phrase('video_file'); ?></label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="html5" name="lesson_type" class="custom-control-input" value="html5" <?php if($selected_lesson == 'html5') echo 'checked'; ?>>
        <label class="custom-control-label" for="html5"> <?php echo get_phrase("video_url"); ?> [ <strong>.mp4</strong> ]</label>
    </div>
    <?php if (addon_status('amazon-s3')): ?>
        <div class="custom-control custom-radio">
            <input type="radio" id="amazon-s3" name="lesson_type" class="custom-control-input" value="amazon-s3" <?php if($selected_lesson == 'amazon-s3') echo 'checked'; ?>>
            <label class="custom-control-label" for="amazon-s3">Amazon S3 Bucket</label>
        </div>
    <?php endif;?>
    <div class="custom-control custom-radio">
        <input type="radio" id="google_drive_video" name="lesson_type" class="custom-control-input" value="google_drive_video" <?php if($selected_lesson == 'google_drive_video') echo 'checked'; ?>>
        <label class="custom-control-label" for="google_drive_video"><?php echo get_phrase('google_drive_video'); ?></label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="document" name="lesson_type" class="custom-control-input" value="document" <?php if($selected_lesson == 'document') echo 'checked'; ?>>
        <label class="custom-control-label" for="document"><?php echo get_phrase('document_file'); ?></label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="text" name="lesson_type" class="custom-control-input" value="text" <?php if($selected_lesson == 'text') echo 'checked'; ?>>
        <label class="custom-control-label" for="text"><?php echo get_phrase('text'); ?></label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="image" name="lesson_type" class="custom-control-input" value="image" <?php if($selected_lesson == 'image') echo 'checked'; ?>>
        <label class="custom-control-label" for="image"><?php echo get_phrase('image_file'); ?></label>
    </div> -->

    <?php include "book_type_lesson_add.php" ?>

    <div class="custom-control custom-radio d-none">
        <input type="radio" id="iframe" name="lesson_type" class="custom-control-input" value="iframe" checked>
        <label class="custom-control-label" for="iframe"><?php echo get_phrase('iframe_embed'); ?></label>
    </div>

    <div class="mt-3">
        <a href="javascript:void(0)"
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-dismiss="modal"
        id = "lesson-add-modal"
        onclick="showLessonAddModal()"><?php echo get_phrase('next'); ?></a>
    </div>
</div>

<script type="text/javascript">
    function showLessonAddModal() {
        var course_id = $("#course_id_for_lesson").val();
        if(course_id > 0){
            var url = "<?php echo site_url('modal/popup/lesson_add/'); ?>/"+course_id+'/'+$("input[name=lesson_type]:checked").val();
            showAjaxModal(url, '<?php echo get_phrase('add_new_lesson'); ?>');
        }else{
            error_notify('<?php echo get_phrase('please_select_a_course'); ?>');
        }
        
    }

    $(function() {
    var formSubmissionBtn = $('#bookUpload');
    var formSubmissionBtnTxt = $(formSubmissionBtn).html();
    //The form of submission to RailTeam js is defined here.(Form class or ID)
    $('#bookUpload').ajaxForm({
        beforeSend: function() {
            var percentVal = '0%';
            $(formSubmissionBtn).html('<?php echo get_phrase('uploading'); ?>... '+percentVal);
            $(formSubmissionBtn).attr('disabled', true);
        },
        uploadProgress: function(event, position, total, percentComplete) {
            var percentVal = percentComplete + '%';
            if(percentComplete < 100){
                $(formSubmissionBtn).html('<?php echo get_phrase('uploading'); ?>... '+percentVal);
            }else{
                $(formSubmissionBtn).html('<?php echo get_phrase('please_wait'); ?>... '+percentVal);
            }
        },
        complete: function(xhr) {
            setTimeout(function(){
                $(formSubmissionBtn).attr('disabled', false);
                $(formSubmissionBtn).html(formSubmissionBtnTxt);
                set_js_flashdata('<?php echo site_url('home/set_flashdata_for_js/flash_message/your_video_file_uploaded_succesfully') ?>');
                location.reload();
            }, 500);
        },
        error: function()
        {
            //You can write here your js error message
        }
    });
});

    if($('select').hasClass('select2') == true){
        $('div').attr('tabindex', "");
        $(function(){$(".select2").select2()});
    }
</script>