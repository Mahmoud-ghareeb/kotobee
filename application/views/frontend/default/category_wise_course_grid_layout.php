<div class="row">
    <?php foreach ($courses as $course) :
        $instructor_details = $this->user_model->get_all_user($course['user_id'])->row_array();
        $course_duration = $this->crud_model->get_total_duration_of_lesson_by_course_id($course['id']);
        $lessons = $this->crud_model->get_lessons('course', $course['id']); ?>
        
    <?php endforeach; ?>
</div>