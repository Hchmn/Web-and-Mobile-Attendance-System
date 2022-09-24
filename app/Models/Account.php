<?php

namespace App\Models;

use CodeIgniter\Model;

class Account extends Model
{
  protected $table = 'account';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['USERNAME', 'PASSWORD', 'FNAME', 'LNAME', 'AGE', 'USERTYPE', 'DATE', 'CLASS_ID'];
}
