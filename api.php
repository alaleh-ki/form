<?php 
include('config/db_connect.php');

    $errors='';
  //  isset($_POST['signUp'])
//checking if the post method is from sign up form or sign in
    if (array_key_exists('signUp',$_POST)){
        $post= json_decode($_POST['signUp'], true);
        //calling validator class
        $validation = new UserValidator($post);
        //calling the validator function and storing the result
        $errors = $validation->validateForm();
        }else{

            $post= json_decode($_POST['signIn'], true);
            $User = new UserSignIn($post);
            $errors = $User->signin();

        }





        //validater class:validates the given values and if there is not any errors saves to db
        class UserValidator{
            private $data;
            private $errors = [];
            private static $fields = ['form','name', 'email','password','secpassword'];
          
            public function __construct($post_data){
              $this->data = $post_data;
            }
          
            public function validateForm(){
                //checking if all the fiels are given to us
              foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)){
                  trigger_error("$field is not present in the data");
                  return;
                }
              }
                //calling the functions
                $this->validateName();
                $this->validateEmail();
                $this->validatePassword();
                
                //returning the errors
                if(!empty($this->errors)){
                print_r( json_encode($this->errors));
                }else{
                    //saving to the db if there isn't any errors
                $this->SaveToDb();
                }
        
            }
        


            //function for validating name
            private function validateName(){
                $val = trim($this->data['name']);
        
                if(empty($val)){
                    $this->addError('name','name cannot be empty!');
                }else{
                    if(!preg_match('/^[a-zA-Z0-9]{6,12}$/', $val)){
                        $this->addError('name','name must be 6-12 chars & alphanumeric');
                      }
                }
        
            }


              //function for validating email
        
             private function validateEmail(){
                 $val = trim($this->data['email']);
        
                 if(empty($val)){
                   $this->addError('email', 'email cannot be empty!');
                 } else {
                   if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                     $this->addError('email', 'email must be a valid email address');
                   }else{
                    //checking if the email already exist in the db
                    global $conn ;
                    $sql="select * from users where email='$val';";
                    $res=mysqli_query($conn,$sql);
                    if (mysqli_num_rows($res) > 0){
                        $this->addError('email', 'Email already exist!');
                    }
                   }
                 }
        
             }

             
               //function for validating password
             private function validatePassword(){
                if(!empty($this->data["password"]) && ($this->data["password"] == $this->data["secpassword"])) {
                    $password = trim($this->data["password"]);
                    $secpassword = trim($this->data["secpassword"]);
                    if (strlen($password) <= '8') {
                        $this->addError('password','Your Password Must Contain At Least 8 Characters!') ;
                    }
                    elseif(!preg_match("#[0-9]+#",$password)) {
                        $this->addError('password','Your Password Must Contain At Least 1 Number!');
                    }
                    elseif(!preg_match("#[A-Z]+#",$password)) {
                        $this->addError('password','Your Password Must Contain At Least 1 Capital Letter!');
                    }
                    elseif(!preg_match("#[a-z]+#",$password)) {
                        $this->addError('password','Your Password Must Contain At Least 1 Lowercase Letter!');
                    }
                }
                elseif(!empty($this->data["password"])) {
                    $this->addError("secpassword","Please Check You've Entered Or Confirmed Your Password!");
                } else {
                     $this->addError('password','Please enter password ') ;
                }
             }



            
            //function for errors
            private function addError($key,$val){
               $this->errors[$key]=$val;
            }




            //function for saving to db

            private function SaveToDb(){     
            echo 1;

            global $conn ;

            // protecting database from codes
            $name = mysqli_real_escape_string($conn, $this->data['name']);
            $email = mysqli_real_escape_string($conn, $this->data['email']);
            $password= mysqli_real_escape_string($conn, $this->data['password']);
            $hashed = password_hash($password, PASSWORD_DEFAULT);


            // creat sql
            $sql = "INSERT INTO 
            users(name,email,password)
            VALUES ('$name','$email','$hashed')";
    
            // save to db
           if(mysqli_query($conn,$sql)){
            //successful
           }else{
            //returning error
             echo 'query error'.mysqli_error($conn);
           }
          }

         }
        
        
  




         class UserSignIn{
            private $data;
            private $errors = [];
            private static $fields = ['form','email','password'];
          
            public function __construct($post_data){
              $this->data = $post_data;
            }

            public function signin(){

               //checking if all the fiels are given to us
              foreach(self::$fields as $field){
                if(!array_key_exists($field, $this->data)){
                  trigger_error("$field is not present in the data");
                  return;
                }
              }


              $this->Checking();
              print_r( json_encode($this->errors));



            }
              
            private function Checking(){
                global $conn ;
                $email = mysqli_real_escape_string($conn, $this->data['email']);
              $password =$this->data['password'];
              if(!empty($email) && !empty($password)){
              global $conn ;
              $sql="select * from users where email='$email';";
              $res=mysqli_query($conn,$sql);
              $user = mysqli_fetch_assoc($res);
              if (!empty($user) && password_verify($password, $user['password'])){
                echo'1';
              }else if(empty($user)){
                //the email doeasnt exist
                $this->addError('email','the email doeasnt exist') ;
              }else if(!empty($user) &&  !password_verify($password, $user['password'])){
                //the password is incorrect
                $this->addError('password','the password is incorrect') ;
              }

            }else if(empty($email)){
             $this->addError('email', 'email cannot be empty!');
             if(empty($password)){
              $this->addError('password','Please enter password ') ;
             }
            }else{
                $this->addError('password','Please enter password ') ;
            }
        }

            

             //function for errors
            private function addError($key,$val){
                $this->errors[$key]=$val;
            }

         }







