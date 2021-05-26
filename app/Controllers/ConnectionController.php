<?php

namespace App\Controllers;

//MODELS
use App\Models\UserModel;
use App\Models\UserLogModel;

// ENTITIES
use App\Entities\User;
use App\Entities\LogUser;

class ConnectionController extends BaseController
{

    public function connection()
    {

        $data = [];
        $data["success"] = false;
        $data['csrf_token'] = csrf_hash();
        $data['error_username'] = "";
        $data['error_password'] = "";
        helper('form');

        if ($this->request->getMethod() == 'post') {

            $username = filter_input(INPUT_POST, "connection-username", FILTER_SANITIZE_STRING);
            $password = filter_input(INPUT_POST, "connection-password", FILTER_SANITIZE_STRING);

            $validation = \Config\Services::validation();

            $validation->setRules(
                [
                    'connection-username' => 'required',
                    'connection-password' => 'required',
                ],
                [   // Errors
                    'connection-username' => [
                        'required' => "Veuillez saisir votre nom d'utilisateur"
                    ],
                    'connection-password' => [
                        'required' => "Veuillez saisir votre mot de passe"
                    ],
                ]
            );

            $check = $validation->withRequest($this->request)->run();

            $data['validation'] = [];

            if (!$check) {
                $data['validation'] = $validation->getErrors();
            } else {

                if (isset($username) && (!empty($username))) {

                    $connectionModel = new UserModel();
                    $userList =  $connectionModel->where('username_user', $username)->find();

                    if (count($userList) > 0) {

                        if (isset($password) && (!empty($password))) {

                            $user = $userList[0];

                            $passwordDB = $user->password_user;
                            $validation = password_verify($password, $passwordDB);

                            if ($validation) {

                                $newLogUser = new LogUser();
                                $newLogUser->fill([
                                    'fk_id_user' => $user->id_user
                                ]);

                                $userLogModel = new UserLogModel();
                                $userLogModel->insert($newLogUser);

                                $dataSession = [
                                    'lastname' => $user->lastname_user,
                                    'firstname' => $user->firstname_user,
                                    'username_user' => $user->username_user,
                                    'id' => $user->id_user,
                                    'logged' => "yes",
                                    'logged_in' => true
                                ];

                                $data['firstname'] = $user->firstname_user;
                                $data['lastname'] = $user->lastname_user;

                                $this->session->set($dataSession);

                                $data['success'] = true;
                            } else {
                                $data['error_password'] = "Le mot de passe est incorrect";
                            }
                        }
                    } else {
                        $data['error_username'] = "Le nom d'utilisateur est incorrect";
                    }
                }
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        die;
    }

    public function disconnect()
    {

        $dataSession = [
            'lastname' => null,
            'firstname' => null,
            'username_user' => null,
            'id' => null,
            'logged' => "no",
            'logged_in' => false
        ];
        $this->session->set($dataSession);
      
        return $this->twig->render("pages/user.html");

    }
}
