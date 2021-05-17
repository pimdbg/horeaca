<?php
    require_once('../app/src/validate_form.php');
    require_once('../app/src/database.php');
    require_once('../app/src/itf_form.php');

    class Reserver implements Form{
        private $data;
        private $messages;
        private $errors;
        
        public function __construct(){
            if(isset($_POST['send'])){
                $this -> validate();

                if(empty($this -> errors)){
                    $this -> sendToDatabase();
                    $this -> deletePosts();
                    $this -> messages['success']='Reservation Success';
                }else{
                    $this -> messages['errors']=$this -> errors;
                }
                $this -> prepMessages();
            }      
        }
        public function validate(){
            $validation=new ValidateForm();
            $validation -> valHonorific($_POST['honorific']);
            $validation -> valFirstName($_POST['firstName']);
            $validation -> valLastName($_POST['lastName']);
            $validation -> valEmailAddress($_POST['email']);
            $validation -> valReservationDate($_POST['date']);
            $validation -> valReservationTime($_POST['reservationTime']);
            $validation -> valNumberGuests($_POST['numberGuests']);
            $validation -> valMessage($_POST['message']);

            $this -> data=$validation -> showData();
            $this -> errors=$validation -> showErrors();
        }
        public function sendToDatabase(){
            $data=$this -> data;

            $db=new Db();
            $db -> connect();
            $db -> prepareQuery("INSERT INTO horeaca_reservations
            (first_name, last_name, honorific, email, reservation_date, reservation_time, number_of_guests, message)
            VALUES (:firstName, :lastName, :honorific, :email, :reservationDate, :reservationTime, :numberOfGuests, :message)");
            $db -> bindParam(':firstName', $data['firstName']);
            $db -> bindParam(':lastName', $data['lastName']);
            $db -> bindParam(':honorific', $data['honorific']);
            $db -> bindParam(':email', $data['emailAddress']);
            $db -> bindParam(':reservationDate', $data['reservationDate']);
            $db -> bindParam(':reservationTime', $data['reservationTime']);
            $db -> bindParam(':numberOfGuests', $data['numberGuests']);
            $db -> bindParam(':message', $data['message']);
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