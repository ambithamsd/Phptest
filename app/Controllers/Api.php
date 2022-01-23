<?php 

namespace App\Controllers;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ApiModel;
use App\Models\TokenModel;
use CodeIgniter\I18n\Time;


class Api extends ResourceController
{

    use ResponseTrait;

    //  get all data 
    public function index(){
               $apiModel = new ApiModel();
        $data = $apiModel->orderBy('id', 'DESC')->findAll();
        return $this->respond($data);
    }

    // create
    public function create() {
        $rules = [
			"firstName" => "required",
			"lastName" => "required",
			"email" => "required|valid_email|is_unique[user.email]|min_length[6]",
			"password" => "required"
		];

		$messages = [
			"firstName" => [
				"required" => "First Name is required"
            ],
            "lastName" => [
				"required" => "Last Name is required"
			],
			"email" => [
				"required" => "Email required",
				"valid_email" => "Email address is not in format",
				"is_unique" => "Email address already exists"
			],
			"password" => [
				"required" => "Password is required"
			]
		];

		if (!$this->validate($rules, $messages)) {

			$response = [
				'status' => 500,
				'error' => true,
				'message' => $this->validator->getErrors(),
				'data' => []
			];
		} else {


        $apiModel = new ApiModel();
        $data = [
            'firstName' => $this->request->getVar('firstName'),
            'lastName'  => $this->request->getVar('lastName'),
            'email'     => $this->request->getVar('email'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ];
        $apiModel->insert($data);
        $response = [
          'status'   => 200,
          'error'    => null,
          'messages' => [
              'success' => 'User created'
          ]
      ];
    }
      return $this->respondCreated($response);
    }
    public function login(){
        $rules = [
            "email"    => "required|valid_email|min_length[6]",
            "password" => "required",
        ];

        $messages = [
            "email" => [
                "required"    => "Email required",
                "valid_email" => "Email address is not in format"
            ],
            "password" => [
                "required" => "password is required"
            ],
        ];

        if (!$this->validate($rules, $messages)) {

            $response = [
                'status'  => 500,
                'error'   => true,
                'message' => $this->validator->getErrors(),
                'data'    => []
            ];

            return $this->respondCreated($response);
            
        } else {
            $apiModel = new ApiModel();

            $userdata = $apiModel->where("email", $this->request->getVar("email"))->first();
          

            if (!empty($userdata)) {
                if (password_verify($this->request->getVar("password"), $userdata['password'])) {

                    $token                       = bin2hex(openssl_random_pseudo_bytes(20) . microtime());
                    $token_objects               = array();
                    $token_objects['lt_token']   = $token;
                    $token_objects['lt_user_id'] = $userdata['id'];
                    $date                        = new Time('+1 day');
                    $token_objects['lt_expiry']  = $date->format('Y-m-d H:i:s');
                    $tokenModel = new TokenModel();
                   
                    $tokendata = $tokenModel->where("lt_user_id", $userdata['id'])->first();
                    if(!empty($tokendata)){
                        $tokenModel->update($tokendata['id'], $token_objects); 
                    }else{
                        $tokenModel->insert($token_objects); 
                    }

                    $response = [
                        'status'   => 200,
                        'error'    => false,
                        'messages' => 'User logged In successfully',
                        'data'     => [
                                 'token' => $token
                                ]
                    ];
                    return $this->respondCreated($response);
                } else {

                    $response = [
                        'status'   => 500,
                        'error'    => true,
                        'messages' => 'Incorrect details',
                        'data'     => []
                    ];
                    return $this->respondCreated($response);
                }
            } else {
                $response = [
                    'status'   => 500,
                    'error'    => true,
                    'messages' => 'User not found',
                    'data'     => []
                ];
                return $this->respondCreated($response);
            }
        }
    
    }

}

