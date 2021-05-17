<?php
    class ValidateForm{
        private $data=[
            'firstName'=>'',
            'lastName'=>'',
            'fullName'=>'',
            'honorific'=> '',
            'emailAddress'=>'',
            'phoneNumber'=>'',
            'reservationDate'=>'',
            'reservationTime'=>'',
            'numberGuests'=>'',
            'message'=>''
        ];
        private $errors=[];

        public function valFirstName($firstName){
            if(!empty($firstName)){
                if(strlen($firstName)>3){
                    $this -> data['firstName']=$firstName;
                }else{
                    $this -> errors['firstName']='Voornaam moet 3 karakters of meer zijn';
                }
            }else{
                $this -> errors['firstName']='Voornaam kan niet leeg zijn';
            }
        }
        public function valLastName($lastName){
            if(!empty($lastName)){
                if(strlen($lastName)>3){
                    $this -> data['lastName']=$lastName;
                }else{
                    $this -> errors['lastName']='Achternaam moet 3 karakters of meer zijn';
                }
            }
        }
        public function valFullName($fullName){
            if(!empty($fullName)){
                if(strlen($fullName)>3){
                    $this -> data['fullName']=$fullName;
                }else{
                    $this -> errors['fullName']='Naam moet 4 karakters of meer zijn';
                }
            }else{
                $this -> errors['fullName']='Naam kan niet leeg zijn';
            }
        }
        public function valHonorific($honorific){
            if(!empty($honorific)){
                if($honorific == 'male' || $honorific == 'female'){
                    $this -> data['honorific']=$honorific;
                }else{
                    $this -> errors['honorific']='Titel is niet valide';
                }
            }
        }
        public function valEmailAddress($emailAddress){
            if(!empty($emailAddress)){
                if(filter_var($emailAddress, FILTER_VALIDATE_EMAIL)){
                    $this -> data['emailAddress']=$emailAddress;
                }else{
                    $this -> errors['emailAddrese']='Email Addres is niet valide';
                }
            }else{
                $this ->errors['emailAddress']='Email kan niet leeg zijn';
            }
        }
        public function valPhoneNumber($phoneNumber){
            if(!empty($phoneNumber)){
                $pattern='/^[0-9]{10}$/';
                $phoneNumber=str_replace(' ','',$phoneNumber);

                if(preg_match($pattern, $phoneNumber)){
                    $this -> data['phoneNumber']=$phoneNumber;
                }else{
                    $this -> errors['phoneNumber']='Telefoonnummer klopt niet';
                }
            }else{
                $this -> data['phoneNumber']=0;
            }
        }
        public function valReservationDate($reservationDate){
            if(!empty($reservationDate)){
                $pattern='/[0-9]{2,4}/';

                preg_match_all($pattern, $reservationDate, $dateNumbers);

                if(checkdate($dateNumbers[0][1], $dateNumbers[0][0], $dateNumbers[0][2])){
                    $this -> data['reservationDate']=$dateNumbers[0][2].$dateNumbers[0][1].$dateNumbers[0][0];
                }else{
                    $this-> errors['reservationDate']='Datum is niet valide';
                }
            }else{
                $this-> errors['reservationDate']='Datum kan niet leeg zijn';
            }
        }
        public function valReservationTime($reservationTime){
            if(!empty($reservationTime)){
                $pattern='/[0-9]{2}/';

                preg_match_all($pattern, $reservationTime, $timeNumbers);

                if(count($timeNumbers[0])==2){
                    if($timeNumbers[0][0]<21){
                        if($timeNumbers[0][1]==30 || $timeNumbers[0][1]==00){
                            $this -> data['reservationTime']=$reservationTime.':00';
                        }else{
                            $this -> errors['reservationTime']='Je kan dan niet reserveren';
                        }
                    }else{
                        $this -> errors['reservationTime']='Je kan dan niet reserveren';
                    }
                }else{
                    $this -> errors['reservationTime']='Je kan dan niet reserveren';
                }
            }else{
                $this-> errors['reservationTime']='De reserveringstijd kan niet leeg zijn';
            }
        }
        public function valNumberGuests($guests){
            if(!empty($guests)){
                if($guests > 0 && $guests <= 12){
                    $this -> data['numberGuests']=$guests;
                }else{
                    $this -> errors['numberGuests']='Er kan niet voor 12 mensen of meer gereserveerd worden op dit formulier';
                }
            }else{
                $this -> errors['numberGuests']='Het aantal gasten kan niet leeg zijn';
            }
        }
        public function valMessage($message){
            if(!empty($message)){
                $this -> data['message']=$message;
            }
        }
        public function showErrors(){
            return $this -> errors;
        }
        public function showData(){
            return $this -> data;
        }
    }
?>