<?php
namespace core;

use \core\Database;

# get DB connection and implements a query builder
class Model extends Database 
{
    protected static $conn;
    private $query;

    public function __construct()
    {
        self::$conn = Database::getInstance();
    }

    public function getTableName() 
    {
        $className = explode('\\', get_called_class());
        $className = end($className);
        return strtolower($className).'s';
    }

    public function select($fields=[])
    {
        # check fields
        if(count($fields) > 0){
            $fields = implode(',', $fields);
            $sql = "SELECT $fields FROM ".$this->getTableName();
        } else {
            $sql = "SELECT * FROM ".$this->getTableName();
        }

        $this->query = $sql;
        return $this;
    }

    public function join($tableJoin, $fa, $operator, $fb)
    {
        if($this->query == null){
            return 'ERRO';
        }

        if($fa == null || $operator == null || $fb == null){
            return 'ERRO';
        }

        $this->query .= " INNER JOIN $tableJoin ON $fa $operator $fb";
        return $this;
    }

    public function leftJoin($tableJoin, $fa, $operator, $fb)
    {
        if($this->query == null){
            return 'ERRO';
        }

        if($fa == null || $operator == null || $fb == null){
            return 'ERRO';
        }

        $this->query .= " LEFT JOIN $tableJoin ON $fa $operator $fb";
        return $this;
    }

    public function groupBy($field)
    {

        if(!$field){
            return false;
        }

        $this->query .= " group by $field";

        return $this;

    }

    public function insert($fields=[])
    {

        if(count($fields) == 0){
            return 'Indique os campos que deseja inserir valores';
        }

        $keys = implode(', ', array_keys($fields));
        $values = implode("', '", array_values($fields));

        $sql = "INSERT INTO ".$this->getTableName()." ($keys) VALUES ('$values')";
        $this->query = $sql;

        return $this;
    }

    public function update($fields=[])
    {
        $matches = [];

        # check fields
        if(count($fields) == 0){
            return 'Indique os campos que deseja inserir valores';
        }

        foreach ($fields as $field => $value) {
            $matches[] = $field.'='."'".$value."'";
        }

        $sql = "UPDATE ".$this->getTableName()." SET ".implode(', ', $matches);
        $this->query = $sql;

        return $this;

    }

    public function delete($field=null, $operator=null, $value=null)
    {
        # check fields
        if($field == null || $value == null){
            return 'Indique o campo que deseja deletar';
        }

        $sql = "DELETE FROM ".$this->getTableName()." WHERE $field $operator '$value'";
        $this->query = $sql;

        return $this;
    }

    public function having($field=null, $operator=null, $value=null)
    {
        if($this->query == null){
            return 'ERRO';
        }

        if($field == null || $operator == null || $value == null){
            return 'ERRO';
        }

        $this->query .=" HAVING $field $operator '$value'";

        return $this;
    }

    public function where($field=null, $operator=null, $value=null)
    {
        if($this->query == null){
            return 'ERRO';
        }

        if($field == null || $operator == null || $value == null){
            return 'ERRO';
        }

        $this->query .=" WHERE $field $operator '$value'";

        return $this;
    }

    public function orWhere($field=null, $operator=null, $value=null)
    {
        if($this->query == null){
            return 'ERRO';
        }

        if($field == null || $operator == null || $value == null){
            return 'ERRO';
        }
        
        $this->query .= " OR $field $operator '$value'";

        return $this;
    }

    public function andWhere($field=null, $operator=null, $value=null)
    {
        if($this->query == null){
            return 'ERRO';
        }

        if($field == null || $operator == null || $value == null){
            return 'ERRO';
        }
        
        $this->query .= " AND $field $operator '$value'";

        return $this;
    }

    public function get()
    {
        $query = self::$conn->prepare($this->query);
        $query->execute();

        $data = $query->fetchAll(\PDO::FETCH_CLASS);

        return $data;
    }

    # this is for update and delte queries
    public function exec()
    {
        $query = self::$conn->prepare($this->query);
        return $query->execute();
    }

    public function one()
    {
        $query = self::$conn->prepare($this->query);
        $query->execute();

        $data = $query->fetchAll(\PDO::FETCH_CLASS);

        if(count($data) == 0){
            return false;
        }

        return $data[0];
    }

}
