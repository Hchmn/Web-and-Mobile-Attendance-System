<?php

namespace App\Models;

use CodeIgniter\Model;

class Student extends Model
{
  protected $table = 'student';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['FIRSTNAME', 'LASTNAME', 'MIDDLENAME', 'AGE', 'GENDER', 'QR', 'GRADE', 'SECTION'];
}
