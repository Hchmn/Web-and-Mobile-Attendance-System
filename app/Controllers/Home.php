<?php

namespace App\Controllers;


class Home extends BaseController
{
    public function homepage()
    {

        return view('user/homepage');
    }

    public function student_records()
    {
        $queryBuilder = $this->studentModel->select('*')
            ->get();

        $data = [
            'studentData' => $queryBuilder
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
            'sectionData' => $queryBuilder
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
            $grade = $this->request->getVar('grade');
            $section = $this->request->getVar('section');

            $qrCode = $fName . " " . $lName . " " . $mName;
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
                'SECTION' => $section,
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

}
