<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function homepage()
    {
        if(session()->has('classID')){
            $class_id = session()->get('classID');
            $queryBuilder = $this->gradesectionModel->where('ID', $class_id)
                ->first();
                if($queryBuilder){
                    $grade = $queryBuilder['YEAR'];
                    $section = $queryBuilder['SECTION'];
                    $getStudents = $this->studentModel->select("*")->WHERE("GRADE", $grade)->WHERE("SECTION", $section)->get();
                    $notification = $this->studentModel->select("*")->where("GRADE", $grade)->WHERE("SECTION", $section)->WHERE("STATUS", 1)->countAllResults(); 
                    $data = [
                        "notification_number" => $notification,
                        "section" => ucfirst(strtolower($section)),
                        "grade" => $grade + 6,

                    ];
                    session()->set($data);
                    return view('user/homepage');
                }
        }
        return view('user/homepage');
    }

    public function student_records()
    {   $class_id = session()->get('classID');
        $queryBuilder = $this->gradesectionModel->where('ID', $class_id)
            ->first();
        $studentBuilder = $this->studentModel->select('*')->WHERE("GRADE",$queryBuilder['YEAR'])->WHERE('SECTION', $queryBuilder['SECTION'])->get();
        $data = [
            'studentData' => $studentBuilder
        ];
        return view('user/studentrecords', $data);
    }

    public function student_attendance()
    {
        return view('user/student_attendance');
    }

    public function teacher_setting(){
        $id = session()->get('id');
        $getData = $this->accountModel->where('ID', $id)
                ->first();
        $data = [
            'userData' => $getData
        ];
        return view('user/teachersettings', $data);
    }

    public function student_year($year = 0)
    {
        $getYear = $year;
        $queryBuilder = $this->gradesectionModel->select("*")->where("YEAR", $getYear)->get();
        $yearName = array("1" => "First Year", "2" => "Second Year", "3" => "Third Year", "4" => "Fourth Year");
        $data = [
            'sectionData' => $queryBuilder,
            'yearName' => $yearName[$getYear]
        ];

        return view("user/sections/section", $data);
    }

    public function student_section($year = 0, $section = "")
    {
        $getYear = $year;
        $getSection = $section;
        $queryBuilder = $this->studentModel->select("*")->where("GRADE", $getYear)->where("SECTION", $getSection)->get();

        $data = [
            'sectionData' => $queryBuilder,
            'year' => $getYear,
            'section' => $getSection
        ];
        return view('user/sections/viewsection', $data);
    }

    public function event()
    {
        $queryBuilder = $this->eventModel->select('*')
            ->get();

        $data = [
            'eventData' => $queryBuilder
        ];
        return view('user/event', $data);
    }

    public function add_student()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            $fName = $this->request->getVar('firstname');
            $lName = $this->request->getVar('lastname');
            $mName = $this->request->getVar('middlename');
            $age = $this->request->getVar('age');
            $gender = $this->request->getVar('gender');
            $LRN = rand(100000000000,999999999999);
            $grade = $this->request->getVar('grade');
            $section = $this->request->getVar('section');

            $qrCode = $fName . " " . $lName . " " . $mName . " " .$LRN . " " . $gender . " " . $grade . " " . $section;
            $hashQRCode  = password_hash($qrCode, PASSWORD_DEFAULT);
            echo $fName;
            $student_data = [
                'FIRSTNAME' => $fName,
                'LASTNAME' => $lName,
                'MIDDLENAME' => $mName,
                'AGE' => $age,
                'GENDER' => $gender,
                'QR' => $hashQRCode,
                'GRADE' => $grade,
                'LRN' => $LRN,
                'SECTION' => $section,
                'NUM_OF_PRESENT' => 0,
                'NUMBER_OF_ABSENCES' => 0,
                'TOTAL_ATTENDANCE' => 200,
            ];

            $this->studentModel->save($student_data);

            session()->setFlashdata('registered', "Student added successfully");
            return redirect()->to('user_homepage');
        }
    }

    public function update_teacher_info()
    {
        helper(['form']);
        if($this->request->getMethod() == "post"){
            $fName = $this->request->getVar('firstname');
            $lName = $this->request->getVar('lastname');
            $age = $this->request->getVar('age');
            $id = $this->request->getVar('id');
            
            $teacherData = [
                "FNAME" => $fName,
                "LNAME" => $lName,
                "AGE" => $age,
            ];

            $data = [
                "fname" => $fName,
                "lname" => $lName,
                "age" => $age,
            ];

            session()->set($data);
            $this->accountModel->update($id, $teacherData);
            session()->setFlashdata('update_teacher_info', "Teacher Account Updated Successfully");       
            return redirect()->to('teachersettings');
        }
    }

    public function update_teacher_account(){
        if($this->request->getMethod() == "post"){
            $username = $this->request->getVar('username');
            $password = $this->request->getVar('password');
            $id = $this->request->getVar('id');
            $hashPassword = password_hash($password, PASSWORD_DEFAULT);
            $teacherAccountData = [
                "USERNAME" => $username,
                "PASSWORD" => $hashPassword,
            ];
            $this->accountModel->update($id, $teacherAccountData);
            session()->setFlashdata('update_teacher_account', "Teacher Account Updated Successfully");
            return redirect()->to('teachersettings');
        }
    }

    public function notification(){
        if(session()->has('classID')){
            $class_id = session()->get('classID');
            $queryBuilder = $this->gradesectionModel->where('ID', $class_id)
                ->first();
                if($queryBuilder){
                    $grade = $queryBuilder['YEAR'];
                    $section = $queryBuilder['SECTION'];
                    $getStudents = $this->studentModel->select("*")->WHERE("GRADE", $grade)->WHERE("SECTION", $section)->get();
                    $notification = $this->studentModel->select("*")->where("GRADE", $grade)->WHERE("SECTION", $section)->WHERE("STATUS", 1)->countAllResults();
                    $data = [
                        "studentData" => $getStudents,
                    ];
                    session()->set("notification_number", $notification);
                    session()->set("studentData", true);
                    return view ('user/notification', $data);
                }
        }
        session()->set("studentData", false);
        return view('user/notification', );
    }

    public function update_student_status(){
        if($this->request->getMethod() == "post"){
            $id = $this->request->getVar('id');
            $status = $this->request->getVar('status');
            if($status == "1" || $status == "0"){
                $studentDATA = [
                    "STATUS" => $status
                ];
                $this->studentModel->update($id, $studentDATA);
                session()->setFlashdata('success_update', true);
            }
            else{
                session()->setFlashdata('failed_update', true);
            }
            
            return redirect()->to('notification');
            
        }
    }

    public function attendance(){
        $GRADE_SECTION_ID = session()->get('classID');
        $date_today = date('Y-m-d');
        $queryBuilder = $this->studentAttendance->select("*")->WHERE("GRADE_SECTION_ID", $GRADE_SECTION_ID)->WHERE("DATE", $date_today)->get();
        if(count($queryBuilder->getResult()) > 0){
            $validateAttendanceToday = false;
            $result = "";
            $attendance_data = array();
            $student_id = "";
            foreach($queryBuilder->getResult() as $test){
                $result = $test->DATE_START;
                $student_id = $test->STUDENT_ID;
                $studentQuery = $this->studentModel->select("*")->WHERE("ID",$student_id)->get();
                $studentQuery = $studentQuery->getRow();
                $studentName = $studentQuery->FIRSTNAME." ".$studentQuery->LASTNAME;
                $createArray = array($test->TIME_IN,$test->DATE_START, $test->DATE_END, $studentName);
                array_push($attendance_data,$createArray);
            }
            $result = substr($result, 0, 10);
            if($date_today == $result){
                $validateAttendanceToday = true;
                
                $DATA = [
                    "attendanceData" => $attendance_data,
                    "validateAttendanceToday" => $validateAttendanceToday,
                ];
                return view ('user/attendance', $DATA);
            }
        }
        $DATA = [
            "validateAttendanceToday" => false
        ];
        return view ('user/attendance', $DATA);
    }

    public function add_attendance(){
        if($this->request->getMethod() == "post"){
            if(session()->has('classID')){
                $class_id = session()->get('classID');
                $queryBuilder = $this->gradesectionModel->where('ID', $class_id)
                    ->first();
                if($queryBuilder){
                    $date_today = date('Y-m-d');
                    $queryAttendance = $this->studentAttendance->select("*")->WHERE("DATE",$date_today)->get();
                    if(count($queryAttendance->getResult()) == 0){
                        $grade = $queryBuilder['YEAR'];
                        $section = $queryBuilder['SECTION'];
                        $date_start = $this->request->getVar("date_started");
                        $date_end = $this->request->getVar("date_end");
                        $getStudents = $this->studentModel->select("*")->WHERE("GRADE", $grade)->WHERE("SECTION", $section)->get();
                
                        if(count($getStudents->getResult()) > 0){
                            foreach($getStudents->getResult() as $studentData){
                                $STUDENT_ID = $studentData->ID;
                                $GRADE_SECTION_ID = session()->get('classID');
                                $ATTENDANCE_DATA = [
                                    "TIME_IN" => NULL,
                                    "STUDENT_ID" => $STUDENT_ID,
                                    "GRADE_SECTION_ID" => $GRADE_SECTION_ID,
                                    "DATE_START" => $date_start,
                                    "DATE_END" => $date_end,
                                    "DATE" => $date_today,
                                ];
                                $NUM_ABSENCES = $studentData->NUMBER_OF_ABSENCES + 1;
                                $data = ($NUM_ABSENCES >= 3) ? ["NUMBER_OF_ABSENCES" => $NUM_ABSENCES,"STATUS" => 1 ] : ["NUMBER_OF_ABSENCES" => $NUM_ABSENCES];
                                
                                $this->studentModel->update($STUDENT_ID, $data);
                                $this->studentAttendance->save($ATTENDANCE_DATA);
                            }
                            session()->setFlashData("added_attendance", "Successfully Added Attendance");
                            return redirect()->to("attendance");
                        }
                        else{
                            session()->setFlashData("enroll_students", "Zero Students in this Section");
                            return redirect()->to("attendance");
                        }
                    }
                    else{
                        session()->setFlashData("failed_attendance", "Failed To Add Attendance");
                        return redirect()->to("attendance");
                    }
                }  
            }
        }
    }

}
