<?php 
class Category extends BaseModel{
    function getAll(){
        $sql = "SELECT * from category";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $category=$stmt->fetchAll();
        return $category;
    }
    function get($id){
        $sql = "SELECT * from category where users.id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id'=>$id]);
        $category = $stmt->fetch();
        return $category;
    }
    function delete($id){
        $sql = "DELETE from category where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->rowCount();
    }
    function add($name){
        $sql = "INSERT into category (name) values (:name)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($name);
        return $stmt->rowCount();
    }
    function update($name){
        $sql = "UPDATE category set name=:name where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($name);
        return $stmt->rowCount();
    }
    
}
?>