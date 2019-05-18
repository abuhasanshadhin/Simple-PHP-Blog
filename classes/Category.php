<?php

class Category
{
    public function addCategory($data)
    {
        $categoryName = mysqli_real_escape_string(DB::con(), $data['categoryName']);

        if (empty($categoryName)){
            return 'Category name required !';
        }else{
            $insert = DB::insertData('categories', [
                'category_name' => $categoryName,
                'category_status' => 0
            ]);

            if ($insert){
                return 'Category added successfully.';
            }else{
                return 'Something went wrong! Category not added.';
            }
        }
    }

    public function updateCategory($data)
    {
        $categoryName = mysqli_real_escape_string(DB::con(), $data['categoryName']);
        $categoryId = $data['categoryId'];

        if (empty($categoryName)){
            return 'Category name required !';
        }else{
            $update = DB::updateData('categories', ['category_name'=>$categoryName], 'category_id', $categoryId);

            if ($update){
                return 'Category updated successfully.';
            }else{
                return 'Something went wrong! Category not update.';
            }
        }
    }

    public function getCategoryDetails($id)
    {
        $cid = mysqli_real_escape_string(DB::con(), $id);
        $category = DB::getSingleData('categories', 'category_id', $cid);
        return $category;
    }

    public function getCategories()
    {
        $categories = DB::getDataOrderBy('categories', 'category_id', 'DESC');
        return $categories;
    }

    public function getPublishedCategory()
    {
        $categories = DB::getAllDataByCondition('categories', 'category_status', 0);
        return $categories;
    }

    public function deleteCategory($id)
    {
        $cdid = mysqli_real_escape_string(DB::con(), $id);
        $delete = DB::deleteData('categories', 'category_id', $cdid);
        if ($delete){
            return 'Category removed successfully.';
        }else{
            return 'Something went wrong! Category not Removed.';
        }
    }

    public function unpublishCategory($id)
    {
        $cuid = mysqli_real_escape_string(DB::con(), $id);

        $update = DB::updateData('categories', ['category_status'=>1], 'category_id', $cuid);

        if ($update){
            return 'Category unpublished.';
        }else{
            return 'Something went wrong! Category not unpublished.';
        }
    }

    public function publishCategory($id)
    {
        $cpid = mysqli_real_escape_string(DB::con(), $id);

        $update = DB::updateData('categories', ['category_status'=>0], 'category_id', $cpid);

        if ($update){
            return 'Category published.';
        }else{
            return 'Something went wrong! Category not published.';
        }
    }

}