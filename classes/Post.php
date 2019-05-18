<?php

class Post
{
    public function addPost($data, $file)
    {
        $title = mysqli_real_escape_string(DB::con(), $data['post_title']);
        $post_description = mysqli_real_escape_string(DB::con(), $data['post_description']);
        $post_status = mysqli_real_escape_string(DB::con(), $data['post_status']);
        $post_author = mysqli_real_escape_string(DB::con(), $data['post_author']);
        $post_author_id = mysqli_real_escape_string(DB::con(), $data['post_author_id']);
        $post_category = mysqli_real_escape_string(DB::con(), $data['post_category']);

        $file_name = $file['post_image']['name'];
        $file_tmp = $file['post_image']['tmp_name'];

        $divide_extention = explode('.', $file_name);
        $file_extention = strtolower(end($divide_extention));
        $unique_name = substr(md5(time()), 0, 3) . "." . $file_extention;
        $uploaded_image = "images/" . $divide_extention[0] . "_" . $unique_name;

        if (empty($title) || empty($post_description) || empty($post_author) || empty($post_category)) {
            return "Field must not be empty!";
        } else {
            move_uploaded_file($file_tmp, "../" . $uploaded_image);

            if ($file_name == null){
                $insert = DB::insertData('posts', [
                    'post_title' => $title,
                    'post_category' => $post_category,
                    'post_description' => $post_description,
                    'post_status' => $post_status,
                    'post_author' => $post_author,
                    'post_author_id' => $post_author_id
                ]);

                if ($insert){
                    return 'Post added successfully.';
                }else{
                    return 'Something went wrong! Category not added.';
                }
            }else{
                $insert = DB::insertData('posts', [
                    'post_title' => $title,
                    'post_category' => $post_category,
                    'post_description' => $post_description,
                    'post_image' => $uploaded_image,
                    'post_status' => $post_status,
                    'post_author' => $post_author,
                    'post_author_id' => $post_author_id
                ]);

                if ($insert){
                    return 'Post added successfully.';
                }else{
                    return 'Something went wrong! Category not added.';
                }
            }
        }
    }

    public function getPosts()
    {
        $author_id = Session::get('id');
        $query = "SELECT posts.*, categories.category_name 
                  FROM posts 
                  INNER JOIN categories 
                  ON posts.post_category = categories.category_id
                  WHERE posts.post_author_id = '$author_id' AND post_status=0
                  ORDER BY posts.id DESC";
        $posts = DB::con()->query($query);
        return $posts;
    }

    public function deletePost($id)
    {
        $pdid = mysqli_real_escape_string(DB::con(), $id);

        $post = DB::getSingleData('posts', 'id', $pdid);
        $img_unlink = "../" . $post['post_image'];
        unlink($img_unlink);

        DB::deleteData('comments', 'post_id', $id);
        DB::deleteData('likes', 'post_id', $id);
        DB::deleteData('comment_reply', 'post_id', $id);

        $delete = DB::deleteData('posts', 'id', $pdid);
        if ($delete){
            return 'Post removed successfully.';
        }else{
            return 'Something went wrong! Post not Removed.';
        }
    }


    public function unpublishPost($id)
    {
        $puid = mysqli_real_escape_string(DB::con(), $id);

        $update = DB::updateData('posts', ['post_status'=>1], 'id', $puid);

        if ($update){
            return 'Post unpublished.';
        }else{
            return 'Something went wrong! Post not unpublished.';
        }
    }

    public function publishPost($id)
    {
        $ppid = mysqli_real_escape_string(DB::con(), $id);

        $update = DB::updateData('posts', ['post_status'=>0], 'id', $ppid);

        if ($update){
            return 'Post published.';
        }else{
            return 'Something went wrong! Post not published.';
        }
    }

    public function getPost($id)
    {
        $peid = mysqli_real_escape_string(DB::con(), $id);
        $post = DB::getSingleData('posts', 'id', $peid);
        return $post;
    }

    public function postPopularIncrese($id)
    {
        $result = $this->getPost($id);
        $increse = $result['post_popular'] + 1;
        DB::updateData('posts', ['post_popular'=>$increse], 'id', $id);
    }

    public function getPopularPost()
    {
        $posts = DB::myQuery("SELECT * FROM posts WHERE post_status = 0 ORDER BY post_popular DESC LIMIT 5");
        return $posts;
    }

