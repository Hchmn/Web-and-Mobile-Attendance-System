<?php

namespace App\Models;

use CodeIgniter\Model;

class GradeSection extends Model
{
  protected $table = 'gradesection';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['YEAR', 'SECTION'];
}
