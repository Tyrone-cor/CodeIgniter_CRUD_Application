<?php

$this->extend('layout/main');
$this->section('body');

?>

<div class="d-flex flex-column min-vh-100">
    <div class="container mt-5 flex-grow-1">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Add Student</h3>
            </div>
            <div class="card-body">
                <form action="<?= base_url('students/store') ?>" method="post">
                    <div class="mb-3">
                        <label for="studentName" class="form-label">Student Name</label>
                        <input type="text" class="form-control" id="studentName" name="student_name" placeholder="Enter student name" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentYear" class="form-label">Student Year</label>
                        <input type="number" class="form-control" id="studentYear" name="student_year" placeholder="Enter student year" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentSection" class="form-label">Student Section</label>
                        <input type="text" class="form-control" id="studentSection" name="student_section" placeholder="Enter student section" required>
                    </div>
                    <div class="mb-3">
                        <label for="studentCourse" class="form-label">Student Course</label>
                        <input type="text" class="form-control" id="studentCourse" name="student_course" placeholder="Enter student course" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <a href="<?= base_url('students') ?>" class="btn btn-secondary me-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-black py-4">
        <p class="mb-0" style="font-size: 0.9rem;">&copy; <?= date('Y') ?> <span class="fw-bold">Jayvee Tyrone Cordova</span>. All rights reserved.</p>
    </footer>
</div>

<?php $this->endSection(); ?>

