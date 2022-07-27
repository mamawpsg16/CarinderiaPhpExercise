<?php
    class ValidatePizza{
        private $data;
        private $errors =[];
        private static $fields = ['email','title','ingredients'];

        public function __construct($post_data){
            $this->data = $post_data;
        }

        public function validateForm(){
            // print_r($this->data);
            foreach (self::$fields as $field) {
                if(!array_key_exists($field,$this->data)){
                    trigger_error("$field is not a present data");
                    return;
                }
            }
            $this->validateEmail();
            $this->validateTitle();
            $this->validateIngredients();

            return $this->errors;
        }

        private function validateEmail(){
            $val = trim($this->data['email']);
            if(empty($val)){
                $this->addError('email','email is required!');
            }else{
                if(!filter_var($val, FILTER_VALIDATE_EMAIL)){
                    $this->addError('email','email must be in correct format!');
                }
            }
        }
        

        private function validateTitle(){
            $val = trim($this->data['title']);
            if(empty($val)){
                $this->addError('title','title is required!');
            }else{
                if(strlen($val) < 5 || strlen($val) > 20){
                    $this->addError('title','title must be 5 - 12 characters only!');
                }
            }
        }

        private function validateIngredients(){
            $val = trim($this->data['ingredients']);
            if(empty($val)){
                $this->addError('ingredients','ingredients is required!');
            }
            // else{
            //     if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z-\s]*)*$/',$this->data['ingredients'])){
            //         $this->addError('ingredients','ingredients must be a comma separated list!');
            //     }
            // }
        }

        private function addError($key,$value){
            $this->errors[$key]=$value;
        }
        
    }
?>
