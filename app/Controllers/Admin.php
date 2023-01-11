<?php

namespace App\Controllers;

use Tests\Support\Models\EventModel;

class Admin extends BaseController
{
  public function homepage()
  {
    return view('admin/homepage');
  }

  public function add_user()
  {
    $queryBuilder = $this->gradesectionModel->select("*")->get();
    
    $data = [
      'studentSection' => $queryBuilder
    ];
    
    return view('admin/adduser', $data);
  }

  public function admin_settings()
  {
    $queryBuilder = $this->accountModel->select('*')
      ->get();

    $data = [
      'accountData' => $queryBuilder
    ];
    return view('admin/adminsettings', $data);
  }

  public function student(){
    return view ('admin/student');
  }

  public function add_student(){
    helper(['form']);

    if($this->request->getMethod() == 'post'){
      $file = $this->request->getFile('file');

      /*
      *Move file to the public/csvfiles
      */
      $newFile = $file->getRandomName();
      $file->move('../public/csvfile', $newFile);
      $file = fopen("../public/csvfile/".$newFile, "r");
      $grade = $this->request->getVar("grade");
      $section = $this->request->getVar("section");


      $rowCount = 0;
      while(($filedata = fgetcsv($file, 1000, ",")) !== FALSE){

        if($rowCount > 0){
          $firstName = $filedata[0];
          $lastName = $filedata[1];
          $middleName = $filedata[2];
          $age = $filedata[3];
          $gender = $filedata[4];
          $lrn = $filedata[5];
          $qrCode = $firstName . " " . $lastName . " " . $middleName . " " .$lrn . " " . $gender . " " . $grade . " " . $section;
          $hashQRCode  = password_hash($qrCode, PASSWORD_DEFAULT);

          $student_data = [
            'FIRSTNAME' => $firstName,
            'LASTNAME' => $lastName,
            'MIDDLENAME' => $middleName,
            'AGE' => $age,
            'GENDER' => $gender,
            'QR' => $hashQRCode,
            'GRADE' => $grade,
            'LRN' => $lrn,
            'SECTION' => $section,
            'NUM_OF_PRESENT' => 0,
            'NUMBER_OF_ABSENCES' => 0,
            'TOTAL_ATTENDANCE' => 0,
            'ABSENCES' => 0,
          ];
          $this->studentModel->save($student_data);
        }
        
        $rowCount+=1;
      }
      session()->setFlashdata('message', ($rowCount-1). " Student(s) added successfully");
      session()->setFlashdata('alert-class', 'alert-success');
      return redirect()->to('admin_student');
    }

  }
 
