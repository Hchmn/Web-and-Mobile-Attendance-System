<?php

namespace App\Controllers;

class Login extends BaseController
{

  public function login()
  {
    if (session()->has('id')) {
      session_destroy();
    }

    return view('login');
  }

  public function verifyData()
  {

    helper(['form']);
    if ($this->request->getMethod() == 'post') {
      $username = $this->request->getVar('username');
      $password = $this->request->getVar('password');
      $usertype = $this->request->getVar('usertype');

      $getDetails = $this->accountModel->where('USERNAME', $username)
        ->first();

      if ($getDetails) {
        $checkPassword = password_verify($password, $getDetails['PASSWORD']);
        if ($checkPassword) {
          $this->setUserSession($getDetails);
          if (session()->has('id')) {
            if ($getDetails['USERTYPE'] == 2) {
              return redirect()->to('/user_homepage');
            } elseif ($getDetails['USERTYPE'] == 1) {
              return redirect()->to('/admin_homepage');
            } else {
              session()->setFlashdata('invalidAccDetails', "Invalid Account Details");
              return redirect()->to('/');
            }
          }
        } else {
          session()->setFlashdata('invalidAccDetails', "Invalid Account Details");
          return redirect()->to('/');
        }
      } else {
        session()->setFlashdata('invalidAccDetails', "Invalid Account Details");
        return redirect()->to('/');
      }
    }
  }


  public function setUserSession($user)
  {
    $data = [
      'id' => $user['ID'],
      'username' => $user['USERNAME'],
      'fname' => $user['FNAME'],
      'lname' => $user['LNAME'],
      'age' => $user['AGE'],
      'usertype' => $user['USERTYPE'],
    ];

    session()->set($data);
    return true;
  }
}
