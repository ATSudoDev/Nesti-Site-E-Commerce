<?php

namespace App\Controllers;

//MODELS
use App\Models\CityModel;
use App\Models\UserModel;

// ENTITIES
use App\Entities\User;
use App\Entities\City;

class UserController extends BaseController
{

    public function register()
    {
        $data = [];
        $data["success"]= false;
        $data['csrf_token'] = csrf_hash();
        helper('form');

        if ($this->request->getMethod() == 'post') {

            $validation = \Config\Services::validation();

            $validation->setRules(
                [
                    'firstname' => 'required|regex_check_name',
                    'lastname' => 'required|regex_check_name',
                    'username' => 'required|regex_check_username|is_unique[users.username_user]',
                    'password' => 'required|regex_check_password',
                    'email'    => 'required|valid_email',
                    'address1' => 'required',
                    'postcode' => 'required|regex_check_postcode',
                    'city' => 'required|regex_check_city',
                ],
                [   // Errors
                    'lastname' => [
                        'regex_check_name' => "Votre saisie nom ne respecte pas les conditions",
                        'required' => "Veuillez saisir votre nom"
                    ],
                    'firstname' => [
                        'regex_check_name' => "Votre saisie prénom ne respecte pas les conditions",
                        'required' => "Veuillez saisir votre prénom"
                    ],
                    'username' => [
                        'regex_check_username' => "Votre saisie nom d'utilisateur ne respecte pas les conditions. Il doit contenir entre 3 et 20 caractères.",
                        'is_unique' => "Ce nom d'utilisateur est déjà pris",
                        'required' => "Veuillez saisir un nom d'utilisateur"
                    ],
                    'password' => [
                        'regex_check_password' => "Le mot de passe n'est pas assez fort ou ne respecte pas les conditions",
                        'required' => "Veuillez saisir un mot de passe"
                    ],
                    'postcode' => [
                        'regex_check_postcode' => "Votre saisie code postal ne respecte pas les conditions",
                        'required' => "Veuillez saisir votre code postal"
                    ], 
                    'address1' => [
                        'required' => "Veuillez saisir votre adresse"
                    ],
                    'email' => [
                        'valid_email' => "Votre saisie adresse email ne respecte pas les conditions",
                        'required' => "Veuillez saisir votre adresse email"
                    ],
                    'city' => [
                        'regex_check_city' => "Votre saisie ville ne respecte pas les conditions",
                        'required' => "Veuillez saisir votre ville"
                    ]

                ]
            );

            $check = $validation->withRequest($this->request)->run();

            if (!$check) {
                $data['validation'] = $validation->getErrors();
            } else {

                $lastname = $this->request->getPost('lastname');
                $firstname = $this->request->getPost('firstname');
                $username = $this->request->getPost('username');
                $email = $this->request->getPost('email');
                $password = $this->request->getPost('password');
                $address1 = $this->request->getPost('address1');
                $address2 = $this->request->getPost('address2');
                $postcode = $this->request->getPost('postcode');
                $cityName = $this->request->getPost('city');

                $cityModel = new CityModel();

                if (($cityModel->where("name_city", $cityName)->find()) == null) {
                    $newCity = new City();
                    $newCity->fill(['name_city' => $cityName]);
                    $cityModel->insert($newCity); 
                } else {
                    $city = $cityModel->where("name_city", $cityName)->find();
                    $cityId = $city[0]->id_city;
                }

                $newUser = new User();
                $newUser->fill([
                    'lastname_user' => $lastname,
                    'firstname_user' => $firstname,
                    'username_user' => $username,
                    'email_user' => $email,
                    'password_user' => $password,
                    'address1_user' => $address1,
                    'address2_user' => $address2,
                    'postcode_user' => $postcode,
                    'fk_id_city' => $cityId
                ]);

                $userModel = new UserModel();
                $userModel->insert($newUser);

                $data["success"]= true;
                $data["city"]=$cityName;
                $data["user"]=$newUser;
            }
        }

        header('Content-Type: application/json');
        echo json_encode($data);
        die;
    }
    
}
