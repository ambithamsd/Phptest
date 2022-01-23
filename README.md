# restfulApi
This restful api is developed in Codeigniter 4 framework is used. This version is need Php 7.2 or newer. 

Code Running instruction for Ubuntu 

1. DataBase connection 

    app/Config/Database.php 
    
    Change the username and password and DB name

    db structure  file is included 


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