  public function create_user()
  {
    helper(['form']);

    if ($this->request->getMethod() == 'post') {
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');
      $fName = $this->request->getVar('firstname');
      $lName = $this->request->getVar('lastname');
      $age = $this->request->getVar('age');
      $userType = $this->request->getVar('usertype');
      $created_at = date("Y-m-d H:i:s");
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);

      $classId = ($userType == "2") ? $this->request->getVar('classId') : NULL;
      if($userType == "2"){
        $classId = $this->request->getVar('classId');
        $accountData = [
          'USERNAME' => $username,
          'PASSWORD' => $hashPassword,
          'FNAME' => $fName,
          'LNAME' => $lName,
          'AGE' => $age,
          'USERTYPE' => $userType,
          'DATE' => $created_at,
          'CLASS_ID' => $classId,
        ];
        
        $queryBuilder = $this->accountModel->WHERE("CLASS_ID", $classId)->first();
        
        if($queryBuilder){
          session()->setFlashdata('registered_failed', "Failed to add user");
        }

        else{
          
          $this->accountModel->save($accountData);
          session()->setFlashdata('registered', "User added successfully");
          
          
          $user_id = $this->accountModel->getInsertId();
          
          $data = [
            "TEACHER_ID" => $user_id,
            "GRADE_SECTION_ID" => $classId,
            "ROLE" => 0,
            "SUBJECT" => NULL,
          ];
          $this->teacherSectionsModel->save($data);
        }
        
      }

      else{

        $accountData = [
          'USERNAME' => $username,
          'PASSWORD' => $hashPassword,
          'FNAME' => $fName,
          'LNAME' => $lName,
          'AGE' => $age,
          'USERTYPE' => $userType,
          'DATE' => $created_at,
          'CLASS_ID' => NULL,
        ];
  
        $this->accountModel->save($accountData);
        session()->setFlashdata('registered', "User added successfully");


      }
      
      return redirect()->to('admin_add_user');
    }
  }

  public function create_event()
  {
    helper(['form']);

    if ($this->request->getMethod() == "post") {
      $eventName = $this->request->getVar('eventname');
      $eventVenue = $this->request->getVar('eventvenue');
      $eventDate = $this->request->getVar('eventdate');
      $eventType = $this->request->getVar('eventtype');
      $created_at = date("Y-m-d H:i:s");
      $eventData = [
        'NAME' => $eventName,
        'VENUE' => $eventVenue,
        'SCHEDULE' => $eventDate,
        'DATE_CREATED' => $created_at,
        'TYPE' => $eventType,
      ];
      $this->eventModel->save($eventData);

      session()->setFlashdata('event_created', "Event added successfully");
      return redirect()->to('admin_homepage');
    }
  }

  public function update_account()
  {
    helper(['form']);
    if ($this->request->getMethod() == "post") {
      $fName = $this->request->getVar('firstname');
      $lName = $this->request->getVar('lastname');
      $userName = $this->request->getVar('username');
      $ID = $this->request->getVar('id');
      $accountData = [
        'USERNAME' => $userName,
        'FNAME' => $fName,
        'LNAME' => $lName,
      ];

      $this->accountModel->update($ID, $accountData);
      return redirect()->to('admin_settings');
    }
  }


  public function delete_account($id = 0)
  {
    $userID = $id;
    $this->accountModel->where('ID', $userID)->delete();
    session()->setFlashdata('deleted', 'Account Deleted Successfully');
    return redirect()->to('admin_settings');
  }

  public function print_records()
  {
    $queryBuilder = $this->studentModel->select("*")->get();

    $data = [
      'studentData' => $queryBuilder
    ];

    return view('admin/studentrecords', $data);
  }

  public function admin_teachers(){
    $queryBuilder = $this->accountModel->query("SELECT * FROM account a 
                      INNER JOIN gradesection g on g.ID = a.CLASS_ID 
                      where a.USERTYPE = 2");

    $data = [
      'teacherData' => $queryBuilder
    ];
    return view ('admin/teacher', $data);
  }

  public function admin_teacher_subjects($id = 0){
    $queryBuilder = $this->teacherSectionsModel->query("SELECT * FROM teacher_sections ts 
                      INNER JOIN gradesection g on g.ID = ts.GRADE_SECTION_ID 
                      where ts.TEACHER_ID = $id");

    $querySections = $this->gradesectionModel->select("*")->get();

    $data = [
      'teacherData' => $queryBuilder,
      'gradeSections' => $querySections,
      'teacherID' => $id
    ];
    return view ('admin/teacher_subject', $data);

  }

  public function admin_assign_new_subject($id = 0){
    helper(['form']);

    if ($this->request->getMethod() == 'post') {
      $teacherID = $id;
      $role = $this->request->getVar("role");
      $classId = $this->request->getVar("classId");
      $subject = $this->request->getVar("subject");

      $teacherSectionData = [
        "TEACHER_ID" => $teacherID,
        "GRADE_SECTION_ID" => $classId,
        "ROLE" => $role,
        "SUBJECT" => $subject
      ];

      $validate = $this->teacherSectionsModel->query("SELECT COUNT(*) as result from teacher_sections ts 
                          where ts.TEACHER_ID = '$id' && ts.GRADE_SECTION_ID = '$classId'
                          && ts.`ROLE` = '$role' && lower(ts.SUBJECT) = '$subject'");

    
      if($validate->getResult()[0]->result > 0){
        session()->setFlashData('message', 'This data already exist');
        session()->setFlashData('message_color', 'alert-danger w-50');
      }

      else{
        session()->setFlashData('message', 'Successfully Added Teacher Subject and Section');
        session()->setFlashData('message_color', 'alert-success w-50');
        $this->teacherSectionsModel->save($teacherSectionData);

      }
      
      $returnValue = 'admin_teacher_subjects/'.$id;
      return redirect()->to($returnValue);
      
    }

  }

  public function admin_grade_level(){
    return view ('admin/students');
  }

  public function admin_calendar(){
    $result = $this->eventModel->select("*")->get();
    $data = [
      "events" => $result
    ];
    return view('admin/calendar', $data);
  }

  public function admin_student_status(){
    $result = $this->studentModel->select("*")->where("REQUESTED", 1)->get();
    $data = [
      "studentStatusData" => $result
    ];
    return view ('admin/studentstatus', $data);
  }

  public function admin_update_student_status(){

    if ($this->request->getMethod() == 'post') {
      $id = $this->request->getVar("id");
      $studentDATA = [
        "STATUS" => 0,
        "REQUESTED" => 0,
        "ABSENCES" => 0,
      ];
      $this->studentModel->update($id, $studentDATA);
      session()->setFlashdata('success_update', true);
    }
    return redirect()->to('admin_student_status');
  }


}
