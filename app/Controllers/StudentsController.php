<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\StudentsModel;

class StudentsController extends Controller
{
    protected $studentModel;

    public function __construct()
    {
        $this->studentModel = new StudentsModel();
    }

    public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // Additional initialization code
    }

    public function index()
    {
        $search = $this->request->getGet('search'); // Get the search query
        $studentModel = new StudentsModel();

        if ($search) {
            // Search by name, year, section, or course
            $students = $studentModel->like('student_name', $search)
                                     ->orLike('student_year', $search)
                                     ->orLike('student_section', $search)
                                     ->orLike('student_course', $search)
                                     ->where('is_deleted', 0) // Ensure soft-deleted students are excluded
                                     ->findAll();
        } else {
            // Fetch all students if no search query
            $students = $studentModel->where('is_deleted', 0)->findAll();
        }

        $data = [
            'students' => $students,
            'search' => $search, // Pass the search query back to the view
        ];

        return view('students/list', $data);
    }

    public function create()
    {
        // Code to show form for creating a new student
        return view('students/add');
    }

    public function store()
    {
        // Code to save a new student
        $insertStudent = new studentsModel();
        $data = array(
            'student_name' => $this->request->getPost('student_name'),
            'student_year' => $this->request->getPost('student_year'),
            'student_section' => $this->request->getPost('student_section'),
            'student_course' => $this->request->getPost('student_course')
        );

        $insertStudent->insert($data);

        return redirect()->to('/students')->with ('success', 'Student Added Successfully');
    }

    public function edit($id)
    {
        // Code to show form for editing a student
        $fetchStudent = new StudentsModel();
        $data['student'] = $fetchStudent->where('id', $id) ->first();
        return view('students/edit', $data);
    }

    public function update($id)
    {
        // Code to update a student
        $updateStudent = new StudentsModel();

        $data = array(
            'student_name' => $this->request->getPost('student_name'),
            'student_year' => $this->request->getPost('student_year'),
            'student_section' => $this->request->getPost('student_section'),
            'student_course' => $this->request->getPost('student_course')
        );

        $updateStudent->update($id, $data);
        return redirect()->to('/students')->with ('success', 'Student Updated Successfully');

    }

    public function delete($id)
    {
        $deleteStudent = new StudentsModel();
        $deleteStudent->where('id', $id)->delete($id);

        // Set flash message
        return redirect()->to('/students')->with('success', 'Student Deleted Successfully');
    }

    public function show($id)
    {
        $student = $this->studentModel->find($id);

        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found.');
        }

        $data['student'] = $student;

        return view('students/show', $data);
    }

    public function search()
    {
        $query = $this->request->getGet('query');
        $studentModel = new StudentsModel();

        if ($query) {
            $students = $studentModel->like('student_name', $query)
                                     ->orLike('student_year', $query)
                                     ->orLike('student_section', $query)
                                     ->orLike('student_course', $query)
                                     ->where('is_deleted', 0)
                                     ->findAll();
        } else {
            $students = $studentModel->where('is_deleted', 0)->findAll();
        }

        return $this->response->setJSON($students);
    }
}