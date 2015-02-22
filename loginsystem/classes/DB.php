<?php
/**
 * Created by PhpStorm.
 * User: chuck
 * Date: 2/22/15
 * Time: 9:51 AM
 * DB Connection Class
 */


class DB {

    private static $_instance =null;  //Stores Database Instance
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0;

    //Construct DB Object
    private function __construct(){

        try{

            $this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').' dbname='.Config::get('mysql/db'),Config::get('mysql/username'),Config::get('mysql/password'));
            //echo 'Connected';
        }catch(PDOException $e){
            die('Connection failed: ' . $e->getMessage());
        }
    }

    public static function getInstance(){//Insures only only one connection

        if(!isset(self::$_instance)){

            self::$_instance = new DB();
        }

        return self::$_instance;

    }

    //Query Database
    public function query($sql, $params = array()){

        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)){ // Verify SQL is prepared.  A single equal is correct
            //echo 'Success';
            $x=1;
            if(count($params)){ //Checks for multiple parameters with the query example username 'john', 'jane', 'billy'

                foreach($params as $param){

                    $this->_query->bindValue($x, $param);
                    $x++;
                }


            }
            if($this->_query->execute()){   //Executes Query stores object in $results
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();

            }else{
                $this->_error = true;
            }
        }
        return $this;

    }

    //Query Action
    public function action($action, $table, $where = array()){


        if(count($where) === 3){

            $operators = array('=', '>', '<', '>=', '<=');

            $field      = $where[0];
            $operator   = $where[1];
            $value      = $where[2];

            if(in_array($operator, $operators)){

                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";

                if(!$this->query($sql, array($value))->error()){

                    return $this;

                }
            }


        }
        return false;


    }

    //Actions
    public function get($table, $where){

        return $this->action('SELECT *', $table, $where);

    }

    public function insert($table, $fields = array()){

        $keys = array_keys($fields);
        $values = '';
        $x = 1;

        foreach($fields as $field){
            $values .='?';

            if($x < count($fields)){
                $values .= ', ';
            }

            $x++;

        }

        $sql="INSERT INTO users (`". implode('`, `', $keys) ."`) VALUES ({$values})";


        if(!$this->query($sql, $fields)->error()){

            return true;
        }

        return false;

    }

    public function update($table, $id, $fields){

        $set = '';
        $x=1;

        foreach($fields as $field => $value){
            $set .= "{$field} = ?";

            if($x < count($fields)){
                $set .= ', ';
            }
            $x++;

        }

        $sql = "UPDATE {$table} SET {$set} WHERE id = {$id}";
        //echo $sql;

        if(!$this->query($sql, $fields)->error()){

            return true;
        }
        return false;


    }

    public function delete($table, $where){

        return $this->action('DELETE', $table, $where);
    }

    public function results(){

        return $this->_results;
    }

    public function firstrow(){

        return $this->_results[0];
    }

    public function count(){

        return $this->_count;

    }

    //Error
    public function error(){

        return $this->_error;
    }







}