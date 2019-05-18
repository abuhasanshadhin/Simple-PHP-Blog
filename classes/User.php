<?php

class User
{
    public function userLogin($data)
    {
        $email = mysqli_real_escape_string(DB::con(), $data['email']);
        $password = mysqli_real_escape_string(DB::con(), $data['password']);

        if (empty($email) || empty($password)){
            echo "<script>alert('Email and Password are required !')</script>";
        }else{
            $encryptPassword = $password;
            $checkResult = DB::loginCheck('users', [
                'user_email' => $email,
                'user_password' => $encryptPassword
            ]);
            if ($checkResult){
                Session::set('user_login', true);
                Session::set('user_id', $checkResult['id']);
                Session::set('user_name', $checkResult['user_name']);
                echo "<script>window.location = 'home'</script>";
            }else{
                echo "<script>alert('Email or Password was Invalid !');</script>";
            }
        }
    }

    public function userRegister($data)
    {
        $user_name = mysqli_real_escape_string(DB::con(), $data['user_name']);
        $user_email = mysqli_real_escape_string(DB::con(), $data['user_email']);
        $user_password = mysqli_real_escape_string(DB::con(), $data['user_password']);
        $retype_password = mysqli_real_escape_string(DB::con(), $data['retype_password']);

        if (empty($user_name)||empty($user_email)||empty($user_password)||empty($retype_password)){
            echo "<script>alert('Field must not be empty !')</script>";
        }else{
            $email_check = DB::getSingleData('users', 'user_email', $user_email);
            if ($email_check){
                echo "<script>alert('Email already exist! Please try another email.')</script>";
            }else{
                if ($user_password == $retype_password){
                    Session::set('usernameRegister', $user_name);
                    Session::set('emailRegister', $user_email);
                    Session::set('passwordRegister', $retype_password);
                    $verification_code = rand(10, 1000).rand(200, 400);
                    $message = "Dear <strong>".$user_name."</strong>,<br><br> Your verification code : ".$verification_code." <br><br>If you are having any issues with your account, please don't hesitate to contact us. Please send your message in this email - info@friendzonebd.cf <br><br>  Thanks, <br> The Friend Zone BD";
                    mail($user_email,'Email verify for registration', $message);
                    Session::set('verificationCode', $verification_code);
                    echo "<script>window.location = 'verification'</script>";
                }else{
                    echo "<script>alert('Password not matched!')</script>";
                }
            }
        }
    }

    public function emailVerify($data)
    {
        $verify_code = mysqli_real_escape_string(DB::con(), $data['verify_code']);
        if ($verify_code == Session::get('verificationCode')){
            $insert = DB::insertData('users', [
                'user_name' => Session::get('usernameRegister'),
                'user_email' => Session::get('emailRegister'),
                'user_password' => Session::get('passwordRegister')
            ]);


            if ($insert){
                echo "<script>alert('Congratulations! You are successfully registered.')</script>";
                
                unset($_SESSION['usernameRegister']);
                unset($_SESSION['emailRegister']);
                unset($_SESSION['passwordRegister']);
                unset($_SESSION['verificationCode']);
                
                echo "<script>window.location = 'home'</script>";
            }
        }
    }


}