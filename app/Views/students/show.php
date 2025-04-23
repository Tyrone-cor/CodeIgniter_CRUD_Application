<?php

$this->extend('layout/main');
$this->section('body');

?>

<div class="d-flex flex-column min-vh-100">
    <div class="container mt-5 flex-grow-1">
        <div class="card shadow">
            <div class="card-header bg-info text-white">
                <h3 class="mb-0">Student Details</h3>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th class="bg-light">Name</th>
                        <td><?= esc($student['student_name']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Year</th>
                        <td><?= esc($student['student_year']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Section</th>
                        <td><?= esc($student['student_section']) ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light">Course</th>
                        <td><?= esc($student['student_course']) ?></td>
                    </tr>
                </table>
                <div class="d-flex justify-content-end">
                    <a href="<?= base_url('students') ?>" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-black py-4">
        <p class="mb-0" style="font-size: 0.9rem;">&copy; <?= date('Y') ?> <span class="fw-bold">Jayvee Tyrone Cordova</span>. All rights reserved.</p>
    </footer>
</div>

<?php $this->endSection(); ?>