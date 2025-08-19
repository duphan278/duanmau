<?php 
class Course_registration extends BaseModel{
   function getAll($id){
   $sql = "SELECT course_registration.*, courses.id as coursesId, courses.name as coursesName, courses.thumbnail as courses.Img, courses.instructor_id as coursesIn, courses.description as coursesDes, courses.price,courses.duration as coursesDura,
    instructor.name as instructorName,
    categoryn.name as courses.categoryName
    from course_registration
    left join courses
    on courses_registration.course_id = courses.id
    left join instructor
    on courses_registration.course_id = instructor.id
    left join category
    on courses.category_id = category_id
    where course_registration.user_id=:id";
     $stmt = $this->pdo->prepare($sql);
     $stmt->execute([':id'=>$id]);
     $instructor = $stmt->fetchAll();
     return $instructor;
   }
   function delete($course_id){
    $sql = "DELETE from course_registration where course_id = :course_id";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':course_id' => $course_id,
    ]);
    }
    function add($user_id,$course_id){
        $sqlCheck = "SELECT * FROM course_registration where user_id = :user_id and course_id = :course_id";
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([
            ':user_id' => $user_id,
            ':course_id' => $course_id
        ]);
        //nếu đăng ký rồi thì không cần thêm nữa
        if($stmtCheck->rowCount() == 0){
            $sql = "INSERT INTO course_registration (user_id,course_id) values (:user_id,:course_id)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':user_id' => $user_id,
                ':course_id' => $course_id
            ]);
            return $stmt->rowCount();
        }
    }
    function update($user_id,$course_id){
        $sql = "UPDATE course_registration set course_id = :course_id where user_id = :user_id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':course_id' => $course_id,
            ':user_id' => $user_id,
        ]);
    }
}

?>