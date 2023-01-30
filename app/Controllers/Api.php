<?php 

namespace App\Controllers;

class Api extends BaseController {
    
    public function getUsers(){
        echo  base_url();
        // header("Content-type:application/json");
        // $queryBuilder = $this->studentModel->select("*")->get();
        // return $this->setResponseFormat('json')->respond($queryBuilder->getResult());
    }

    public function login(){
        header("Content-type:application/json");
        $queryBuilder = $this->eventModel->select("*")->get();

        $data = [
            "data" => $queryBuilder->getResult(),
            "message" => "OK"
        ];
        
        return $this->setResponseFormat('json')->respond($data);
    }

    public function loginUser(){
        echo  $this->base_url();
        header("Content-type:application/json");
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $getDetails = $this->accountModel->where('USERNAME', $username)
            ->first();

        if($getDetails){
            
            $checkPassword = password_verify($password, $getDetails['PASSWORD']);
            if($checkPassword){

                $data = [
                    "data" => $getDetails,
                    "message" => "Successfully Logged in",
                    "type" => "LOGIN"
                ];
                return $this->setResponseFormat('json')->respond($data, 200);
            }
        }
        
        $data = [
            "data" => null,
            "message" => "Invalid Account Details",
            "type" => "LOGIN"
        ];

        return $this->setResponseFormat('json')->respond($data, 403);
        
    }

