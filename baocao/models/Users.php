<?php 
class Users extends BaseModel{
    function getAll(){
        $sql = "SELECT * from users";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $users=$stmt->fetchAll();
        return $users;
    }
    function add($data){
        $sql = "SELECT count(*) from users where username = :username and password = :password";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        $count=$stmt->fetchColumn();
        if($count == 0){
            $sql = "INSERT into users (username,password) values (:username,:password)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($data);
            return $this->pdo->lastInsertId();
        }
        return 0;
    }
    function update($data){
        $sql = "UPDATE users set username=:username, email=:email, avatar_url = :avatar_url where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }
    function update_course($id,$coursesId){
        $sql="UPDATE user set course_registration = :coursesId, instructor_name=:courseId where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id,
            ':coursesId' => $coursesId,]);
    }
    function get($id){
        $sql = "SELECT * from users where users.id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id'=>$id]);
        $courses = $stmt->fetch();
        return $courses;
    }
    function delete($id){
        $sql = "DELETE from users where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->rowCount();
    }
    function check($username,$password){
        $sql = "SELECT * from users where username = :username and password = :password";
        //truy vấn thông tin và lưu thông tin vào một mảng
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':username'=>$username,':password'=>$password]);
        //chỉ in một cái giống nhất
        $user = $stmt->fetch();
        return $user;
    }
    function search($keyword){
        $key="%$keyword%";
        $sql="SELECT * from users where username like :keyword";
        //truy vấn đối tượng
        $stmt=$this->pdo->prepare($sql);
        $stmt->execute([':keyword'=>$key]);
        $courses=$stmt->fetchAll();
        return $courses;
    }
}
?>