<?php

$this->extend('layout/main');
$this->section('body');

?>

<div class="d-flex flex-column min-vh-100">
    <div class="container mt-5 flex-grow-1">
        <!-- Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success') ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?> 

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-primary fw-bold">Student List</h1>
            <a href="<?= base_url('students/create') ?>" class="btn btn-success">
                <i class="bi bi-plus-circle"></i> Add Student
            </a>
        </div>

        <!-- Enhanced Search Form -->
        <div class="mb-4">
            <div class="container px-3">
                <form action="<?= base_url('students') ?>" method="get" class="d-flex justify-content-center">
                    <div class="input-group shadow" style="max-width: 600px; width: 100%; border-radius: 50px; overflow: hidden; background-color: #ffffff;">
                        <!-- Hidden label for accessibility -->
                        <label for="searchInput" class="visually-hidden">Search Students</label>
                        <input 
                            type="text" 
                            id="searchInput" 
                            name="search" 
                            class="form-control form-control-lg border-0" 
                            placeholder="Search by name, year, section, or course" 
                            value="<?= esc($search ?? '') ?>" 
                            style="padding-left: 20px; background-color: #f8f9fa; font-size: 1rem;"
                            autocomplete="off"
                        >
                        <button 
                            class="btn btn-primary" 
                            type="submit" 
                            style="border-radius: 0; padding: 0 20px;" 
                            title="Search"
                        >
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <p class="text-center text-muted mt-2" style="font-size: 0.9rem; font-style: italic;">
                    Tip: You can search by any student detail like name, year, section, or course.
                </p>
            </div>
        </div>

        <!-- Student Table -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Year</th>
                        <th scope="col">Section</th>
                        <th scope="col">Course</th>
                        <th scope="col" class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody id="studentTableBody">
                    <?php if (!empty($students)): ?>
                        <?php foreach ($students as $student): ?>
                            <tr>
                                <td><?= esc($student['student_name']) ?></td>
                                <td><?= esc($student['student_year']) ?></td>
                                <td><?= esc($student['student_section']) ?></td>
                                <td><?= esc($student['student_course']) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('students/show/' . $student['id']) ?>" class="btn btn-info btn-sm" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('students/edit/' . $student['id']) ?>" class="btn btn-warning btn-sm" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('students/delete/' . $student['id']) ?>" class="btn btn-danger btn-sm" title="Delete" onclick="return confirm('Are you sure you want to remove this student from the list?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-muted">No students found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center text-black py-4">
        <p class="mb-0" style="font-size: 0.9rem;">&copy; <?= date('Y') ?> <span class="fw-bold">Jayvee Tyrone Cordova</span>. All rights reserved.</p>
    </footer>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function () {
        const query = this.value;

        // Make an AJAX request to fetch filtered results
        fetch(`<?= base_url('students/search') ?>?query=${query}`)
            .then(response => response.json())
            .then(data => {
                const tableBody = document.getElementById('studentTableBody');
                tableBody.innerHTML = ''; // Clear the table body

                if (data.length > 0) {
                    data.forEach(student => {
                        const row = `
                            <tr>
                                <td>${student.student_name}</td>
                                <td>${student.student_year}</td>
                                <td>${student.student_section}</td>
                                <td>${student.student_course}</td>
                                <td class="text-center">
                                    <a href="<?= base_url('students/show/') ?>${student.id}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="<?= base_url('students/edit/') ?>${student.id}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="<?= base_url('students/delete/') ?>${student.id}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this student from the list?');">
                                        <i class="fas fa-trash-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                } else {
                    tableBody.innerHTML = `
                        <tr>
                            <td colspan="5" class="text-center text-muted">No students found.</td>
                        </tr>
                    `;
                }
            });
    });
</script>

<?php $this->endSection(); ?>

