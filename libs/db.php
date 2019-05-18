<?php

class DB
{
    protected static $database = 'id7377120_db_blog';
    protected static $user = 'id7377120_shadhin';
    protected static $password = 'shadhin98';

    /**
     * @return mysqli
     */
    public static function con()
    {
        try {
            $mysqli = new mysqli('localhost', self::$user, self::$password, self::$database);
            $mysqli->set_charset("utf8");
            return $mysqli;
        } catch (Exception $e) {
            die('Server Not Connected ! ' . $e);
        }
    }


    /**
     * @param $table
     * @param array $cols
     * @return bool|mysqli_result
     */
    public static function loginCheck($table, $cols = [])
    {
        $col_val = '';

        foreach ($cols as $key => $item) {
            $col_val .= $key . '=' . "'$item'" . ' AND ';
        }

        $col_val = chop($col_val, " AND ");

        $query = "SELECT * FROM $table WHERE $col_val";
        $result = self::con()->query($query)->fetch_assoc();
        return $result;
    }

    /**
     * @param $table
     * @return bool|mysqli_result
     */
    public static function getAllData($table)
    {
        $query = "SELECT * FROM {$table}";
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $table
     * @param $col_name
     * @param $val
     * @param null $order
     * @return bool|mysqli_result
     */
    public static function getAllDataByCondition($table, $col_name, $val, $order = null)
    {
        $query = "SELECT * FROM {$table} WHERE {$col_name} = '$val' {$order}";
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $table
     * @param $col_name
     * @param $val
     * @param $limit
     * @return bool|mysqli_result
     */
    public static function getAllDataByConditionWithLimit($table, $col_name, $val, $limit)
    {
        $query = "SELECT * FROM {$table} WHERE {$col_name} = '$val' LIMIT {$limit}";
        $result = self::con()->query($query);
        return $result;
    }

    public static function myQuery($query)
    {
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $table
     * @param $order_col
     * @param string $order
     * @return bool|mysqli_result
     */
    public static function getDataOrderBy($table, $order_col, $order = 'ASC')
    {
        $query = "SELECT * FROM {$table} ORDER BY {$order_col} {$order}";
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $table
     * @param $column_name
     * @param $id
     * @return array
     */
    public static function getSingleData($table, $column_name, $id)
    {
        $query = "SELECT * FROM " . $table . " WHERE " . $column_name . " = '$id'";
        $result = self::con()->query($query)->fetch_assoc();
        return $result;
    }

    /**
     * @param $table
     * @param array $dataArray
     * @return bool|mysqli_result
     */
    public static function insertData($table, $dataArray=[])
    {
        $column_add = '';
        $value_add  = '';

        foreach ($dataArray as $key => $val) {
            $column_add .= $key.",";
            $value_add  .= "'{$val}',";
        }

        $column_name = rtrim($column_add, ",");
        $values      = rtrim($value_add, ",");

        $query  = "INSERT INTO ".$table."(".$column_name.") VALUES (".$values.")";
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $table
     * @param array $dataArray
     * @param $where_column
     * @param $where_id
     * @return bool|mysqli_result
     */
    public static function updateData($table, $dataArray=[], $where_column, $where_id)
    {
        $value_add = "";

        foreach ($dataArray as $k => $v) {
            $value_add .= " {$k} = '{$v}',";
        }

        $values = rtrim($value_add, ',');

        $query = "UPDATE {$table} SET {$values} WHERE {$where_column} = '{$where_id}'";
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $table
     * @param $where_column
     * @param $where_id
     * @return bool|mysqli_result
     */
    public static function deleteData($table, $where_column, $where_id)
    {
        $query = "DELETE FROM {$table} WHERE {$where_column} = '{$where_id}'";
        $result = self::con()->query($query);
        return $result;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    public static function searchData($query)
    {
        $result = self::con()->query($query);
        return $result;
    }



}