<?php

class Util
{
    //https://stackoverflow.com/questions/19271381/correctly-determine-if-date-string-is-a-valid-date-in-that-format
    public function validate_date($date)
    {
        $dt = DateTime::createFromFormat("Y-m-d", $date);
        return $dt !== false && !array_sum($dt->getLastErrors());
    }

    public function validate_all_alpha($test_case) 
    {
        return ctype_alpha($test_case);
    }

    public function validate_email($email) 
    {
        return !!filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public function validate_phone_num($phone_num)
    {
        return preg_match('/^[0-9]{10}+$/', $phone_num);
    } 

    public function validate_address($address) {
        return preg_match("^[-a-z0-9 ,#'\/.]{3,50}$^", $address);
    }
    
    public function validate_zip_code($zip_code) 
    {
        if(strlen($zip_code)==5 && ctype_digit($zip_code)) {
            return true;
        } 
        return false;
    }

    public function validate_zip_code_ext($zip_code_ext) 
    {
        if(strlen($zip_code_ext)==4 && ctype_digit($zip_code_ext)) {
            return true;
        } 
        return false;
    }

    public function validate_all_numbers($test_case)
    {
        return ctype_digit($test_case);
    }

    public function validate_user_fields($user_info, $response) 
    {
        $form_exceptions = ["apartment", "zipcode-ext"];

        foreach($user_info as $key => $value) 
        {
            if(empty($value) && !in_array($key, $form_exceptions)) 
            {
                $response["invalid"] = true;
                $response["message"] = "All required fields must be filled in.";
            }
        }

        if($response['invalid']) 
        {
            return $response;
        }

        if(!$this->validate_all_alpha($user_info['fname'])) 
        {
            $response['invalid'] = true;
            $response['message'] = 'First name must be all letters.';
            return $response;
        }

        if(!$this->validate_all_alpha($user_info['lname'])) 
        {
            $response['invalid'] = true;
            $response['message'] = 'Last name must be all letters.';
            return $response;
        }

        if(!$this->validate_date($user_info['birthdate']))
        {
            $response['invalid'] = true;
            $response['message'] = 'Invalid birthdate';
            return $response;
        }

        if(!$this->validate_phone_num($user_info['phone'])) {
            $response['invalid'] = true;
            $response['message'] = 'Invalid phone number';
            return $response;
        }

        if(!$this->validate_address($user_info['address'])) {
            $response['invalid'] = true;
            $response['message'] = 'Invalid address';
            return $response;
        }

        if(!empty($user_info['apartment'])) {
            if(!$this->validate_all_numbers($user_info['apartment'])) {
                $response['invalid'] = true;
                $response['message'] = 'Apartment must be all numbers';
                return $response;
            }
        }

        if(!$this->validate_all_alpha($user_info['city'])) 
        {
            $response['invalid'] = true;
            $response['message'] = 'City must be all letters.';
            return $response;
        }

        if(!$this->validate_zip_code($user_info['zipcode'])) 
        {
            $response['invalid'] = true;
            $response['message'] = 'Invalid zip code';
            return $response;
        }

        if(!empty($user_info['zipcode-ext'])) {
            if(!$this->validate_zip_code_ext($user_info['zipcode-ext'])) 
            {
                $response['invalid'] = true;
                $response['message'] = 'Invalid zip code extension';
                return $response;
            }
        }

        if(!$this->validate_email($user_info['email'])) {
            $response['invalid'] = true;
            $response['message'] = 'Invalid email';
            return $response;
        }
    }

    //https://stackoverflow.com/a/6101969
    public function randomPassword() {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function passwordResetEmailTemplate($new_password) {
        return "<!DOCTYPE html>
        <html>
        <body style='margin: 0; background: #f5f5f5; font-family: arial, sans-serif; font-size: 16px; line-height: 24px;'>
            <table width='75%' border='0' cellspacing='0' cellpadding='0' align='center' style='border-collapse: collapse; margin: 0 auto;'>
                <tbody>
                    <tr style='margin-bottom: 20px; margin-top: 20px; display: block; width: 100%;'>
                        <td>
                            <h2><a href='https://www.patienthealthrecord.net' style='text-decoration: none; color: #F25652 !important;' target='_blank'>Patient Health Record</a></h2>
                        </td>
                    </tr>
                    <tr style='background: #fff; border: 2px solid #EBEBEB; border-radius: 2px; display: block; margin-bottom: 25px;'>
                        <td colspan='100%' style='padding: 20px;'>
                            <p style='margin-top: 0px;'>Hey there,<p>
                            <p style='margin-bottom: 20px; margin-top: 20px;'>Your new password is: <strong>". $new_password ."</strong></p>
                            <a href='https://www.patienthealthrecord.net/?path=login' style='background: #F25652; color: #fff; border-radius: 2px;
                                            padding: 10px; text-decoration: none; margin-top: 20px;
                                            margin-bottom: 20px; display: block; width: 135px' target='_blank'>
                                            Change Password
                            </a>
                            <p style='margin-bottom: 20px;'>If you didn't make this request then you should change your password immediately.</p>
                            <hr style='width: 25%; margin: 0; border-style: solid; border-color: #ebebeb'>
                            <p style='margin-top: 20px;'>The Patient Health Record Team</p>
                        </td>
                    </tr>
                    <tr style='display: block; margin-bottom: 25px;'>
                        <td>
                            <small style='font-size: 10px; color: #979797; line-height: 13px; display: block; text-align: center;'>
                                (c) 2018 Patient Health Record. All rights reserved. This email was sent
                                by Team Patient Health Record for our Sacred Heart CS670 Project.
                            </small>
                        </td>
                    </tr>
                </tbody>
            </table>
        </body>
        </html>";
    }

}


?>