    public function teacherSections($id = 0) {
        header("Content-type:application/json");

        $queryBuilder = $this->teacherSectionsModel->query("SELECT ts.ID, ts.TEACHER_ID, ts.GRADE_SECTION_ID, 
            ts.ROLE, ts.SUBJECT, g.ID as GRADEID, g.YEAR, g.SECTION FROM teacher_sections ts 
            INNER JOIN gradesection g on g.ID = ts.GRADE_SECTION_ID 
            where ts.TEACHER_ID = $id");

        $querySections = $this->gradesectionModel->select("*")->get();

        $data = [
            'data' => $queryBuilder->getResult(),
            'teacherID' => $id,
            'type' => 'TEACHER_SECTION',
            'status' => 200
        ];

        return $this->setResponseFormat('json')->respond($data, 200);
    }

    public function getTeacherSections(){
        header("Content-type:application/json");
        $id = $this->request->getVar("id");

        $queryBuilder = $this->teacherSectionsModel->query("SELECT * FROM teacher_sections ts 
            INNER JOIN gradesection g on g.ID = ts.GRADE_SECTION_ID 
            where ts.TEACHER_ID = $id");

        $querySections = $this->gradesectionModel->select("*")->get();

        $data = [
            'teacherData' => $queryBuilder->getResult(),
            'teacherID' => $id,
            'type' => 'TEACHER_SECTION'
        ];

        return $this->setResponseFormat('json')->respond($data, 200);
    }

    public function getStudentSection($grade = 0, $section = ""){

        $queryBuilder = $this->studentModel->query("SELECT * from student where 
            GRADE = '$grade' and lower(SECTION) = lower('$section')");

        $data = [
            'data' => $queryBuilder->getResult(),
            'type' => 'STUDENT_SECTION',
            'status' => 200
        ];

        return $this->setResponseFormat('json')->respond($data, 200);
    }

    public function startSectionAttendance($year = "", $teacherId = 0, $section = "", $gradeSectionId = 0, $teacherSectionId = 0){
        
        $queryStudent = $this->studentModel->query("SELECT * from student where 
            GRADE = '$year' and lower(SECTION) = lower('$section')");

        $message = "";
        $result = NULL;

        date_default_timezone_set('Asia/Manila');
        $date_today = date("Y-m-d");
        $date_start = date("Y-m-d H:i:s");
        $date_end = date("Y-m-d H:i:s", strtotime('+60 minutes'));

        $resultData = [
            "dateToday" => $date_today,
            "dateStart" => $date_start,
            "dateEnd" => $date_end,
            "teacherId" => $teacherId,
            "gradeSectionId" => $gradeSectionId,
            "teacherSectionId" => $teacherSectionId
        ];

        if(count($queryStudent->getResult()) > 0){
            
            
            $queryAttendance = $this->studentAttendance->select("*")->WHERE("DATE",$date_today)
                                    ->WHERE("TEACHER_ID", $teacherId)
                                    ->WHERE("GRADE_SECTION_ID", $gradeSectionId)
                                    ->WHERE("TEACHER_SECTION_ID", $teacherSectionId)
                                    ->get();
            
            if(count($queryAttendance->getResult()) == 0){
                foreach($queryStudent->getResult() as $student){
                    $ATTENDANCE_DATA = [
                        "TIME_IN" => NULL,
                        "STUDENT_ID" => $student->ID,
                        "GRADE_SECTION_ID" => $gradeSectionId,
                        "DATE_START" => $date_start,
                        "DATE_END" => $date_end,
                        "DATE" => $date_today,
                        "TEACHER_ID" => $teacherId,
                        "TEACHER_SECTION_ID" => $teacherSectionId,
                        "REMARKS" => "Present"
                    ];

                    $this->studentAttendance->save($ATTENDANCE_DATA);
                }

                $message = "Attendance has already started";
                $result = 1;
                $data = [
                    "data" => $resultData,
                    "type" => "STUDENT_ATTENDANCE",
                    "status" => 200,
                    "message" => $message
                ];
        
                return $this->setResponseFormat('json')->respond($data, 200);
                
            }
            $message = "Attendance had already started!"; 

        }

        $data = [
            "data" => $resultData,
            "type" => "STUDENT_ATTENDANCE",
            "status" => 200,
            "message" => $message
        ];

        return $this->setResponseFormat('json')->respond($data, 200);
    }

    public function test_(){
        date_default_timezone_set('Asia/Manila');
    
        $date = date("H:i:s");
        $date2 = strtotime("214:50:21");
        $result = $date2 - strtotime($date);
        
    }

    public function updateStudentAttendance(){
        date_default_timezone_set('Asia/Manila');

        $studentName = $this->request->getVar("firstName");
        $lrn = $this->request->getVar("LRN");
        $teacherSectionId = $this->request->getVar("teacherSectionId");
        $date = $this->request->getVar("date");
        $date_start = date("Y-m-d H:i:s");



        $queryStudent = $this->studentModel->query("SELECT * FROM student where lower(FIRSTNAME) = lower('$studentName')
                    and LRN = '$lrn'");
        if(count($queryStudent->getResult()) > 0){
            $studentId = 0;
            foreach($queryStudent->getResult() as $student){
                $studentId = $student->ID;
            }
            
            $queryStudentAttendance = $this->studentAttendance->query("SELECT * from student_attendance WHERE 
                        STUDENT_ID = '$studentId' and DATE = '$date' and  TEACHER_SECTION_ID = '$teacherSectionId'");

            if(count($queryStudentAttendance->getResult()) > 0){
                $attendanceId = 0;
                foreach($queryStudentAttendance->getResult() as $attendance){
                    $attendanceId = $attendance->ID;
                    
                    $dateStarted = date("H:i:s", strtotime($attendance->DATE_START));
                    $timeIn = date("H:i:s");
                    $timeIn = (strtotime($timeIn) - strtotime($dateStarted) >= 30) ? "LATE" : $date_Start;
                    
                    if($timeIN == "LATE"){
                        $query = $this->studentModel->select("*")->where("ID", $attendance->STUDENT_ID)->first();
                        
                    }

                    $data = [
                        "TIME_IN" => $timeIn
                    ];

                    $this->studentAttendance->update($attendanceId, $data);

                    $data = [
                        "message" => "Successfully Updated Student Attendance",
                        "type" => "UPDATE_STUDENT_ATTENDANCE",
                        "status" => 200, 
                    ];
                    return $this->setResponseFormat('json')->respond($data, 200);
                }
                
            }
            
        }
        $data = [
            "message" => "Failed to update Student Attendance",
            "type" => "UPDATE_STUDENT_ATTENDANCE",
            "status" => 400, 
        ];

        return $this->setResponseFormat('json')->respond($data, 200);
    }


    public function attendances($teacherSectionId = 0){
        $queryBuilder = $this->studentAttendance->query("SELECT * from  student_attendance 
                WHERE TEACHER_SECTION_ID = '$teacherSectionId' GROUP BY DATE");

        $data = [ 
            'data' => $queryBuilder->getResult(),
            "type" => "DAILY_ATTENDANCES",
            "status" => 200,
        ];

        return $this->setResponseFormat('json')->respond($data, 200);
    }

    public function section_attendance($date = "", $teacherSectionId = 0){
        $queryBuilder = $this->studentAttendance->query("SELECT sa.TIME_IN, sa.ID as ID, sa.DATE,  
                s.FIRSTNAME, s.LASTNAME, s.MIDDLENAME from student_attendance sa
                INNER JOIN student s on s.ID = sa.STUDENT_ID
                WHERE sa.DATE = '$date' and sa.TEACHER_SECTION_ID = '$teacherSectionId'");

        $data = [
            'data' => $queryBuilder->getResult(),
            'type' => "DATE_ATTENDANCE",
            'status' => 200,
        ];

        return $this->setResponseFormat('json')->respond($data, 200);

    }


}







?>