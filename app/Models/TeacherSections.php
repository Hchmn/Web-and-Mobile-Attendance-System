<?php

namespace App\Models;

use CodeIgniter\Model;

class TeacherSections extends Model
{
  protected $table = 'teacher_sections';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['TEACHER_ID', 'GRADE_SECTION_ID'];
}
