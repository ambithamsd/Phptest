This restful api is developed in Codeigniter 4 framework is used. This version is need Php 7.2 or newer. 

1. DataBase connection 

    app/Config/Database.php 
    
    Change the username and password and DB name

    DB have two tables

    1. User table 

        CREATE TABLE IF NOT EXISTS `user` (
        `id` int(11) NOT NULL,
        `firstName` varchar(100) NOT NULL,
        `lastName` varchar(100) NOT NULL,
        `email` varchar(100) NOT NULL,
        `password` varchar(100) NOT NULL,
        `status` int(1) NOT NULL DEFAULT '0'
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

    2. Token table

        CREATE TABLE IF NOT EXISTS `login_token` (
        `id` int(11) NOT NULL,
        `lt_token` text NOT NULL,
        `lt_user_id` int(11) NOT NULL,
        `lt_expiry` varchar(50) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;




Instuctions

1. Download the code form git using commad
   
   git clone https://github.com/ambithamsd/restfulAPI.git

2. Goto the project folder open terminal and run 

    php spark serve

3. Open POSTMAN is used to test api

 1. Authorization 
    
    1.Change type No auth to Basic Auth
    2.Username :adminuser and password :admin123

2. Header

    Add "Accept":"application/json" and "Content-Type":"application/json"
 

1. Login use 
    
    url : http://localhost:8080/api/login 
    
    In Body JSON data format

    {
	"email":"abc@gmail.com",
	"password":"123456ab"
   }
  
2. Register User

    url : http://localhost:8080/api/create

    JSON Data format


    {
        "firstName":"Abc",
        "lastName":"abc",
        "email":"abc@gmail.com",
        "password":"123456"
        
    }

