<?php

namespace App\Models;

use CodeIgniter\Model;

class Student extends Model
{
  protected $table = 'student';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['FIRSTNAME', 'LASTNAME', 'MIDDLENAME', 'AGE', 'GENDER', 'QR', 'LRN', 'GRADE', 'SECTION', 'NUM_OF_PRESENT',  'NUMBER_OF_ABSENCES','TOTAL_ATTENDANCE', 
                              'STATUS','ABSENCES', 'REQUESTED', 'NUMBER_OF_LATES', 'LATE'];
}
