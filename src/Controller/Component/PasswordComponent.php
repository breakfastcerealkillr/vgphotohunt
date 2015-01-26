<?php

namespace App\Controller\Component;

use Cake\Controller\Component;

class PasswordComponent extends Component {
    
    public function validate($pass1 = null, $pass2 = null) {
        
        if (strlen($pass1) < 8) {
            $result = "Password not long enough. Password must be at least 8 characters";
        } elseif ($pass1 != $pass2) {
            $result = "Passwords do not match";
        } else {
            $result = "OK";
        }
        
        return $result;
        
    }
    
}