<?php
    interface Form{
        public function validate();
        public function sendToDataBase();
        public function prepMessages();
    }
?>