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

    public function student_records(){
        $class_id = session()->get('classID'); 
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

        $result = $this->eventModel->select("*")->get();
        $data = [
          "events" => $result
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
            // echo $fName;
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
                'ABSENCES' => 0,
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
        if(session()->has('classID')) {
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
                    "STATUS" => 1,
                    "REQUESTED" => 1,
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

    public function section_list(){

        $queryBuilderSection = $this->gradesectionModel->select("*")->get();
        $teacherID = session()->get("id");

        $queryBuilder = $this->teacherSectionsModel
                ->query("SELECT ts.id as ID, TEACHER_ID, GRADE_SECTION_ID, g.`YEAR` as 'YEAR', g.`SECTION` as 'SECTION', 
                        SUBJECT  from teacher_sections ts 
                        inner join gradesection g on g.ID = ts.GRADE_SECTION_ID 
                        where ts.TEACHER_ID = '$teacherID'");

        $data = [
            "teacherSections" => $queryBuilder
        ];
        return view ('user/sections', $data);
    }

    public function section_attendance($section = "", $grade = 0, $gradeSectionID = 0){

        $teacherID = session()->get("id");

        $queryBuilder = $this->studentAttendance
            ->query("SELECT sa.ID as ID, sa.TIME_IN, sa.`DATE`, sa.DATE_START, sa.DATE_END, sa.GRADE_SECTION_ID, ts.SUBJECT, sa.REMARKS, sa.TEACHER_SECTION_ID  
                from student_attendance sa
                    inner join student s on s.ID = sa.STUDENT_ID 
                    inner join teacher_sections ts on ts.ID = sa.TEACHER_SECTION_ID
                    where sa.teacher_section_id = '$teacherID'
                    group by sa.`DATE`");

        $data = [
            "attendanceData" => $queryBuilder,
            "sectionName" => $section,
            "grade" => $grade,
            "gradeSectionId" => $gradeSectionID
        ];

        return view ('user/section_attendance', $data);
    }

    public function update_section_date_attendance(){
        if($this->request->getMethod() == "post"){
            $remarks = $this->request->getVar("remarks");
            $date = $this->request->getVar('date');
            $teacherSectionId = $this->request->getVar('teacher_section_id');
            $return = $this->request->getVar('return_data');
            $queryStudentAttendance = $this->studentAttendance
                ->query("SELECT * from student_attendance where `DATE` = '$date' and TEACHER_SECTION_ID = '$teacherSectionId'");
            
            foreach($queryStudentAttendance->getResult() as $studentAttendance){
                $studentData = [
                    "REMARKS" => $remarks
                ];

                $this->studentAttendance->update($studentAttendance->ID, $studentData);
            }
            
            session()->setFlashData("update_attendance", "Successfully Added Attendance");

        }
        return redirect()->to($return);
    }

    public function section_date_attendance($date = "", $teacherSectionId = 0){
        
        $teacherID = session()->get("id");

        $queryBuilder = $this->studentAttendance
            ->query("SELECT sa.TIME_IN, sa.ID as ID, s.FIRSTNAME, s.LASTNAME, sa.DATE_START, sa.DATE_END  from student_attendance sa
                inner join student s on s.ID = sa.STUDENT_ID 
                where sa.`DATE` = '$date' and sa.TEACHER_SECTION_ID = '$teacherSectionId'
                and sa.TEACHER_ID = '$teacherID' ");
        $data = [
            "studentsAttendance" => $queryBuilder
        ];

        return view('user/section_student_attendance', $data);
    }

    // public function section_attendance($section = "", $grade = 0, $gradeSectionID = 0){
    //     $GRADE_SECTION_ID = $gradeSectionID;
    //     $grade = $grade;
    //     $section = $section;
    //     $teacherID = session()->get("id");

    //     date_default_timezone_set('Asia/Manila');
    //     $date_today = date("Y-m-d");
    //     $queryBuilder = $this->studentAttendance->select("*")->WHERE("GRADE_SECTION_ID", $GRADE_SECTION_ID)->WHERE("DATE", $date_today)->WHERE("TEACHER_ID", $teacherID)->get();
    //     if(count($queryBuilder->getResult()) > 0){
    //         $validateAttendanceToday = false;
    //         $result = "";
    //         $attendance_data = array();
    //         $student_id = "";
    //         foreach($queryBuilder->getResult() as $test){
    //             $result = $test->DATE_START;
    //             $student_id = $test->STUDENT_ID;
    //             $studentQuery = $this->studentModel->select("*")->WHERE("ID",$student_id)->get();
    //             $studentQuery = $studentQuery->getRow();
    //             $studentName = $studentQuery->FIRSTNAME." ".$studentQuery->LASTNAME;
    //             $createArray = array($test->TIME_IN,$test->DATE_START, $test->DATE_END, $studentName);
    //             array_push($attendance_data,$createArray);
    //         }
    //         $result = substr($result, 0, 10);
    //         if($date_today == $result){
    //             $validateAttendanceToday = true;
                
    //             $DATA = [
    //                 "attendanceData" => $attendance_data,
    //                 "validateAttendanceToday" => $validateAttendanceToday,
    //                 "grade" => $grade,
    //                 "section" => $section,
    //                 "gradeSectionID" => $GRADE_SECTION_ID
    //             ];
    //             return view ('user/section_attendance', $DATA);
    //         }
    //     }
    //     $DATA = [
    //         "validateAttendanceToday" => false,
    //         "grade" => $grade,
    //         "section" => $section,
    //         "gradeSectionID" => $GRADE_SECTION_ID
    //     ];
    //     return view ('user/section_attendance', $DATA);
    // }

    // public function test(){
    //     $result = $this->studentModel->query("SELECT * from STUDENT");

    //     print_r($result->getResult()[0]-.);
    // }
    

    public function add_section_attendance(){

        if($this->request->getMethod() == "post"){
           
            $class_id = $this->request->getVar("gradeSectionID");
            $teacherID = session()->get("id");
            $yearLevel = $this->request->getVar("grade");
            $sectionName = $this->request->getVar("section");
            $relocate = "gradeSection" . "/" . $sectionName . "/" . $yearLevel . "/" . $class_id;
            $queryBuilder = $this->gradesectionModel->where('ID', $class_id)
                ->first();
            if($queryBuilder){
                date_default_timezone_set('Asia/Manila');
                $date_today = date("Y-m-d");
                $queryAttendance = $this->studentAttendance->select("*")->WHERE("DATE",$date_today)->WHERE("TEACHER_ID", $teacherID)->WHERE("GRADE_SECTION_ID", $class_id)->get();
                if(count($queryAttendance->getResult()) == 0){
                    $grade = $queryBuilder['YEAR'];
                    $section = $queryBuilder['SECTION'];
                    $date_start = $this->request->getVar("date_started");
                    $date_end = $this->request->getVar("date_end");
                    $getStudents = $this->studentModel->select("*")->WHERE("GRADE", $grade)->WHERE("SECTION", $section)->get();
                    
                    if(count($getStudents->getResult()) > 0){
                        
                        foreach($getStudents->getResult() as $studentData){
                            $STUDENT_ID = $studentData->ID;
                            $GRADE_SECTION_ID = $class_id;
                            $ATTENDANCE_DATA = [
                                "TIME_IN" => NULL,
                                "STUDENT_ID" => $STUDENT_ID,
                                "GRADE_SECTION_ID" => $GRADE_SECTION_ID,
                                "DATE_START" => $date_start,
                                "DATE_END" => $date_end,
                                "DATE" => $date_today,
                                "TEACHER_ID" => $teacherID,
                               
                            ];
                            $NUM_ABSENCES = $studentData->NUMBER_OF_ABSENCES + 1;
                            $CURRENT_ABSENCES = $studentData->ABSENCES + 1;
                            $data = ($CURRENT_ABSENCES >= 3) ? ["NUMBER_OF_ABSENCES" => $NUM_ABSENCES,"STATUS" => 1 , "ABSENCES" => $CURRENT_ABSENCES] : ["NUMBER_OF_ABSENCES" => $NUM_ABSENCES, "ABSENCES" => $CURRENT_ABSENCES];
                            
                            $this->studentModel->update($STUDENT_ID, $data);
                            $this->studentAttendance->save($ATTENDANCE_DATA);
                        }
                        $queryBuilder = $this->gradesectionModel->where('ID', $class_id)
                            ->first();
                            if($queryBuilder){
                                $grade = $queryBuilder['YEAR'];
                                $section = $queryBuilder['SECTION'];
                                $notification = $this->studentModel->select("*")->where("GRADE", $grade)->WHERE("SECTION", $section)->WHERE("STATUS", 1)->countAllResults(); 
                                $data = [
                                    "notification_number" => $notification,
                                    "section" => ucfirst(strtolower($section)),
                                    "grade" => $grade + 6,

                                ];
                                session()->set($data);
                            } 
                        
                        session()->setFlashData("added_attendance", "Successfully Added Attendance");
                        return redirect()->to($relocate);
                    }
                    else{
                        session()->setFlashData("enroll_students", "Zero Students in this Section");
                        return redirect()->to($relocate);
                    }
                }
                else{
                    session()->setFlashData("failed_attendance", "Failed To Add Attendance");
                    return redirect()->to($relocate);
                }
            }  
           
        }


    }

    public function add_section(){
        if ($this->request->getMethod() == 'post') {
            $section = $this->request->getVar("section");
            $teacherId = session()->get("id");
            $data = [
                "GRADE_SECTION_ID" => $section,
                "TEACHER_ID" => session()->get("id")
            ];
            $queryBuilder = $this->teacherSectionsModel->WHERE("TEACHER_ID", $teacherId)->WHERE("GRADE_SECTION_ID", $section)->first();
        
            if($queryBuilder){
                session()->setFlashdata("add_section_fail", "Failed to Add Section");
                return redirect()->to("section_list");
            }

            $this->teacherSectionsModel->save($data);
            session()->setFlashdata("add_section_success", "Successfully Added Section");
            
            return redirect()->to("section_list");
            
        }

    }

    
    public function view_student_data($studentId = 0){
        $id = $studentId;
        $queryBuilder = $this->studentAttendance->select("*")->WHERE("STUDENT_ID", $id)->get();
        
        $studentData = array();
        
        $queryStudent = $this->studentModel->select("*")->WHERE("ID", $id)->first();
        $studentName = $queryStudent["FIRSTNAME"]." ".$queryStudent["LASTNAME"]; 

        foreach($queryBuilder->getResult() as $data){
            
            //get teacher name
            $queryTeacher = $this->accountModel->select("*")->WHERE("ID", $data->TEACHER_ID)->first();
            $teacherName = $queryTeacher["FNAME"]." ".$queryTeacher["LNAME"];

            $createArray = array($studentName, $teacherName, $data->TIME_IN, $data->DATE_START, $data->DATE_END);

            array_push($studentData, $createArray);

        }
        $data = [
            "student_data" => $studentData,
        ];
        return view ("user/sections/viewstudentdata",$data);
    }


    public function update_event_schedule(){
        if ($this->request->getMethod() == 'post') {
            $eventName = $this->request->getVar("eventName");
            $eventVenue = $this->request->getVar("eventVenue");
            $eventDate = $this->request->getVar("eventDate");
            $eventId = $this->request->getVar("eventId"); 

            $data = [
                "NAME" => $eventName,
                "VENUE" => $eventVenue,
                "SCHEDULE" => $eventDate,
            ];

            $this->eventModel->update($eventId, $data);
            
        }
        return redirect()->to("event");
        
    }



}
