<?php

class Util
{
    //https://stackoverflow.com/questions/19271381/correctly-determine-if-date-string-is-a-valid-date-in-that-format
    public function validate_date($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }

    public function fetchAll($sql, $params)
    {

    }

    public function fetch($sql, $params)
    {

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