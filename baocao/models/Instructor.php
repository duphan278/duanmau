<?php
class Instructor extends BaseModel{
    function getAll(){
        $sql = "SELECT * from instructor";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $instructor=$stmt->fetchAll();
        return $instructor;
    }
}
?>