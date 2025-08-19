<?php
class Course extends BaseModel{
    function getAll(){
        $sql = "SELECT courses.*, instructor.name as instructorName,category.name as categoryName
        from courses
        left join instructor
        on courses.instructor_id = instructor.id
        left join category
        on courses.category_id = category.id ";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute();
        $courses = $stmt->fetchAll();
        return $courses;
    }
    function get($id){
        $sql = "SELECT courses.*, instructor.name as instructorName,category.name as categoryName
        from courses
        left join instructor
        on courses.instructor_id = instructor.id
        left join category
        on courses.category_id = category.id where courses.id=:id";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute([':id'=>$id]);
        $courses = $stmt->fetch();
        return $courses;
    }
    function delete($id){
        $sql = "DELETE from courses where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id'=>$id]);
        return $stmt->rowCount();
    }
    function add($data){
        $sql = "INSERT into courses (name, thumbnail, instructor_id, description,price,category_id,duration) values (:name,:thumbail,:instructor_id,:description,:price,:category_id,:duration)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }
    function update($data){
        $sql = "UPDATE courses set name=:name,thumbnail=:thumbnail,instructor_id=:instructor_id,description=:description,price=:price,category=:category,duration=:duration where id=:id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }
    function search($keyword){
        $key = "%$keyword%";
        $sql = "SELECT courses.*, instructor.name as instructorName,category.name as categoryName
        from courses 
        left join instructor
        on courses.instructor_id = instructor.id
        left join category
        on courses.category_id = category.id
        where courses.name like :keyword or cast(courses.price as char) like :keyword or category.name like :keyword";
          $stmt = $this->pdo->prepare($sql);
          $stmt->execute([':keyword'=>$key]);
          $courses = $stmt->fetchAll();
          return $stmt->rowCount();
    }
    public function getAll_category(){
        $sql = "SELECT DISTINCT category.name as categoryName,category.id as category_id
        from courses
        join category
        on courses.category_id = category.id";
         $stmt = $this->pdo->prepare($sql);
         $stmt->execute();
         $category = $stmt->fetchAll();
         return $category;
    }
    function category($keyword){
        $key = "%$keyword%";
        $sql ="SELECT courses.*, instructor.name as instructorName,category.name as categoryName
        from courses 
        left join instructor
        on courses.instructor_id = instructor.id
        left join category
        on courses.category_id = category.id
        where courses.category_id like :keyword";
         $stmt = $this->pdo->prepare($sql);
         $stmt->execute([':keyword'=>$key]);
         $courses = $stmt->fetchAll();
         return $courses;
    }
}
?>