    public function updatePost($data, $file)
    {
        $post_id = mysqli_real_escape_string(DB::con(), $data['post_id']);
        $title = mysqli_real_escape_string(DB::con(), $data['post_title']);
        $post_description = mysqli_real_escape_string(DB::con(), $data['post_description']);
        $post_status = mysqli_real_escape_string(DB::con(), $data['post_status']);
        $post_category = mysqli_real_escape_string(DB::con(), $data['post_category']);


        $file_name = $file['post_image']['name'];
        $file_tmp = $file['post_image']['tmp_name'];

        $divide_extention = explode('.', $file_name);
        $file_extention = strtolower(end($divide_extention));
        $unique_name = substr(md5(time()), 0, 3) . "." . $file_extention;
        $uploaded_image = "images/" . $divide_extention[0] . "_" . $unique_name;

        if (!empty($file_name)) {
            $post = DB::getSingleData('posts', 'id', $post_id);
            $img_unlink = "../" . $post['post_image'];
            unlink($img_unlink);

            move_uploaded_file($file_tmp, "../" . $uploaded_image);
            $update = DB::updateData('posts', [
                'post_title' => $title,
                'post_category' => $post_category,
                'post_description' => $post_description,
                'post_image' => $uploaded_image,
                'post_status' => $post_status
            ], 'id', $post_id);

            if ($update) {
                return "Post updated successfully.";
            } else {
                return "Something went wrong! Product not updated.";
            }

        } else {

            $update = DB::updateData('posts', [
                'post_title' => $title,
                'post_category' => $post_category,
                'post_description' => $post_description,
                'post_status' => $post_status,
            ], 'id', $post_id);

            if ($update) {
                return "Post updated successfully.";
            } else {
                return "Something went wrong! Product not updated.";
            }
        }
    }

    public function getPublishedPosts($start, $per_page)
    {
        $posts = DB::myQuery("SELECT * FROM posts WHERE post_status = 0 LIMIT {$start}, {$per_page}");
        return $posts;
    }

    public function getPublishedPostsByCategory($start, $per_page, $category_id)
    {
        $posts = DB::myQuery("SELECT * FROM posts WHERE post_status = 0 AND post_category = '$category_id' LIMIT {$start}, {$per_page}");
        return $posts;
    }

    public function postCountForPagination($per_page)
    {
        $data = DB::myQuery("SELECT * FROM posts WHERE post_status = 0");
        $rows = $data->num_rows;
        $total_pages = ceil($rows / $per_page);
        return $total_pages;
    }

    public function like($id)
    {
        $userId = Session::get('user_id');
        $query = "SELECT * FROM likes WHERE post_id = '$id' AND user_id = '$userId'";
        $check = DB::con()->query($query)->fetch_assoc();
        if (($check['user_id'] != $userId) and (Session::get('user_login')==true)){
            DB::insertData('likes', ['post_id'=>$id, 'user_id'=> Session::get('user_id')]);
        }
        echo "<script>window.location = 'blog-details?pid={$id}'</script>";
    }

    public function totalLikes($id)
    {
        $likes = DB::getAllDataByCondition('likes', 'post_id', $id);
        $totalLikes = $likes->num_rows;
        return $totalLikes;
    }

    public function comment($comment, $post_id)
    {
        $comment = mysqli_real_escape_string(DB::con(), $comment);
        DB::insertData('comments', [
            'post_id' => $post_id,
            'commenter_name' => Session::get('user_name'),
            'comment' => $comment
        ]);
        echo "<script>window.location = 'blog-details?pid={$post_id}'</script>";
    }

    public function getComments($post_id)
    {
        $comments = DB::getAllDataByCondition('comments', 'post_id', $post_id, 'ORDER BY id DESC');
        return $comments;
    }

    public function comment_reply($data, $post_id)
    {
        DB::insertData('comment_reply', [
            'post_id' => $post_id,
            'comment_id' => $data['comment_id'],
            'replier_name' => Session::get('user_name'),
            'reply' => $data['reply']
        ]);
        echo "<script>window.location = 'blog-details?pid={$post_id}'</script>";
    }

    public function getReply($comment_id)
    {
        $reply = DB::getAllDataByCondition('comment_reply', 'comment_id', $comment_id);
        return $reply;
    }

    public function getTotalCommentByPost($post_id)
    {
        $comments = DB::getAllDataByCondition('comments', 'post_id', $post_id);
        return $comments->num_rows;
    }




}