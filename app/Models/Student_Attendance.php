<?php

namespace App\Models;

use CodeIgniter\Model;

class Student_Attendance extends Model
{
  protected $table = 'student_attendance';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['TIME_IN', 'STUDENT_ID', 'GRADE_SECTION_ID', 'DATE_START', 'DATE_END', 'DATE', 'TEACHER_ID', 'TEACHER_SECTION_ID', 'REMARKS'];
}