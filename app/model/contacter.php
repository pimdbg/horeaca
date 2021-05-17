<?php
    require_once('../app/src/validate_form.php');
    require_once('../app/src/database.php');
    require_once('../app/src/itf_form.php');
    
    class Contacter implements Form{
        private $errors;
        private $data;
        private $messages;
        
        public function __construct(){
            if(isset($_POST['send'])){
                $this -> validate();
                if(empty($this -> errors)){
                    $this -> sendToDatabase();
                    $this -> deletePosts();
                    $this -> messages['success']='Contactform success';
                }else{
                    $this -> messages['errors']=$this -> errors;
                }
                $this -> prepMessages();
            }
        }
        public function validate(){
            $validate=new ValidateForm();
            $validate -> valFullName($_POST['fullName']);
            $validate -> valPhoneNumber($_POST['phoneNumber']);
            $validate -> valEmailAddress($_POST['email']);

            $this -> data=$validate -> showData();
            $this -> errors=$validate -> showErrors();
        }
        public function sendToDatabase(){
            $db=new Db();
            $db -> connect();
            $db -> prepareQuery("INSERT INTO horeaca_contact
            (name, phone_number, email, message)
            VALUES (:name, :phone_number, :email, :message)");
            $db -> bindParam(':name', $this -> data['fullName']);
            $db -> bindParam(':phone_number', $this -> data['phoneNumber']);
            $db -> bindParam(':email', $this -> data['emailAddress']);
            $db -> bindParam(':message', $this -> data['message']);
            $db -> executeQuery();
            $db -> terminate();
        }
        public function prepMessages(){
            foreach($this -> messages['errors'] as $errorKey => $errorValue){
                $this -> messages['errors'][$errorKey]='<span class="error">'.$errorValue.'</span><br>';  
            }   

            $this -> messages['success']='<div class="success">'.$this -> messages['success'].'</div>';
        }
        public function getMessages(){
            return $this -> messages;
        }
        public function deletePosts(){
            unset($_POST);
        }
    }
?>