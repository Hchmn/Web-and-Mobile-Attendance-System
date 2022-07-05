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
    return view('admin/adduser');
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

  public function create_user()
  {
    helper(['form']);

    if ($this->request->getMethod() == 'post') {
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');
      $fName = $this->request->getVar('firstname');
      $lName = $this->request->getVar('lastname');
      $userType = $this->request->getVar('usertype');
      $created_at = date("Y-m-d H:i:s");
      $hashPassword = password_hash($password, PASSWORD_DEFAULT);

      $accountData = [
        'USERNAME' => $username,
        'PASSWORD' => $hashPassword,
        'FNAME' => $fName,
        'LNAME' => $lName,
        'USERTYPE' => $userType,
        'DATE' => $created_at
      ];

      $this->accountModel->save($accountData);
      session()->setFlashdata('registered', "User added successfully");
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
      $created_at = date("Y-m-d H:i:s");
      $eventData = [
        'NAME' => $eventName,
        'VENUE' => $eventVenue,
        'SCHEDULE' => $eventDate,
        'DATE_CREATED' => $created_at,
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
}
