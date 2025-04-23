<?php

namespace App\Models;
use CodeIgniter\Model;

class StudentsModel extends Model
{
    protected $table = 'tbl_students';
    protected $primaryKey = 'id';
    protected $allowedFields = ['student_name', 'student_year', 'student_section', 'student_course'];
    protected $useTimestamps = false;
}

