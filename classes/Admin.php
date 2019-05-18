<?php

class Admin
{
    public function adminLogin($data)
    {
        $email = mysqli_real_escape_string(DB::con(), $data['admin_email']);
        $password = mysqli_real_escape_string(DB::con(), $data['admin_password']);

        if (empty($email) || empty($password)){
            echo "<script>alert('Email and Password are required !')</script>";
        }else{
            $encryptPassword = md5($password);
            $query = "SELECT * FROM admin_editors WHERE email = '$email' AND password = '$encryptPassword'";
            $checkResult = DB::con()->query($query)->fetch_assoc();
            if ($checkResult){
                Session::set('login', true);
                Session::set('id', $checkResult['id']);
                Session::set('type', $checkResult['type']);
                Session::set('name', $checkResult['name']);
                echo "<script>window.location = 'dashboard'</script>";
            }else{
                echo "<script>alert('Email or Password was Invalid !');</script>";
            }
        }
    }

    public function register($data)
    {
        $name = mysqli_real_escape_string(DB::con(), $data['name']);
        $email = mysqli_real_escape_string(DB::con(), $data['email']);
        $password = mysqli_real_escape_string(DB::con(), $data['password']);
        $type = mysqli_real_escape_string(DB::con(), $data['type']);
        $addedBy = mysqli_real_escape_string(DB::con(), Session::get('name'));

        if (empty($name) or empty($email) or empty($password) or empty($addedBy)){
            return "Fields are required !";
        }else{
            $register = DB::insertData('admin_editors', [
                'email' => $email,
                'type' => $type,
                'password' => md5($password),
                'name' => $name,
                'added_by' => $addedBy
            ]);

            if ($register){
                if ($type == 'admin'){
                    return "Congratulations! Successfully added new Admin.";
                }elseif ($type == 'editor'){
                    return "Congratulations! Successfully added new Editor.";
                }
            }else{
                if ($type == 'admin'){
                    return "Something went wrong! Admin not added.";
                }elseif ($type == 'editor'){
                    return "Something went wrong! Editor not added.";
                }
            }
        }
    }

    public function getProfileInfo($id)
    {
        $profile = DB::getSingleData('admin_editors', 'id', $id);
        return $profile;
    }

    public function updateProfile($data)
    {
        extract($data);
        $update = DB::updateData('admin_editors', [
            'email' => $email,
            'name' => $name
        ], 'id', $author_id);

        if ($update){
            return "Profile updated successfully.";
        }else{
            return "Something went wrong! Profile not updated.";
        }
    }

    public function getAuthors()
    {
        $authors = DB::getAllData('admin_editors');
        return $authors;
    }

    public function removeAuthor($id)
    {
        $raid = mysqli_real_escape_string(DB::con(), $id);
        $delete = DB::deleteData('admin_editors', 'id', $raid);
        if ($delete){
            return "Author removed successfully.";
        }else{
            return "Something went wrong! Author not deleted.";
        }
    }

    public function authorPosts($id)
    {
        $query = "SELECT * FROM posts WHERE post_author_id = '$id'";
        $authorPosts = DB::con()->query($query);
        return $authorPosts;
    }

    public function changePassword($data)
    {
         extract($data);
         if (empty($current_pass) || empty($password) || empty($re_password)){
             return "Password fields are required !";
         }else{
             $currentPassword = DB::getSingleData('admin_editors', 'id', Session::get('id'));
             if (md5($current_pass) == $currentPassword['password']){
                 if ($password == $re_password){
                     $update = DB::updateData('admin_editors', ['password' => md5($password)], 'id', Session::get('id'));
                     if ($update){
                         return "Password changed successfully.";
                     }else{
                         return "Something went wrong! Password not changed.";
                     }
                 }else{
                     return "Confirm password not matched !";
                 }
             }else{
                 return "Current password not matched !";
             }
         }
    }



}