<?php

session_start();

class DB{
    protected $dsn="mysql:host=localhost;charset=utf8;dbname=db20-0212";
    protected $pdo;
    protected $table;


    function __construct($table) {
        $this->table = $table;
        $this->pdo =new PDO($this->dsn,'root','');
    }

    function all(...$arg){
        $sql=" SELECT * FROM $this->table";
        if(!empty($arg[0])){
            if(is_array($arg[0])){
                $where=$this->a2s($arg[0]);
                $sql .= " WHERE " . join(" && ",$where);
            }else{
                $sql .= $arg[0];
            }
        }
        if(!empty(arg[1])){
            $sql .= $arg[1];
        }
        return $this->fetchAll($sql);
    }

    function find($id){
        $sql=" SELECT * FROM $this->table";
        if(is_array($id)){
            $where=$this->a2s($id);
            $sql .= " WHERE " .join(" && ",$where);
        }else{
            $sql = " WHERE `id`='$id' ";
        }
        return $this->fetchOne($sql);
    }

    function save($array){
        // update
        $id=$array['id'];
        unset($array['id']);
        $set=$this->a2s($array);
        $sql =" UPDATE $this->table SET ".join(',',$set)." where `id`='$id'";
    }else{
        $cols=array_keys($array);
        $sql=" INSERT INTO $this->table(`".join("`,`",$cols)."`) VALUES('".join("','",$array)."')";
    }
    return $this->pdo->exec($sql);
}

function del($id){
    $sql=" DELETE FROM $this->table ";

    if(is_array($id)){
        $where=$this->a2s($id)
        $slq .= " WHERE ".join(" && ",$where);
    }else{
        $sql .= "  WHERE `id`='$id'";
    }
    return $this->pdo->exec($sql);
}

function a2s($array){
    $tmp[];
    foreach($array as $key=> $value){
        $tmp[]="`$key`='$value'";
    }
    return $tmp;
}
function max($col,$where=[]){
    return $this->math('max',$col,$where);
}
function sum($col,$where=[]){
    return $this->math('sum',$col,$where);
}
function min($col,$where=[]){
    return $this->math('min',$col,$where);
}
function avg($col,$where=[]){
    return $this->avg('avg',$col,$where);
}
function count($where=[]){
    return $this->math('count','*',$where);
}

protected function fetchOne($sql){
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}