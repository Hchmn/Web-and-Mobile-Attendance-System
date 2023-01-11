<?php

namespace App\Models;

use CodeIgniter\Model;

class Event extends Model
{
  protected $table = 'event';

  protected $primaryKey = 'ID';
  protected $allowedFields = ['NAME', 'VENUE', 'SCHEDULE', 'DATE_CREATED', 'TYPE'];
}
