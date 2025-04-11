<?php
session_start();
$connection= mysqli_connect("localhost", "root","","dbsf2");
mysqli_query($connection,"set names 'utf8' ");



if($_GET['c']=="signup")
{

  $sql="INSERT INTO `professor` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES 
  (NULL, '$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]')";
    

    if(mysqli_query($connection,$sql))
    {
        echo "ok";
    } 
   
    else
    {
        echo "error";
    }
}


if ($_GET['c']=="syndesi"){
   
    
    if($_POST['typeuser']=="admin")
    {
        $sql="select * from  `admin` where `email`='$_POST[email]' and `password`='$_POST[password]'";

    }
    
    if($_POST['typeuser']=="professor")
    {
        $sql="select * from  `professor` where `email`='$_POST[email]' and `password`='$_POST[password]'";
    }

    
    if($_POST['typeuser']=="student")
    {
        $sql="select * from  `student` where `email`='$_POST[email]' and `password`='$_POST[password]'";
    }

    
    $r=mysqli_query($connection,$sql);
  
    if(mysqli_num_rows($r)>0){

    $u=mysqli_fetch_assoc($r);
    $_SESSION['email']=$_POST['email'];
    $_SESSION['typeuser']=$_POST['typeuser'];
    $_SESSION['usrid']=$u['id'];
   
    echo "ok";
}
else
{
   
    echo "error";

}
}
if ($_GET['c']=="newprofessor"){
    $sql="INSERT INTO `professor` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES 
    (NULL, '$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]')";
    
      
  
      if(mysqli_query($connection,$sql))
      {
          echo "ok";
      } 
      
      else
      {
          echo "error";
      }

}
if ($_GET['c']=="allprofessors"){
    $sql="select * from `professor`";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if ($_GET['c']=="delprofessor"){
    $sql="delete from `professor` where id=$_GET[id]";
    
      
  
      $r=mysqli_query($connection,$sql);
     
      echo "ok";     

}

if ($_GET['c']=="newstudent"){
    $sql="INSERT INTO `student` (`id`, `email`, `password`, `firstname`, `lastname`) VALUES 
    (NULL, '$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]')";
    
      
  
      if(mysqli_query($connection,$sql))
      {
          echo "ok";
      } 
      
      else
      {
          echo "error";
      }

}
if ($_GET['c']=="allstudents"){
    $sql="select * from `student`";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if ($_GET['c']=="delstudent"){
    $sql="delete from `student` where id=$_GET[id]";
    
      
  
      $r=mysqli_query($connection,$sql);
     
      echo "ok";     

}
if ($_GET['c']=="newcategory"){
    $c=htmlspecialchars($_POST['cat'],ENT_QUOTES);
    $d=htmlspecialchars($_POST['description'],ENT_QUOTES);
    $sql="INSERT INTO `lesson` (`id`, `name`, `description`, `id_professor`) 
    VALUES (NULL, '$c', '$d','$_SESSION[usrid]' )";
    
    
  
      $r=mysqli_query($connection,$sql);
     
      echo "ok";     

}
if ($_GET['c']=="onecategory"){
    $sql="select * from `lesson` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if ($_GET['c']=="onetest"){
    $sql="select * from `test` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}


if ($_GET['c']=="onesubmission"){
    $sql="select * from `test` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=mysqli_fetch_assoc($r);
      echo json_encode($A);     

}
/*if($_GET['c']=="allmycourses")
{
    $sql="select * from `lesson`, `student_course` where lesson.id= student_course.id_lesson 
    and student_course.id_student=$_SESSION[usrid]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}*/
if ($_GET['c']=="mycategories"){
    $sql="select DISTINCT lesson.* from `lesson`,`professor` WHERE id_professor= '$_SESSION[usrid]'";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}
/*if ($_GET['c']=="mycategories"){
    $sql = "SELECT DISTINCT lesson.* 
            FROM `lesson`
            INNER JOIN `professor` 
            ON lesson.id_professor = professor.id_professor
            WHERE lesson.id_professor = '$_SESSION[usrid]'";

    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);
    echo json_encode($A);
}
*/

if ($_GET['c']=="allcategories"){
    $sql="select * from `lesson` ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if($_GET['c']=="newquiz")
{
    $sql="INSERT INTO `test` 
     (`id`, `id_professor`, `id_lesson`, `total_time`, `date_of_creation`, `title`, `vash`, `visibility`) 
     VALUES (NULL,'$_SESSION[usrid]', '$_GET[id]', '$_POST[total_time]',
      '$_POST[date_of_creation]', '$_POST[test]', '$_POST[vash]',  '$_POST[visibility]')" ;


    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}






if($_GET['c']=="newgram")
{
    $sql="INSERT INTO `admin`  (`id`, `email`, `password`, `firstname`, `lastname`) VALUES (NULL,'$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]' )" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="allgram")
{
    $sql="select * from `admin`" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="delquiz")
{
    $sql="delete from `test` where id=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if ($_GET['c'] == "toggle_visibility")
 {
    $quiz_id = $_GET['id'];
    $new_visibility = $_GET['visibility'];
   // $new_visibility = $current_visibility ? 0 : 1; // Toggle visibility

    $sql = "UPDATE `test` SET visibility = $new_visibility WHERE id = $quiz_id";
    mysqli_query($connection, $sql);

    echo json_encode(["status" => "success", "new_visibility" => $new_visibility]);
}



if($_GET['c']=="allmylessonquiz")
{
    $sql="select * from `test` where id_lesson=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}


if($_GET['c']=="delmathima")
{
    $sql="delete from `lesson` where id=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="delgram")
{
    $sql="delete from `admin` where id=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="exercise")
{
    $sql="INSERT INTO `exercise` 
     (`id`, `id_test`, `vocalization`, `feedback`, `points`, `levelofdifficulty`) 
     VALUES (NULL, '$_GET[id]', '$_POST[vocalization]', '$_POST[feedback]',
      '$_POST[points]', '$_POST[levelofdifficulty]')" ;


    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="insertmakequiz")
{
    
    $sql="INSERT INTO `student_course` 
     (`id_lesson`, `id_student`, `id`) 
     VALUES ('$_GET[id]', '$_SESSION[usrid]', NULL)" ;

if(mysqli_query($connection,$sql))
{

    echo "ok";
}
    else
    {
        echo "error";
    }
}

if ($_GET['c']=="onequiz"){
    $sql="select * from `test` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}


/*if($_GET['c'] == "studentquiz") {

    $page = isset($_GET['page-nr']) ? intval($_GET['page-nr']) : 1; // Get the current page number
    $rows_per_page = 1; // Show one exercise per page
    $offset = ($page - 1) * $rows_per_page; // Calculate offset for SQL query

    // Fetch exercises with pagination
    $sql = "SELECT * FROM `exercise` WHERE id_test = $_GET[id] LIMIT $offset, $rows_per_page";
    $i = 0;
    $q = mysqli_query($connection, $sql);
    $A = [];

    while ($qst = mysqli_fetch_assoc($q)) {
        $A[$i]["q"] = $qst;

        // Fetch answers for each exercise
        $sqla = "SELECT * FROM `answer` WHERE id_of_exercise = $qst[id]";
        $a = mysqli_query($connection, $sqla);
        $A[$i]["a"] = $a->fetch_all(MYSQLI_ASSOC);
        $i++;
    }

    echo json_encode($A);
}*/
/*if ($_GET['c'] == "studentquiz") {

    $page = isset($_GET['page-nr']) ? intval($_GET['page-nr']) : 1; // Get the current page number
    $rows_per_page = 1; // Show one exercise per page
    $offset = ($page - 1) * $rows_per_page; // Calculate offset for SQL query

    // Fetch total count of exercises
    $countQuery = "SELECT COUNT(*) as total FROM `exercise` WHERE id_test = $_GET[id]";
    $countResult = mysqli_query($connection, $countQuery);
    $totalExercises = mysqli_fetch_assoc($countResult)['total'];
    $pages = ceil($totalExercises / $rows_per_page); // Calculate total pages

    // Fetch exercises with pagination
    $sql = "SELECT * FROM `exercise` WHERE id_test = $_GET[id] LIMIT $offset, $rows_per_page";
    $i = 0;
    $q = mysqli_query($connection, $sql);
    $A = [];

    while ($qst = mysqli_fetch_assoc($q)) {
        $A[$i]["q"] = $qst;

        // Fetch answers for each exercise
        $sqla = "SELECT * FROM `answer` WHERE id_of_exercise = $qst[id]";
        $a = mysqli_query($connection, $sqla);
        $A[$i]["a"] = $a->fetch_all(MYSQLI_ASSOC);
        $i++;
    }

    echo json_encode([
        'exercise' => $A,
        'pages' => $pages // Return the total pages to the frontend
    ]);
}*/
if ($_GET['c'] == "studentquiz") {

    // Get the page number from the request (default to page 1)
    $page = isset($_GET['page-nr']) ? intval($_GET['page-nr']) : 1;  
    $rows_per_page = 1; // We want to show one exercise per page
    $offset = ($page - 1) * $rows_per_page; // Calculate offset for SQL

    // Fetch the total count of exercises
    $countQuery = "SELECT COUNT(*) as total FROM `exercise` WHERE id_test = $_GET[id]";
    $countResult = mysqli_query($connection, $countQuery);
    $totalExercises = mysqli_fetch_assoc($countResult)['total'];
    $pages = ceil($totalExercises / $rows_per_page); // Calculate total pages

    // Fetch the exercise for the current page with the answers
    $sql = "SELECT * FROM `exercise` WHERE id_test = $_GET[id] LIMIT $offset, $rows_per_page";
    $q = mysqli_query($connection, $sql);
    $A = [];

    while ($qst = mysqli_fetch_assoc($q)) {
        $exerciseId = $qst['id'];
        $A['exercise'][] = $qst;

        // Fetch answers for this exercise
        $sqla = "SELECT * FROM `answer` WHERE id_of_exercise = $exerciseId";
        $a = mysqli_query($connection, $sqla);
        $A['exercise'][0]['a'] = $a->fetch_all(MYSQLI_ASSOC);
    }

    // Return the exercises and the total number of pages
    echo json_encode([
        'exercise' => $A['exercise'],
        'pages' => $pages
    ]);
}





/*if($_GET['c']=="studentquiz")
{

    $sql="select * from `exercise` where id_test=$_GET[id]" ;
    $i=0;
    $q=mysqli_query($connection,$sql);
    while($qst=mysqli_fetch_assoc($q))
    {
        $A[$i]["q"]=$qst;
        $sqla="select * from `answer` where id_of_exercise=$qst[id]" ;
        $a=mysqli_query($connection,$sqla);
        $A[$i]["a"]=$a->fetch_all(MYSQLI_ASSOC);
        $i++;
    }
   
   echo json_encode($A);
}*/



/*if($_GET['c']=="studentquiz")
{
    $start=0;
    $rows_per_page=6;
    $page = isset($_GET['page-nr']) && is_numeric($_GET['page-nr']) && $_GET['page-nr'] > 0 ? intval($_GET['page-nr']) : 1;
$start = ($page - 1) * $rows_per_page;
    if (!isset($_GET['id'])) {
        echo json_encode(['error' => 'Test ID is missing']);
        exit;
    }
    $id = intval($_GET['id']);
    // Get total number of rows to calculate pages
    header('Content-Type: application/json');

    $sql2 = $conn->query("SELECT COUNT(*) as total FROM `exercise`  WHERE id_test = " . $id);
 
    if (!$sql2) {
        echo json_encode(['error' => 'Failed to execute count query']);
        exit;
    } 
    //  if ($sql2) {
        $number_of_rows = $sql2->fetch_assoc()['total'];
      //  if (isset($number_of_rows) && isset($rows_per_page)) {
            $pages = ceil($number_of_rows / $rows_per_page);
            $page = isset($_GET['page-nr']) && is_numeric($_GET['page-nr']) && $_GET['page-nr'] > 0 ? intval($_GET['page-nr']) - 1 : 0;
            $start = $page * $rows_per_page;
      //  } else {
      //      $pages = 1; // Default value
      //  }
     
         // Set current page and calculate the offset for SQL query
    /*(isset($_GET['page-nr']))
    {
        $page = isset($_GET['page-nr']) && is_numeric($_GET['page-nr']) && $_GET['page-nr'] > 0 ? $_GET['page-nr'] - 1 : 0;
        $page= $_GET['page-nr'] -1 ;
        $start= $page * $rows_per_page; 
    }  else {
    $page = 0; // If no page is set, show the first page
    $start = 0;
}
 // Fetch exercises and their answers
    //$sql="select * from `exercise` where id_test = " . $_GET['id'] . " LIMIT $start,$rows_per_page" ;
    $sql = "SELECT * FROM `exercise` WHERE id_test = " . $id . " LIMIT $start, $rows_per_page";

    $result = $conn->query($sql);
    $exercises = [];
    
    if ($result) {
        while ($exercise = $result->fetch_assoc()) {
            // Fetch answers for each exercise
            $sqla = "SELECT * FROM `answer` WHERE id_of_exercise = " . $exercise['id'];
            $answer_result = $conn->query($sqla);
            $exercise['a'] = $answer_result->fetch_all(MYSQLI_ASSOC);
            $exercises[] = $exercise;
        }*/
   /* if ($result) {
        $exercise = $result->fetch_all(MYSQLI_ASSOC);
        
         // Return data along with pagination info

         echo json_encode([
            'exercise' => $exercises,
            'pages' => $pages
        ]);
    } 
    else {
        echo json_encode([
            'exercise' => [],
            'pages' => 1
        ]); // Return empty array with 1 page if query fails
    }

  
  /*else {
    echo json_encode([
        'exercise' => [],
        'pages' => 1
    ]); // Error handling for total rows query
}
$i=0;
    while($qst=mysqli_fetch_assoc($result))
    {
        $A[$i]["result"]=$qst;
        $sqla="select * from `answer` where id_of_exercise=$qst[id]" ;
        $a=mysqli_query($connection,$sqla);
        $A[$i]["a"]=$a->fetch_all(MYSQLI_ASSOC);
        $i++;
    }
   
    echo json_encode($A);
} */








/*if($_GET['c']=="studentquiz")
{
    <?php
    // Assuming you already have a connection to the database in $db (using PDO)
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 5; // Default limit of 5 questions per page
    $quiz_id = isset($_GET['id']) ? (int)$_GET['id'] : 0; // The quiz ID must be passed
    
    if ($quiz_id <= 0) {
        echo json_encode(["error" => "Invalid quiz ID"]);
        exit;
    }
    
    $offset = ($page - 1) * $limit;
    
    try {
        // Query to fetch a paginated set of questions for the quiz
        $query = "SELECT * FROM questions WHERE quiz_id = :quiz_id LIMIT :limit OFFSET :offset";
        
        // Prepare the statement
        $stmt = $db->prepare($query);
    
        // Bind the parameters properly
        $stmt->bindValue(':quiz_id', $quiz_id, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
        // Execute the query
        $stmt->execute();
    
        // Fetch the result set
        $questions = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        // Send the results as JSON
        echo json_encode($questions);
    } catch (PDOException $e) {
        // If there is any error with the query or database interaction
        echo json_encode(["error" => $e->getMessage()]);
    }
    ?>
    

echo json_encode($questions);


    $sql="select * from `exercise` where id_test=$_GET[id]" ;
    $i=0;
    $q=mysqli_query($connection,$sql);
    while($qst=mysqli_fetch_assoc($q))
    {
        $A[$i]["q"]=$qst;
        $sqla="select * from `answer` where id_of_exercise=$qst[id]" ;
        $a=mysqli_query($connection,$sqla);
        $A[$i]["a"]=$a->fetch_all(MYSQLI_ASSOC);
        $i++;
    }
   
   echo json_encode($A);
}
*/

/*if($_GET['c']=="neaapadisi")
{
    $sql="INSERT INTO `answer`  (`id`, `id_of_exercise`, `text_of_answer`, `true_false`) VALUES (NULL,'$_GET[id]', '$_POST[text_of_answer]', '$_POST[true_false]' )" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}*/

/*if($_GET['c']=="showex")
{
    $sql="select * from `exercise` where id_test=$_GET[id]" ;
    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

   echo json_encode($A);
}*/

/*if($_GET['c']=="addex")
{
    $sql="select * from exercise where id=$_GET[id]" ;

    $r=mysqli_query($conn,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="allexer")
{
    $sql1="select * from `answer`" ;
    $r=mysqli_query($conn,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

   echo json_encode($A);
}*/
if($_GET['c']=="delexer")
{
    $sql="delete from `exercise` where id=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="newanswer")
{
    $sql="INSERT INTO `answer` 
     (`id`, `id_of_exercise`, `text_of_answer`, `true_false`) 
     VALUES (NULL, '$_GET[id]', '$_POST[text_of_answer]',
      '$_POST[true_false]')" ;


    $r=mysqli_query($connection,$sql);
   
    echo "ok";
}



/*if($_GET['c']=="onoff")
{
    $sql="INSERT INTO `test` 
     (`id`, `id_professor`, `id_lesson`, `total_time`, `date_of_creation`, `title`, `vash`, `on_off`)  
     VALUES (NULL,'$_SESSION[usrid]','$_GET[id]','$_POST[total_time]', '$_POST[date_of_creation]', '$_POST[title]','$_POST[vash]', '$_POST[on_off]')" ;


    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}*/



if($_GET['c']=="showex")
{
    $sql="select * from `exercise` where id_test=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="allanswers")
{
    $sql="select * from `answer` where id_of_exercise=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="allquiz")
{  //  $sql="select DISTINCT lesson.* from `lesson`,`professor` WHERE id_professor= '$_SESSION[usrid]'";

    $sql="select DISTINCT test.* from `test`, `make_quiz` WHERE id_student= '$_SESSION[usrid]'" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}
if($_GET['c']=="allquiz1")
{  //  $sql="select DISTINCT lesson.* from `lesson`,`professor` WHERE id_professor= '$_SESSION[usrid]'";

    $sql="select DISTINCT test.* from `test`, `professor` WHERE id_professor= '$_SESSION[usrid]'" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}
if($_GET['c']=="allquiz2")
{
    $sql="select * from `test`" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}


if($_GET['c']=="allexercise")
{
    $sql="select * from `exercise`" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}


if($_GET['c']=="delanswer")
{
    $sql="delete from `answer` where id=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}

if ($_GET['c']=="oneanswer"){
    $sql="select * from `answer` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}
if ($_GET['c']=="oneexercise"){
    $sql="select * from `exercise` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if ($_GET['c']=="chosencategory"){
    $sql="select * from `lesson` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if($_GET['c']=="allcourses")
{
    $sql="select * from `lesson`" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="allquizes")
{
    $sql="select * from `test`" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="coursequizes")
{
    $sql="select * from `test` where id_lesson=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}
/*if($_GET['c']=="dellesson")
{
    $sql="delete from `lesson` where id=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}*/
if ($_GET['c'] == "dellesson") {
    // Ensure you're using a valid connection
    $connection= mysqli_connect("localhost", "root","","dbsf2");

    if (!$connection) {
        echo "Connection failed: " . mysqli_connect_error();
        exit;
    }

    // Sanitize input to avoid SQL injection
    $id = (int)$_GET['id'];

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM `lesson` WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" means integer
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "ok";
    } else {
        echo "Error: Could not delete course.";
    }

    $stmt->close();
    $connection->close();
}


if($_GET['c']=="smycourses")
{
    $sql="INSERT INTO `student_course`
     (`id`,`id_lesson`, `id_student`) 
     VALUES (NULL, '$_GET[id]', '$_SESSION[usrid]')" ;


    mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="allmycourses")
{
    $sql="select * from `lesson`, `student_course` where lesson.id= student_course.id_lesson 
    and student_course.id_student=$_SESSION[usrid]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

/*if($_GET['c']=="mycourses")
{
    $sql="select * from `lesson`, `student_course` where lesson.id= student_course.id_lesson 
    and student_course.id_student=$_SESSION[usrid]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}*/

/*if($_GET['c']=="allstudentquiz")
{
    $sql="select * from `test` where id_lesson=$_GET[id] and visibility=1" ;
    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);
    echo json_encode($A);
}
if($_GET['c']=="notallstudentquiz")
{
    $sql="select * from `test`,make_quiz.completed where id_lesson=$_GET[id], test.visibility=1, make_quiz.completed=1 and make_quiz.id_test=test.id" ;
    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);
    echo json_encode($A);
}*/


if ($_GET['c'] == "allstudentquiz") {
    $lesson_id = $_GET['id'];  // Get the course ID (lesson ID) from the URL
    $student_id = $_SESSION['usrid'];  // Get the logged-in student ID

    // Query to get all quizzes for the specific course and student     IFNULL(mq.completed, 0) AS completed 
    $sql = "
        SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, mq.completed AS completed
        FROM test t
        LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $student_id
        WHERE t.visibility = 1 AND t.id_lesson = $lesson_id 
         GROUP BY t.id
    ";
   // $completed=1;
    $r = mysqli_query($connection, $sql);
    if (!$r) {
        echo json_encode(["status" => "error", "message" => mysqli_error($connection)]);
    } else {
        $A = $r->fetch_all(MYSQLI_ASSOC);
        echo json_encode($A);  // Return quizzes with completion status
    }
    
   // $A = $r->fetch_all(MYSQLI_ASSOC);
   // echo json_encode($A);  // Return quizzes with completion status
}

if ($_GET['c'] == "set_completed") {
    $quiz_id = $_GET['id'];
    //$new_completed = $_GET['completed'];  // Mark as completed
    $new_completed=1;
   // $student_id = $_SESSION['usrid']; // Get logged-in student's ID
   $student_id = $_GET['student_id'];  // Get the student's ID from the request
    // Insert or update completion status for the student
    $sql = "
        UPDATE make_quiz SET completed = 1 WHERE id_test = $quiz_id AND id_student = $student_id";
    
        // INSERT INTO make_quiz (id_student, id_test, completed) 
        // VALUES ($student_id, $quiz_id, $new_completed) 
        // ON DUPLICATE KEY UPDATE completed = $new_completed

    mysqli_query($connection, $sql);
    if (!mysqli_query($connection, $sql)) {
        echo json_encode(["status" => "error", "message" => mysqli_error($connection)]);
    } else {
        echo json_encode(["status" => "success"]);
    }
    
   // echo json_encode(["status" => "success"]);
}



/*if ($_GET['c'] == "toggle_completed")
 {
    $quiz_id = $_GET['id'];
    $new_completed = $_GET['completed'];
   // $new_visibility = $current_visibility ? 0 : 1; // Toggle visibility

    $sql = "UPDATE `test` SET completed = $new_completed WHERE id = $quiz_id";
    mysqli_query($connection, $sql);

    echo json_encode(["status" => "success", "new_completed" => $new_completed]);
}
*/







/*if ($_GET['c'] == "allstudentquiz") {
    $id_lesson = $_GET['id'];  // Logged-in student ID
    // Query to fetch quizzes for this student and whether they are completed
    $sql = "
        SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, 
            IF(mq.completed IS NULL, 0, mq.completed) AS completed
        FROM test t
        LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $_SESSION[usrid]
                WHERE t.visibility = 1 AND  id_lesson=$_GET[id]";
    $result = mysqli_query($connection, $sql);
    $quizzes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $quizzes[] = $row;
    }
    echo json_encode($quizzes);
}



if ($_GET['c'] == "set_completed") {
    $quiz_id = $_GET['id'];
    $new_completed = $_GET['completed'];
   // $student_id = $_GET['student_id']; // Pass student ID to this endpoint
    
    // Insert or update completion status for the student
    $sql = "
        INSERT INTO make_quiz (id_student, id_test, completed) 
        VALUES ($_SESSION[usrid], $quiz_id, $new_completed) 
        ON DUPLICATE KEY UPDATE completed = $new_completed";
    mysqli_query($connection, $sql);
    
    echo json_encode(["status" => "success", "new_completed" => $new_completed]);
}*/


/*if($_GET['c']=="allstudentquiz")
{
    $sql="select * from `test` where id_lesson=$_GET[id] and visibility=1 and completed=0" ;
    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);
    echo json_encode($A);
}*/


/*if ($_GET['c'] == "allstudentquiz") {
  //  $id_quiz = $_GET['id'];  // Lesson ID
    $student_id = $_SESSION['usrid'];  // Logged-in student ID

    // Query to fetch quizzes for this student and whether they are completed
    $sql = "
        SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, 
            IF(mq.completed IS NULL, 0, mq.completed) AS completed
        FROM test t
        LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $student_id
        WHERE t.visibility = 1 ";
    
    $r = mysqli_query($connection, $sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);
    echo json_encode($A);
   /* $quizzes = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $quizzes[] = $row;
    }
    echo json_encode($quizzes);*/
//}


/*if ($_GET['c'] == "set_completed") {
    $quiz_id = $_GET['id'];
    $new_completed = $_GET['completed'];
    $student_id = $_SESSION['usrid']; // Get logged-in student's ID

    // Insert or update completion status for the student
    $sql = "
        INSERT INTO make_quiz (id_student, id_test, completed) 
        VALUES ($student_id, $quiz_id, $new_completed) 
        ON DUPLICATE KEY UPDATE completed = $new_completed";
    
    mysqli_query($connection, $sql);
    
    echo json_encode(["status" => "success", "new_completed" => $new_completed]);
}*/





/*if ($_GET['c'] == "allstudentquiz") {
    $lesson_id = $_GET['id'];  // Get the course ID (lesson ID) from the URL
    $student_id = $_SESSION['usrid'];  // Logged-in student ID

    // Query to fetch quizzes for this student for the specific course (lesson_id)
    $sql = "
        SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, 
            IF(mq.completed IS NULL, 0, mq.completed) AS completed
        FROM test t
        LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $student_id
        WHERE t.visibility = 1 AND t.id_lesson = $lesson_id
           GROUP BY t.id";  // Ensure no duplicates by grouping by quiz ID
    
    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);
    echo json_encode($A); // Return only quizzes for the current course
}

if ($_GET['c'] == "set_completed") {
    $quiz_id = $_GET['id'];
    $new_completed = $_GET['completed'];
    $student_id = $_SESSION['usrid']; // Get logged-in student's ID

    // Insert or update completion status for the student
    $sql = "
        INSERT INTO make_quiz (id_student, id_test, completed) 
        VALUES ($student_id, $quiz_id, 0) 
        ON DUPLICATE KEY UPDATE completed = $new_completed";
    
    mysqli_query($connection, $sql);
    
    echo json_encode(["status" => "success", "new_completed" => $new_completed]);
}
*/












/*if ($_GET['c'] == "set_completed") {
    $quiz_id = $_GET['id'];
    $new_completed = $_GET['completed'];
    $student_id = $_SESSION['usrid']; // Get logged-in student's ID

    // Insert or update completion status for the student
    $sql = "
        INSERT INTO make_quiz (id_student, id_test, completed) 
        VALUES ($student_id, $quiz_id, $new_completed) 
        ON DUPLICATE KEY UPDATE completed = $new_completed";
    
    mysqli_query($connection, $sql);
    
    echo json_encode(["status" => "success", "new_completed" => $new_completed]);
}*/




/*if($_GET['c'] == "allstudentquiz") {
    // Assuming the student_id is stored in session
    //session_start();
   // $student_id = $_SESSION['student_id']; // Get the logged-in student ID
    
    // Query to select quizzes and their completion status for the logged-in student
    $sql = "SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, 
            IFNULL(t.completed, 0) as completed 
            FROM test t
            LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student =  $_SESSION[usrid]
            WHERE t.id_lesson = $_GET[id] AND t.visibility = 1";
    
    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}*/
/*if ($_GET['c'] == "allstudentquiz") {
   // session_start();
   
    $lesson_id = $_GET['id']; // Lesson ID

    // Check if student has completed the quiz or not
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quiz_id']) && isset($_POST['completed'])) {
        $quiz_id = $_POST['quiz_id'];
        $completed = $_POST['completed']; // 1 for completed

        // Update the completed status for this student and quiz
        $sql = "INSERT INTO make_quiz (id_student, id_test, completed) 
                VALUES ($student_id, $quiz_id, $completed)
                ON DUPLICATE KEY UPDATE completed = $completed";

        mysqli_query($connection, $sql);
    }

    // Now fetch all quizzes for the student
    $sql = "SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, 
            IFNULL(t.completed, 0) as completed 
            FROM test t
            LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $_SESSION[usrid]
            WHERE t.id_lesson = $lesson_id AND t.visibility = 1";

    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}*/

/*if ($_GET['c'] == "allstudentquiz") {
   // session_start();
    $student_id = $_SESSION['usrid']; // Get the logged-in student ID
    $lesson_id = $_GET['id']; // Lesson ID

    // Check if student has completed the quiz or not
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quiz_id'])) {
      //  $quiz_id = $_POST['quiz_id'];
        $completed = 1; // Mark the quiz as completed

        // Insert or update the completed status in the make_quiz table
        $sql = "INSERT INTO test (id_lesson, completed) 
                VALUES ($lesson_id, $completed)
                ON DUPLICATE KEY UPDATE completed = $completed";

        // Execute the query to mark the quiz as completed
        mysqli_query($connection, $sql);
    }

    // Now fetch all quizzes for the student
    $sql = "SELECT DISTINCT t.id, t.title, t.total_time, t.date_of_creation, 
            IFNULL(t.completed, 0) as completed 
            FROM test t
            LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $student_id
            WHERE t.id_lesson = $lesson_id AND t.visibility = 1";

    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}*/



/*if($_GET['c'] == "allstudentquiz") {
    // Assuming we have student_id available in the session
    session_start();
    $student_id = $_SESSION['student_id']; // Get the logged-in student ID
    
    // Query to select quizzes and their completion status for the logged-in student
    $sql = "SELECT t.id, t.title, t.total_time, t.date_of_creation, 
            IFNULL(mq.completed, 0) as completed 
            FROM test t
            LEFT JOIN make_quiz mq ON t.id = mq.id_test AND mq.id_student = $student_id
            WHERE t.id_lesson = $_GET[id] AND t.visibility = 1";
    
    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}*/

/*if ($_GET['c'] == "allstudentquiz") {
    $student_id = $_GET['id'];
    
    // Query to fetch quizzes
    $sql = "SELECT t.id, t.title, t.total_time, t.date_of_creation,
                   IFNULL(sqs.completed, 0) AS completed
            FROM `test` t
            LEFT JOIN `student_quiz_status` sqs ON sqs.quiz_id = t.id AND sqs.student_id = $student_id
            WHERE t.id_lesson = $_GET[id] AND t.visibility = 1";
    
    $r = mysqli_query($connection, $sql);
    $A = $r->fetch_all(MYSQLI_ASSOC);
    
    echo json_encode($A);
}
*/
if($_GET['c']=="smyquiz")
{
    $sql="INSERT INTO `make_quiz`
     (`id`, `id_student`, `id_test`, `start_time`, `end_time`,`student_answers`, `score` ) 
     VALUES (NULL, '$_SESSION[usrid]','$_GET[id]', '$_POST[start_time]',  '$_POST[end_time]',  '$_POST[student_answers]',  '$_POST[score]')" ;


    mysqli_query($connection,$sql);
   

    echo "ok";
}


/*if($_GET['c']=="sexercisesquiz")
{
    $sql="INSERTse INTO `exercise`
     (`id`,`id_of_exercise`, `text_of_answer`, `true_false`) 
     VALUES (NULL, '$_GET[id]', '$_POST[text_of_answer]','$_POST[true_false]')" ;


    mysqli_query($connection,$sql);
   

    echo "ok";
}*/

/*if($_GET['c']=="mycourses")
{
    $sql="INSERT INTO `exercise`
     (`id`,`id_of_exercise`, `text_of_answer`, `true_false`) 
     VALUES (NULL, '$_GET[id]', '$_POST[text_of_answer]','$_POST[true_false]')" ;


    mysqli_query($connection,$sql);
   

    echo "ok";
}*/

if($_GET['c']=="smakequiz")
{
    $sql="INSERT INTO `make_quiz`
     (`id`, `id_student`, `id_test`, `start_time`, `end_time`, `student_answers`, `score`) 
     VALUES (NULL, '$_SESSION[usrid]', '$_GET[id]', '$_POST[start_time]', '$_POST[end_time]', '$_POST[student_answers]', '$_POST[score]' )" ;


    mysqli_query($connection,$sql);
   

    echo "ok";
}

if($_GET['c']=="ssubmit")
{
    $sql2="select * from `test`, `make_quiz` where 
    test.id=make_quiz.id_test 
    and make_quiz.id_student=$_SESSION[usrid] order by make_quiz.id desc" ;

    
    $r=mysqli_query($connection,$sql2);
   
    $A=mysqli_fetch_assoc($r);
     //while ($A = mysqli_fetch_assoc($r)) {  // Fetch all rows  
  //$A=$r->fetch_all(MYSQLI_ASSOC);
   $ans=explode(",",$A["student_answers"]);
 
 
    
    $AA=[];
    foreach ($ans as $aa)
    {
        if($aa!=""){
        $sql="select * from answer, exercise where 
        answer.id_of_exercise=exercise.id and answer.id=$aa " ;
       
        $r2=mysqli_query($connection,$sql);
       // while {()
        $x=mysqli_fetch_assoc($r2);
        $AA[]=$x;
        }
      }
   // }
    $A["qa"]=$AA;
   // $response[] = $A; // Append to the response array

    echo json_encode($A);
}
/*if($_GET['c']=="ssubmit") {
    $sql2 = "SELECT * FROM `test`, `make_quiz` WHERE 
             test.id = make_quiz.id_test 
             AND make_quiz.id_student = $_SESSION[usrid] 
             ORDER BY make_quiz.id DESC";

    $r = mysqli_query($connection, $sql2);

    $response = []; // Initialize an empty array to hold all quiz results

    while ($A = mysqli_fetch_assoc($r)) { // Loop through each quiz result row
        $ans = explode(",", $A["student_answers"]);
        $AA = []; // Array to hold question-answer data for this quiz
        
        foreach ($ans as $aa) {
            if ($aa != "") {
                $sql = "SELECT * FROM answer, exercise WHERE 
                        answer.id_of_exercise = exercise.id AND answer.id = $aa";
                
                $r2 = mysqli_query($connection, $sql);
                $x = mysqli_fetch_assoc($r2); // Fetch question-answer details
                $AA[] = $x; // Append question-answer details
            }
        }
        
        $A["qa"] = $AA; // Add question-answer details to the current quiz result
        $response[] = $A; // Append the entire quiz result to the response array
    }

    echo json_encode($response); // Return all quiz results as a JSON array
}*/

/*if ($_GET['c'] == "ssubmit") {
    $quizData = [];
    
    try {
        $sql2 = "SELECT * FROM `test` INNER JOIN `make_quiz` ON test.id = make_quiz.id_test
                 WHERE make_quiz.id_student = $_SESSION[usrid]
                 ORDER BY make_quiz.id DESC";
        
        $result = mysqli_query($connection, $sql2);
        
        while ($quizEntry = mysqli_fetch_assoc($result)) {
            $ansIds = explode(",", $quizEntry["student_answers"]);
            $qa = [];
            
            foreach ($ansIds as $answerId) {
                if ($answerId != "") {
                    $sql = "SELECT exercise.vocalization, answer.text_of_answer, answer.true_false, exercise.feedback
                            FROM answer
                            JOIN exercise ON answer.id_of_exercise = exercise.id
                            WHERE answer.id = $answerId";
                    
                    $answerResult = mysqli_query($connection, $sql);
                    
                    if ($answerData = mysqli_fetch_assoc($answerResult)) {
                        $qa[] = $answerData;
                    }
                }
            }
            
            $quizEntry["qa"] = $qa;
            $quizData[] = $quizEntry;
        }
        
        echo json_encode($quizData);
    } catch (Exception $e) {
        echo json_encode(["error" => "Data fetch error"]);
    }
}
*/
/*if ($_GET['c'] == "ssubmit") {
    // Fetch all exercises related to this quiz attempt for the student
    $sql2 = "SELECT * FROM `test`, `make_quiz`
             WHERE test.id = make_quiz.id_test 
             AND make_quiz.id_student = $_SESSION[usrid]
             ORDER BY make_quiz.id DESC";
    
    $result = mysqli_query($connection, $sql2);
    $quizData = []; // Array to store all quiz data

    // Loop through each quiz entry related to this student's attempt
    while ($quizEntry = mysqli_fetch_assoc($result)) {
        $ansIds = explode(",", $quizEntry["student_answers"]);
        $qa = []; // Array to store answers and feedback

        // Retrieve detailed information for each answer ID
        foreach ($ansIds as $answerId) {
            if ($answerId != "") {
                $sql = "SELECT exercise.vocalization, answer.text_of_answer, answer.true_false, exercise.feedback
                        FROM answer
                        JOIN exercise ON answer.id_of_exercise = exercise.id
                        WHERE answer.id = $answerId";
                
                $answerResult = mysqli_query($connection, $sql);
                
                if ($answerData = mysqli_fetch_assoc($answerResult)) {
                    $qa[] = $answerData; // Add to QA array
                }
            }
        }

        // Add all answers and feedbacks to the main quiz data structure
        $quizEntry["qa"] = $qa;
        $quizData[] = $quizEntry;
    }

    echo json_encode($quizData); // Return all quiz data as JSON
}*/


/*if ($_GET['c'] == "ssubmit") {
    // Fetch all the quiz and test data
    $sql2 = "SELECT * FROM `test`, `make_quiz` 
             WHERE test.id = make_quiz.id_test 
             AND make_quiz.id_student = $_SESSION[usrid] 
             ORDER BY make_quiz.id DESC";

    $r = mysqli_query($connection, $sql2);

    // Fetch all rows, not just one
    $A = mysqli_fetch_all($r, MYSQLI_ASSOC); 
    
    $response = [];

    foreach ($A as $row) {
        $ans = explode(",", $row["student_answers"]);
        $AA = [];

        foreach ($ans as $aa) {
            if ($aa != "") {
                $sql = "SELECT * FROM answer, exercise 
                        WHERE answer.id_of_exercise = exercise.id 
                        AND answer.id = $aa";
                $r2 = mysqli_query($connection, $sql);
                $x = mysqli_fetch_assoc($r2);
                $AA[] = $x;
            }
        }
        $row["qa"] = $AA;
        $response[] = $row; // Collect all the data for all exercises
    }

    echo json_encode($response); // Return all exercises, not just the last one
}
*/

/*if($_GET['c']=="ssubmit")
{
    $sql="select * from test, make_quiz where 
    test.id=make_quiz.id_test 
    and make_quiz.id_student=$_SESSION[usrid] order by make_quiz.id desc" ;

    
    $r=mysqli_query($connection,$sql);
   // $A=mysqli_fetch_assoc($r);
  //$A=$r->fetch_all(MYSQLI_ASSOC);
  $A = mysqli_fetch_all($r, MYSQLI_ASSOC); // Fetch all rows
    $ans=explode(",",$A["student_answers"]);
    
    $AA=[];
    foreach ($ans as $aa)
    {
        if($aa!=""){
        $sql2="select * from answer, exercise where 
        answer.id_of_exercise=exercise.id and answer.id=$aa " ;
       
        $r2=mysqli_query($connection,$sql2);
        $x=mysqli_fetch_assoc($r2);
        $AA[]=$x;
        }
    }
    $A["qa"]=$AA;

    echo json_encode($A);
} 

*/



/*if($_GET['c']=="ssubmit")
{
    $sql = "SELECT * FROM test 
            INNER JOIN make_quiz ON test.id = make_quiz.id_test 
            WHERE make_quiz.id_student = $_SESSION[usrid] 
            ORDER BY make_quiz.id DESC";

    $r = mysqli_query($connection, $sql);
    
    $A = mysqli_fetch_all($r, MYSQLI_ASSOC); // Fetch all rows
    
    $AA = [];
    
    foreach ($A as $record) {
        $ans = explode(",", $record["student_answers"]);
        foreach ($ans as $aa) {
            if ($aa != "") {
                $sql2 = "SELECT * FROM answer 
                         INNER JOIN exercise ON answer.id_of_exercise = exercise.id 
                         WHERE answer.id = $aa";
                $r2 = mysqli_query($connection, $sql2);
                $x = mysqli_fetch_assoc($r2);
                $record['qa'][] = $x;  // Add each answer to the current quiz entry
            }
        }
        $AA[] = $record;
    }
    
    echo json_encode($AA);
}
*/





/*if($_GET['c']=="ssubmit")
{
    $sql = "SELECT * FROM test 
            INNER JOIN make_quiz ON test.id = make_quiz.id_test 
            WHERE make_quiz.id_student = $_SESSION[usrid] 
            ORDER BY make_quiz.id DESC";

    $r = mysqli_query($connection, $sql);
    $A=mysqli_fetch_assoc($r);
    //$A = mysqli_fetch_all($r, MYSQLI_ASSOC); // Fetch all rows
    
    $AA = [];
    
    foreach ($A as $record) {
        $ans = explode(",", $record["student_answers"]);
        foreach ($ans as $aa) {
            if ($aa != "") {
                $sql2 = "SELECT * FROM answer 
                         INNER JOIN exercise ON answer.id_of_exercise = exercise.id 
                         WHERE answer.id = $aa";
                $r2 = mysqli_query($connection, $sql2);
                $x = mysqli_fetch_assoc($r2);
                $record['qa'][] = $x;  // Add each answer to the current quiz entry
            }
        }
        $AA[] = $record;
    }
    
    echo json_encode($AA);
}
*/


/*if($_GET['c']=="ssubmit")
{
    //$test_id = $_GET['id'];
    $sql2="select * from `test`, `make_quiz` where 
    test.id=make_quiz.id_test
    and make_quiz.id_student=$_SESSION[usrid] order by make_quiz.id desc";  // Only the latest attempt 
 //AND make_quiz.id_test = $test_id  LIMIT 1
    
    $r=mysqli_query($connection,$sql2);
    //$A=mysqli_fetch_assoc($r);
  //$A=$r->fetch_all(MYSQLI_ASSOC);
  //$response = []; // Array to hold all exercises with answers
  if ($A = mysqli_fetch_assoc($r)) {  // Fetch the latest row for this test
  $ans=explode(",",$A["student_answers"]);
    
    $AA=[];
    foreach ($ans as $aa)
    {
        if($aa!=""){
        $sql="select * from answer, exercise where 
        answer.id_of_exercise=exercise.id and answer.id=$aa " ;
       
        $r2=mysqli_query($connection,$sql);
        while ($x=mysqli_fetch_assoc($r2)){
        $AA[]=$x;
        }
     }
    }
    $A["qa"]=$AA;
   // $response[] = $A; // Append to the response array

    echo json_encode([$A]);
  }
}*/
/*if ($_GET['c'] == "ssubmit") {
    // Fetch the test and the quiz submission for the current student
    $sql = "SELECT * FROM `test`, `make_quiz` 
            WHERE test.id = make_quiz.id_test 
            AND make_quiz.id_student = $_SESSION[usrid] 
            ORDER BY make_quiz.id DESC 
            LIMIT 1";  // Limit to the latest submission

    $r = mysqli_query($connection, $sql);
    $A = mysqli_fetch_assoc($r);

    // Check if the query fetched the data correctly
    if ($A === null) {
        echo json_encode(["error" => "No submission found for the student."]);
        exit;
    }

    // Student's answers are stored as a comma-separated string, we split them into an array
    $ans = explode(",", $A["student_answers"]);
    $AA = [];

    // Loop through each student answer and fetch the corresponding question and correct answer
    foreach ($ans as $aa) {
        if ($aa != "") {
            // Fetch the student's selected answer and the question it belongs to
            $sql = "SELECT answer.id, answer.text_of_answer, answer.true_false, exercise.vocalization, exercise.correct_answer 
                    FROM answer 
                    JOIN exercise ON answer.id_of_exercise = exercise.id 
                    WHERE answer.id = $aa";
            $r2 = mysqli_query($connection, $sql);
            $x = mysqli_fetch_assoc($r2);

            // If no answer found, skip this iteration
            if (!$x) continue;

            // Add correct answer feedback to the result
            $correctAnswerSql = "SELECT text_of_answer FROM answer WHERE id = " . $x['correct_answer'];
            $correctAnswerResult = mysqli_query($connection, $correctAnswerSql);
            $correctAnswer = mysqli_fetch_assoc($correctAnswerResult);

            // If no correct answer is found, provide a default feedback
            $x['feedback'] = $correctAnswer ? $correctAnswer['text_of_answer'] : "No correct answer available";
            $AA[] = $x;
        }
    }

    // Store the results in $A['qa']
    $A['qa'] = $AA;

    // Return the final response as JSON
    echo json_encode($A);
}*/

/*if ($_GET['c'] == "ssubmit") {
    // Fetch the test and the quiz submission for the current student
    $sql = "SELECT * FROM `test`, `make_quiz` 
            WHERE test.id = make_quiz.id_test 
            AND make_quiz.id_student = $_SESSION[usrid] 
            ORDER BY make_quiz.id DESC 
            LIMIT 1";  // Limit to the latest submission

    $r = mysqli_query($connection, $sql);
    $A = mysqli_fetch_assoc($r);

    // Student's answers are stored as a comma-separated string, we split them into an array
    $ans = explode(",", $A["student_answers"]);
    $AA = [];

    // Loop through each student answer and fetch the corresponding question and correct answer
    foreach ($ans as $aa) {
        if ($aa != "") {
            // Fetch the student's selected answer and the question it belongs to
            $sql = "SELECT answer.id, answer.text_of_answer, answer.true_false, exercise.vocalization, exercise.correct_answer 
                    FROM answer 
                    JOIN exercise ON answer.id_of_exercise = exercise.id 
                    WHERE answer.id = $aa";
            $r2 = mysqli_query($connection, $sql);
            $x = mysqli_fetch_assoc($r2);

            // Add correct answer feedback to the result
            $correctAnswerSql = "SELECT text_of_answer FROM answer WHERE id = " . $x['correct_answer'];
            $correctAnswerResult = mysqli_query($connection, $correctAnswerSql);
            $correctAnswer = mysqli_fetch_assoc($correctAnswerResult);

            // Append feedback and store it in $AA array
            $x['feedback'] = $correctAnswer['text_of_answer'];
            $AA[] = $x;
        }
    }

    // Store the results in $A['qa']
    $A['qa'] = $AA;

    // Return the final response as JSON
    echo json_encode($A);
}*/

if($_GET['c']=="stopquiz")
{
    $sql="select * from `make_quiz` where id_test=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}



/*if($_GET['c']=="sendres")
{

    try{
        $s=0;
        $a="";
        foreach ($_POST as $p)
        {
            $sql2="select * from answer where id='$p'";
            $r=mysqli_query($connection,$sql2);
            //$rr=$r->fetch_all(MYSQLI_ASSOC);
            $rr=mysqli_fetch_assoc($r);
            $a=$a.$p.",";
            if($rr["true_false"]==1)
            {
                $s++;

            }
        

     
        }
        $sql3="insert into make_quiz(id,id_student,id_test,start_time,end_time,student_answers,score)
        values(NULL,'$_SESSION[usrid]','$_GET[id]','$_GET[starttime]','$_GET[endtime]','$a',$s)";
        mysqli_query($connection,$sql3);
        
        echo "1";
    }
    catch(Exception $e)
    {
        echo "0";
    }
}*/
/*if ($_GET['c'] == "sendres") {

    try {
        $score = 0; // Initialize the score
        $answers = ""; // String to store all answer IDs
        $id_student = $_SESSION['usrid']; // Student ID
        $id_test = $_GET['id']; // Test ID
        $start_time = $_GET['starttime'];
        $end_time = $_GET['endtime'];

        foreach ($_POST as $key => $answerId) {
            // Ensure that the key matches the format of answer input (e.g., "aa<exerciseId>")
            if (strpos($key, 'aa') === 0) {
                // Get the answer details from the database
                $sql = "SELECT * FROM answer WHERE id='$answerId'";
                $result = mysqli_query($connection, $sql);
                $answerData = mysqli_fetch_assoc($result);

                // Append the answer ID to the list of answers
                $answers .= $answerId . ",";

                // Check if the answer is correct and increment the score if so
                if ($answerData && $answerData['true_false'] == 1) {
                    $score++;
                }
            }
        }

        // Insert the quiz attempt data into the database
        $sql_insert = "INSERT INTO make_quiz (id, id_student, id_test, start_time, end_time, student_answers, score)
                       VALUES (NULL, '$id_student', '$id_test', '$start_time', '$end_time', '$answers', $score)";
        mysqli_query($connection, $sql_insert);

        // Output success response
        echo "1";
    } catch (Exception $e) {
        // Output error response
        echo "0";
    }
}*/



/*if ($_GET['c'] == "sendres") {
    try {
        $score = 0;
        $answer_list = "";

        foreach ($_POST as $answer_id) {
            // Execute the query for each answer to retrieve its correctness
            $sql2 = "SELECT * FROM answer WHERE id='$answer_id'";
            $result = mysqli_query($connection, $sql2);
            
            if ($result) {
                $answer = mysqli_fetch_assoc($result);
                
                // Append answer ID to answer list
                $answer_list .= $answer_id . ",";
                
                // Increment score if the answer is correct
                if ($answer["true_false"] == 1) {
                    $score++;
                }
            }
        }

        // Insert quiz submission record with score and timing details
        $sql3 = "INSERT INTO make_quiz(id, id_student, id_test, start_time, end_time, student_answers, score)
                 VALUES (NULL, '$_SESSION[usrid]', '$_GET[id]', '$_GET[starttime]', '$_GET[endtime]', '$answer_list', $score)";
        
        // Execute the insert query and return success status
        if (mysqli_query($connection, $sql3)) {
            echo "1";
        } else {
            echo "Error: " . mysqli_error($connection);
        }
    } catch (Exception $e) {
        echo "0";
    }
}*/





// Fetch quiz statistics
/*if ($_GET['c'] == "stats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);
    if ($id_test <= 0) {
        echo json_encode(["error" => "Invalid quiz ID"]);
        exit;
    }

    $response = [];
    $query = "
    SELECT score, COUNT(id_student) AS student_count
    FROM make_quiz 
    WHERE id_test = $id_test
    GROUP BY score
    ORDER BY score ASC
    ";

    $result = mysqli_query($connection, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
    } else {
        echo json_encode(["error" => mysqli_error($connection)]);
        exit;
    }

    echo json_encode($response);
    exit;
}

// Fetch exercise statistics
if ($_GET['c'] == "exerstats" && isset($_GET['id_exercise'])) {
    $id_exercise = intval($_GET['id_exercise']);
    if ($id_exercise <= 0) {
        echo json_encode(["error" => "Invalid exercise ID"]);
        exit;
    }

    $response = [];
    $query = "
    SELECT scores.score, COALESCE(COUNT(me.exercise_score), 0) AS exercise_count
    FROM (SELECT 0 AS score UNION ALL
          SELECT 1 UNION ALL
          SELECT 2 UNION ALL
          SELECT 3 UNION ALL
          SELECT 4 UNION ALL
          SELECT 5 UNION ALL
          SELECT 6 UNION ALL
          SELECT 7 UNION ALL
          SELECT 8 UNION ALL
          SELECT 9 UNION ALL
          SELECT 10) AS scores
    LEFT JOIN make_exercise me ON scores.score = me.exercise_score AND me.id_exercise = $id_exercise
    GROUP BY scores.score
    ORDER BY scores.score ASC
    ";

    $result = mysqli_query($connection, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
    } else {
        echo json_encode(["error" => mysqli_error($connection)]);
        exit;
    }

    echo json_encode($response);
    exit;
}*/


   /*if($_GET['c'] == "stats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);  // Get and sanitize the quiz ID

    $A = [];
    
   
   // print_r($scores);
   
    $r = mysqli_query($connection, "
    SELECT scores.score, COALESCE(COUNT(mq.score), 0) AS student_count
    FROM (SELECT 0 AS score UNION ALL
            SELECT 1 UNION ALL
          SELECT 2 UNION ALL
          SELECT 3 UNION ALL
          SELECT 4 UNION ALL
          SELECT 5 UNION ALL
          SELECT 6 UNION ALL
          SELECT 7 UNION ALL
          SELECT 8 UNION ALL
          SELECT 9 UNION ALL
          SELECT 10) AS scores
    LEFT JOIN make_quiz mq ON scores.score = mq.score AND mq.id_test = $id_test  -- Filter by id_test
    GROUP BY scores.score
    ORDER BY scores.score
    ");

    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the first query: " . mysqli_error($connection);
    }
  //  json_encode($scores);
    echo json_encode($A);
}*/

/*if($_GET['c'] == "exerstats" && isset($_GET['id_exercise'])) {
    $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
    $exercise_score = 0; // Initialize the score
    $id_student = $_SESSION['usrid']; // Student ID
   //  $id_exercise = $_GET['id_exercise']; // Test ID
    $answersArray = []; // Array to temporarily store answers before sorting
    $A = [];
    // Build answers string and calculate score
 $answers = "";
 // Sort answers by exercise ID in ascending order
 ksort($answersArray);
 
    foreach ($_POST as $key => $answerId) {
        if (strpos($key, 'aa') === 0) {
            // Extract exercise ID from the key (e.g., "aa<exerciseId>")
            $exerciseId = str_replace('aa', '', $key);
            $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID

            
        }

        $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);
    // Append the answer ID to the list of answers
     $answers .= $answerId . ",";
    
    // Increment score if the answer is correct
    if ($answerData && $answerData['true_false'] == 1) {
        $exercise_score++;
    } }
     
 
    $sql_insert = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
    VALUES (NULL,  '$id_student', '$id_exercise',  '$answers', $exercise_score)";
mysqli_query($connection, $sql_insert);

// Output success response
//echo "1";
    $r = mysqli_query($connection, "
    SELECT scores.score, COALESCE(COUNT(me.exercise_score), 0) AS exercise_count
    FROM (SELECT 0 AS score UNION ALL
            SELECT 1 UNION ALL
          SELECT 2 UNION ALL
          SELECT 3 UNION ALL
          SELECT 4 UNION ALL
          SELECT 5 UNION ALL
          SELECT 6 UNION ALL
          SELECT 7 UNION ALL
          SELECT 8 UNION ALL
          SELECT 9 UNION ALL
          SELECT 10) AS scores
    LEFT JOIN make_exercise me ON scores.score = me.exercise_score AND  
   me.id = $id_exercise  -- Filter by id
    GROUP BY scores.score
    ORDER BY scores.score
    ");

    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    echo json_encode($A);
}*/





/*if($_GET['c'] == "exerstats" && isset($_GET['id_exercise'])) {
    $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
    $exercise_score = 0; // Initialize the score
    $id_student = $_SESSION['usrid']; // Student ID
   //  $id_exercise = $_GET['id_exercise']; // Test ID
    $answersArray = []; // Array to temporarily store answers before sorting
    $A = [];
    // Build answers string and calculate score
 $answers = "";
 // Sort answers by exercise ID in ascending order
 ksort($answersArray);
 
    foreach ($_POST as $key => $answerId) {
        if (strpos($key, 'aa') === 0) {
            // Extract exercise ID from the key (e.g., "aa<exerciseId>")
            $exerciseId = str_replace('aa', '', $key);
            $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID

            
        }

        $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);
    // Append the answer ID to the list of answers
     $answers .= $answerId . ",";
    
    // Increment score if the answer is correct
    if ($answerData && $answerData['true_false'] == 1) {
        $exercise_score++;
    } }
     
 
    $sql_insert = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
    VALUES (NULL,  '$id_student', '$id_exercise',  '$answers', $exercise_score)";
mysqli_query($connection, $sql_insert);

// Output success response
//echo "1";
    $r = mysqli_query($connection, "
    SELECT scores.score, COALESCE(COUNT(me.exercise_score), 0) AS exercise_count
    FROM (SELECT 0 AS score UNION ALL
            SELECT 1 UNION ALL
          SELECT 2 UNION ALL
          SELECT 3 UNION ALL
          SELECT 4 UNION ALL
          SELECT 5 UNION ALL
          SELECT 6 UNION ALL
          SELECT 7 UNION ALL
          SELECT 8 UNION ALL
          SELECT 9 UNION ALL
          SELECT 10) AS scores
    LEFT JOIN make_exercise me ON scores.score = me.exercise_score AND  
   me.id = $id_exercise  -- Filter by id
    GROUP BY scores.score
    ORDER BY scores.score
    ");

    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    echo json_encode($A);
}*/



































/*if ($_GET['c'] == "sendres") {

    try {
        $score = 0; // Initialize the score
        $answersArray = []; // Array to temporarily store answers before sorting
        $id_student = $_SESSION['usrid']; // Student ID
        $id_test = $_GET['id']; // Test ID
      //  $exercise_score = 0; // Initialize the score
        $start_time = $_GET['starttime'];
        $end_time = $_GET['endtime'];
       
       // $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
       // $id_exercise = $_GET['id_exercise']; // Test ID
        // Collect all answers in an array with exercise ID as the key
        foreach ($_POST as $key => $answerId) {
            if (strpos($key, 'aa') === 0) {
                // Extract exercise ID from the key (e.g., "aa<exerciseId>")
                $exerciseId = str_replace('aa', '', $key);
                $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID
            }
        }

        // Sort answers by exercise ID in ascending order
        ksort($answersArray);
        $total_score = 0;
        // Build answers string and calculate score
        $answers = "";
        foreach ($answersArray as $exerciseId => $answerId) {
             $id_student = $_SESSION['usrid']; // Student ID
            // Query to check if answer is correct
           // $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
           $sql = "SELECT a.true_false, e.points 
                                 FROM answer a
                                 JOIN exercise e ON e.id = a.id_of_exercise
                                 WHERE a.id = '$answerId'  ";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);

            // Append the answer ID to the list of answers
            $answers .= $answerId . ",";

          
            if ($answerData) {
                $id_student = $_SESSION['usrid']; // Student ID
                $isCorrect = $answerData['true_false'];
                $score = $answerData['points'];
                $exercise_score = 0;
             //   $exercise_score=0;
                if ($isCorrect == 1) {
                    $exercise_score = $score; // Add points to the total score
                    $total_score += $exercise_score;
                    //$score += $exercise_score; // Add points to the total score
                }

                // Insert data into make_exercise table
                $sql = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
                                        VALUES (NULL, '$id_student', '$exerciseId', '$answerId', $exercise_score)";
                mysqli_query($connection, $sql);
            }
        }

        // Insert the quiz attempt data into the database
        $sql_insert = "INSERT INTO make_quiz (id, id_student, id_test, start_time, end_time, student_answers, score)
                       VALUES (NULL, '$id_student', '$id_test', '$start_time', '$end_time', '$answers', $total_score)";
        mysqli_query($connection, $sql_insert);

   
mysqli_query($connection, $sql_insert);
//mysqli_query($connection, $sql);

        // Output success response
        echo "1";
    } 
    

catch (Exception $e) {
        // Output error response
        echo "0";
    }

}*/

if ($_GET['c'] == "sendres") {

    try {
        $score = 0; // Initialize the score
        $answersArray = []; // Array to temporarily store answers before sorting
        $id_student = $_SESSION['usrid']; // Student ID
        $id_test = $_GET['id']; // Test ID
      //  $exercise_score = 0; // Initialize the score
        $start_time = $_GET['starttime'];
        $end_time = $_GET['endtime'];
       
       // $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
       // $id_exercise = $_GET['id_exercise']; // Test ID
        // Collect all answers in an array with exercise ID as the key
        foreach ($_POST as $key => $answerId) {
            if (strpos($key, 'aa') === 0) {
                // Extract exercise ID from the key (e.g., "aa<exerciseId>")
                $exerciseId = str_replace('aa', '', $key);
                $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID
            }
        }

        // Sort answers by exercise ID in ascending order
        ksort($answersArray);

        // Build answers string and calculate score
        $answers = "";
        $total_score = 0;
        foreach ($answersArray as $exerciseId => $answerId) {
             $id_student = $_SESSION['usrid']; // Student ID
            // Query to check if answer is correct
           // $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
           $sql = "SELECT a.true_false, e.points 
                                 FROM answer a
                                 JOIN exercise e ON e.id = a.id_of_exercise
                                 WHERE a.id = '$answerId'  ";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);

            // Append the answer ID to the list of answers
            $answers .= $answerId . ",";

            // Increment score if the answer is correct
           /* if ($answerData && $answerData['true_false'] == 1) {
                //$sql2 = "SELECT * FROM exercise WHERE id='$exerciseId'";
              //  $result = mysqli_query($connection, $sql2);
              
              //  if ($result) {
              //      $answer = mysqli_fetch_assoc($result);
               // $score=$exercise["points"];
               $exercise_score=$exercise["points"];
               $score++;
               $sql = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
        VALUES (NULL, '$id_student', '$id_exercise',  '$answers', $exercise_score)";
               // $exercise_score= $exercise['points'];
            }*/
            if ($answerData) {
                $id_student = $_SESSION['usrid']; // Student ID
                $isCorrect = $answerData['true_false'];
                $score = $answerData['points'];
                $exercise_score = 0;

             //   $exercise_score=0;
                if ($isCorrect == 1) {
                    $exercise_score = $score; // Add points to the total score
                    $total_score += $exercise_score;
                }

                // Insert data into make_exercise table
                $sql = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
                                        VALUES (NULL, '$id_student', '$exerciseId', '$answerId', $exercise_score)";
                mysqli_query($connection, $sql);
            }
        }

        // Insert the quiz attempt data into the database
        $sql_insert = "INSERT INTO make_quiz (id, id_student, id_test, start_time, end_time, student_answers, score)
                       VALUES (NULL, '$id_student', '$id_test', '$start_time', '$end_time', '$answers', $total_score)";
        mysqli_query($connection, $sql_insert);

   
// mysqli_query($connection, $sql_insert);
//mysqli_query($connection, $sql);

        // Output success response
        echo "1";
    } 
    

catch (Exception $e) {
        // Output error response
        echo "0";
    }

}
















/*if ($_GET['c'] == "sendres") {

    try {
        $score = 0; // Initialize the score
        $answersArray = []; // Array to temporarily store answers before sorting
        $id_student = $_SESSION['usrid']; // Student ID
        $id_test = $_GET['id']; // Test ID
        $exercise_score = 0; // Initialize the score
        $start_time = $_GET['starttime'];
        $end_time = $_GET['endtime'];
       
       // $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
       // $id_exercise = $_GET['id_exercise']; // Test ID
        // Collect all answers in an array with exercise ID as the key
        foreach ($_POST as $key => $answerId) {
            if (strpos($key, 'aa') === 0) {
                // Extract exercise ID from the key (e.g., "aa<exerciseId>")
                $exerciseId = str_replace('aa', '', $key);
                $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID
            }
        }

        // Sort answers by exercise ID in ascending order
        ksort($answersArray);

        // Build answers string and calculate score
        $answers = "";
        foreach ($answersArray as $exerciseId => $answerId) {
            // Query to check if answer is correct
            $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);

            // Append the answer ID to the list of answers
            $answers .= $answerId . ",";

            // Increment score if the answer is correct
            if ($answerData && $answerData['true_false'] == 1) {
                //$sql2 = "SELECT * FROM exercise WHERE id='$exerciseId'";
              //  $result = mysqli_query($connection, $sql2);
              
              //  if ($result) {
              //      $answer = mysqli_fetch_assoc($result);
               // $score=$exercise["points"];
               $exercise_score=$exercise["points"];
               $score++;
               $sql = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
        VALUES (NULL, '$id_student', '$id_exercise',  '$answers', $exercise_score)";
               // $exercise_score= $exercise['points'];
            }
        }

        // Insert the quiz attempt data into the database
        $sql_insert = "INSERT INTO make_quiz (id, id_student, id_test, start_time, end_time, student_answers, score)
                       VALUES (NULL, '$id_student', '$id_test', '$start_time', '$end_time', '$answers', $score)";
        mysqli_query($connection, $sql_insert);

   
mysqli_query($connection, $sql_insert);
mysqli_query($connection, $sql);

        // Output success response
        echo "1";
    } 
    

catch (Exception $e) {
        // Output error response
        echo "0";
    }

}*/


































/*if ($_GET['c'] == "sendres") {

    try {
        $score = 0; // Initialize the score
        $answersArray = []; // Array to temporarily store answers before sorting
        $id_student = $_SESSION['usrid']; // Student ID
        $id_test = $_GET['id']; // Test ID
        $exercise_score = 0; // Initialize the score
        $start_time = $_GET['starttime'];
        $end_time = $_GET['endtime'];
       
       // $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
       // $id_exercise = $_GET['id_exercise']; // Test ID
        // Collect all answers in an array with exercise ID as the key
        foreach ($_POST as $key => $answerId) {
            if (strpos($key, 'aa') === 0) {
                // Extract exercise ID from the key (e.g., "aa<exerciseId>")
                $exerciseId = str_replace('aa', '', $key);
                $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID
            }
        }

        // Sort answers by exercise ID in ascending order
        ksort($answersArray);

        // Build answers string and calculate score
        $answers = "";
        foreach ($answersArray as $exerciseId => $answerId) {
            // Query to check if answer is correct
            $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);

            // Append the answer ID to the list of answers
            $answers .= $answerId . ",";

            // Increment score if the answer is correct
            if ($answerData && $answerData['true_false'] == 1) {
               // $sql2 = "SELECT * FROM exercise WHERE id='$exerciseId'";
               // $result = mysqli_query($connection, $sql2);
                
               // if ($result) {
                 //   $answer = mysqli_fetch_assoc($result);
               // $score=$exercise["points"];
               $score++;
               // $exercise_score= $exercise['points'];
            }
        }

        // Insert the quiz attempt data into the database
        $sql_insert = "INSERT INTO make_quiz (id, id_student, id_test, start_time, end_time, student_answers, score)
                       VALUES (NULL, '$id_student', '$id_test', '$start_time', '$end_time', '$answers', $score)";
        mysqli_query($connection, $sql_insert);

     

        // Output success response
        echo "1";
    } 
    

catch (Exception $e) {
        // Output error response
        echo "0";
    }

}*/














if($_GET['c'] == "stats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);  // Get and sanitize the quiz ID

    $A = [];
    
   
   // print_r($scores);
   $r = mysqli_query($connection, "
   SELECT scores.score, COALESCE(COUNT(mq.score), 0) AS student_count
   FROM (SELECT 0 AS score UNION ALL
           SELECT 1 UNION ALL
         SELECT 2 UNION ALL
         SELECT 3 UNION ALL
         SELECT 4 UNION ALL
         SELECT 5 UNION ALL
         SELECT 6 UNION ALL
         SELECT 7 UNION ALL
         SELECT 8 UNION ALL
         SELECT 9 UNION ALL
         SELECT 10) AS scores
   LEFT JOIN make_quiz mq ON scores.score = mq.score AND  
  mq.id_test = $id_test  -- Filter by id
   GROUP BY scores.score
   ORDER BY scores.score
   ");
   /* $r = mysqli_query($connection, "
    SELECT score, COUNT(id_student) AS student_count
    FROM make_quiz 
    GROUP BY score
    ORDER BY score
    ");*/
//$sumstudents=0;
$totalScore=0;
$totalTries=0;
$successfulStudents=0;
//$result = mysqli_query($connection, "SELECT points FROM exercise WHERE id = $id_exercise");
//if ($row = mysqli_fetch_assoc($result)) {
  //  $exercise_points = $row['points'];
//}
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
            //$sumStudents += $rr['student_count']
            $totalTries += $rr['student_count'];
            $totalScore += ( $rr['score'] * $rr['student_count']); // Weighted sum of scores ;

            if ($rr['score'] >=5){
                $successfulStudents += $rr['student_count'];
            }
        }
    } else {
        echo "Error with the first query: " . mysqli_error($connection);
    }
    $averageScore = $totalTries > 0 ? round($totalScore / $totalTries, 2) : 0;
    $successRate = $totalTries > 0 ? round(($successfulStudents / $totalTries) * 100, 2) : 0;

   echo json_encode(["data" => $A, "totalTries" => $totalTries, "averageScore" => $averageScore, "successfulStudents" => $successfulStudents,"successRate" => $successRate]);
  //  json_encode($scores);
    //echo json_encode($A);
}

/*if($_GET['c'] == "exerstats" && isset($_GET['id_exercise'])) {
    $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID
   // $exercise_score = 0; // Initialize the score
  //  $id_student = $_SESSION['usrid']; // Student ID
   //  $id_exercise = $_GET['id_exercise']; // Test ID
    //$answersArray = []; // Array to temporarily store answers before sorting
    $A = [];
      // Get the points for the exercise
      $exercise_points = 0;
    
      $result = mysqli_query($connection, "SELECT points FROM exercise WHERE id = $id_exercise");
      if ($row = mysqli_fetch_assoc($result)) {
          $exercise_points = $row['points'];
      }
    // Build answers string and calculate score
 //$answers = "";
 // Sort answers by exercise ID in ascending order
 //ksort($answersArray);
 
  /*  foreach ($_POST as $key => $answerId) {
        if (strpos($key, 'aa') === 0) {
            // Extract exercise ID from the key (e.g., "aa<exerciseId>")
            $exerciseId = str_replace('aa', '', $key);
            $answersArray[$exerciseId] = $answerId; // Store in array by exercise ID

            
        }

        $sql = "SELECT true_false FROM answer WHERE id='$answerId'";
            $result = mysqli_query($connection, $sql);
            $answerData = mysqli_fetch_assoc($result);
    // Append the answer ID to the list of answers
     $answers .= $answerId . ",";
    
    // Increment score if the answer is correct
    if ($answerData && $answerData['true_false'] == 1) {
        $exercise_score++;
    } }
     
 
    $sql_insert = "INSERT INTO make_exercise (id, id_student, id_exercise, exercise_answer, exercise_score)
    VALUES (NULL,  '$id_student', '$id_exercise',  '$answers', $exercise_score)";
mysqli_query($connection, $sql_insert);*/

// Output success response
//echo "1";

  /*  $r = mysqli_query($connection, "
    SELECT scores.score, COALESCE(COUNT(me.exercise_score), 0) AS exercise_count
    FROM (SELECT 0 AS score UNION ALL
            SELECT 1 UNION ALL
          SELECT 2 UNION ALL
          SELECT 3 UNION ALL
          SELECT 4 UNION ALL
          SELECT 5 UNION ALL
          SELECT 6 UNION ALL
          SELECT 7 UNION ALL
          SELECT 8 UNION ALL
          SELECT 9 UNION ALL
          SELECT 10) AS scores
    LEFT JOIN make_exercise me ON scores.score = me.exercise_score AND  
   me.id_exercise = $id_exercise  -- Filter by id
    GROUP BY scores.score
    ORDER BY scores.score
    ");
    $totalScore1=0;
    $totalTries1=0;
    $successfulStudents1=0;
    $successRate1=0;
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
            $totalTries1 += $rr['exercise_count'];
            $totalScore1 += ( $rr['score'] * $rr['exercise_count']); // Weighted sum of scores ;

           /* if ($rr['score'] = $rr['exercise_count'] ){
              //  $successfulStudents1 += 1;
                $successfulStudents1 += $rr['exercise_count'];
            }*/
             // Track successful students (those who got full points)
           /*  if ($rr['score'] == $exercise_points) {
                $successfulStudents1 += $rr['exercise_count'];
            }
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }
    $averageScore1 = $totalTries1 > 0 ? round($totalScore1 / $totalTries1, 2) : 0;
    $successRate1 = $totalTries1 > 0 ? round(($successfulStudents1 / $totalTries1) * 100, 2) : 0;

    echo json_encode(["data" => $A, "totalTries1" => $totalTries1, "averageScore1" => $averageScore1, "successfulStudents1"=> $successfulStudents1, "successRate1" => $successRate1]);

  //  echo json_encode($A);
}*/

/*if($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);  // Get and sanitize the quiz ID
    $usr_id = $_SESSION['usrid'];
    $A = [];
 //   $totalscore=0;
     // COUNT(*) AS student_count,  SUM(make_quiz.score) AS total_score 
    $r = mysqli_query($connection, "
      SELECT DISTINCT exercise.vocalization, 
      make_exercise.exercise_score,
       SUM(make_exercise.exercise_score) AS total_score,
               make_quiz.score AS total_score
        FROM 
            make_exercise
        INNER JOIN 
            exercise ON make_exercise.id_exercise = exercise.id
        INNER JOIN 
            make_quiz ON make_quiz.id_test = exercise.id_test AND make_quiz.id_student = $usr_id
        WHERE 
            make_quiz.id_test = $id_test
  GROUP BY 
        exercise.vocalization, make_quiz.score
");
/*    SELECT
           exercise.vocalization,
            make_quiz.score,  
            COUNT(*) AS student_count, 
            SUM(make_quiz.score) AS total_score,
          
        FROM 
            make_quiz
        INNER JOIN 
            exercise ON exercise.id_test = make_quiz.id_test
        WHERE 
            make_quiz.id_test = $id_test
            AND make_quiz.id_student = $usr_id
        GROUP BY 
            make_quiz.id_test*/
 /*   //AVG(make_quiz.score) AS average_score
 SELECT DISTINCT , 
               make_quiz.score
        FROM 
            make_exercise
        INNER JOIN 
            exercise ON make_exercise.id_exercise = exercise.id
        INNER JOIN 
            make_quiz ON make_quiz.id_test = exercise.id_test AND make_quiz.id_student = $usr_id
        WHERE 
            make_quiz.id_test = $id_test*/
    /* SELECT exercise.vocalization, 
     make_quiz.score,
    make_exercise.exercise_score
    FROM 
       make_exercise
    INNER JOIN 
        exercise ON make_exercise.id_exercise = exercise.id
        INNER JOIN 
        make_quiz ON make_quiz.id_test= exercise.id_test AND make_quiz.id_student = $usr_id
        WHERE 
      make_quiz.id_test = $id_test*/
    /*if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
           // $totalscore +=  $rr['score'] ; // Weighted sum of scores 
        }
   
    }
    else {
        echo "Error with the query: " . mysqli_error($connection);
    }
   //echo json_encode(["data" => $A]);
    // Calculate the total score for the selected quiz
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['total_score']; // Add individual exercise scores to get the total quiz score
    }

    // Return the data along with the total quiz score
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);

}*/


if ($_GET['c'] == "exerstats" && isset($_GET['id_exercise'])) {
    $id_exercise = intval($_GET['id_exercise']);  // Get and sanitize the exercise ID

    // Initialize counters for correct, false, and unanswered answers
    $correct = 0;
    $false = 0;
    $unanswered = 0;
    $totalTries1 = 0;

    // Query to count answers based on their correctness and answered status
    $r = mysqli_query($connection, "
    SELECT
        SUM(CASE WHEN me.exercise_score = exercise.points THEN 1 ELSE 0 END) AS correct_answers,
        SUM(CASE WHEN me.exercise_score = 0 THEN 1 ELSE 0 END) AS false_answers,
        SUM(CASE WHEN me.exercise_score IS NULL THEN 1 ELSE 0 END) AS unanswered_answers
    FROM make_exercise me
    INNER JOIN exercise ON me.id_exercise=exercise.id
    WHERE me.id_exercise = $id_exercise
    ");

    if ($r) {
        $row = mysqli_fetch_assoc($r);
        $correct = $row['correct_answers'];
        $false = $row['false_answers'];
        $unanswered = $row['unanswered_answers'];
        $totalTries1 = $correct + $false + $unanswered;
    }

    // Calculate the percentages for each category
    $correctPercentage = $totalTries1 > 0 ? round(($correct / $totalTries1) * 100, 2) : 0;
    $falsePercentage = $totalTries1 > 0 ? round(($false / $totalTries1) * 100, 2) : 0;
    $unansweredPercentage = $totalTries1 > 0 ? round(($unanswered / $totalTries1) * 100, 2) : 0;

    echo json_encode([
        "correct" => $correct,
        "false" => $false,
        "unanswered" => $unanswered,
        "correctPercentage" => $correctPercentage,
        "falsePercentage" => $falsePercentage,
        "unansweredPercentage" => $unansweredPercentage,
        "totalTries1" => $totalTries1
    ]);
}



/*if($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);  // Get and sanitize the quiz ID
    $usr_id = $_SESSION['usrid'];
    $A = [];
 //   $totalscore=0;
     // COUNT(*) AS student_count,  SUM(make_quiz.score) AS total_score 
    $r = mysqli_query($connection, "
      SELECT DISTINCT exercise.vocalization, 
      make_exercise.exercise_score,
     SUM( make_exercise.exercise_score) AS total_score
        FROM 
            make_exercise
        INNER JOIN 
            exercise ON make_exercise.id_exercise = exercise.id AND make_exercise.id_student = $usr_id
        WHERE 
            exercise.id_test = $id_test
  GROUP BY 
        exercise.vocalization, make_exercise.exercise_score
");

    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            if ($rr['exercise_score'] == 0) {
                $rr['exercise_score'] = 0; // explicitly set to 0 if false
            }
            $A[] = $rr;
           // $totalscore +=  $rr['score'] ; // Weighted sum of scores 
        }
   
    }
    else {
        echo "Error with the query: " . mysqli_error($connection);
    }
   //echo json_encode(["data" => $A]);
    // Calculate the total score for the selected quiz
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['total_score']; // Add individual exercise scores to get the total quiz score
    }

    // Return the data along with the total quiz score
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);

}*/

/*if($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);  // Get and sanitize the quiz ID
    $usr_id = $_SESSION['usrid'];
    $A = [];
 //   $totalscore=0;
     // COUNT(*) AS student_count,  SUM(make_quiz.score) AS total_score 
     //  SUM(IFNULL(make_exercise.exercise_score)) AS total_score
     //       IFNULL(make_exercise.exercise_score, 0) AS exercise_score,  -- Return 0 if the score is null
 //make_exercise.exercise_score,
 //            SUM(make_exercise.exercise_score) AS total_score
    $r = mysqli_query($connection, "
      SELECT DISTINCT exercise.vocalization, 
     make_exercise.exercise_score AS total_score
        FROM 
            make_exercise
        INNER JOIN 
            exercise ON make_exercise.id_exercise = exercise.id AND make_exercise.id_student = $usr_id
        WHERE 
            exercise.id_test = $id_test  
 GROUP BY exercise.vocalization, make_exercise.exercise_score
");
// AND make_exercise.id_student = $usr_id
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
           
            $A[] = $rr;
           // $totalscore +=  $rr['score'] ; // Weighted sum of scores 
        }
   
    }
    else {
        echo "Error with the query: " . mysqli_error($connection);
    }
   //echo json_encode(["data" => $A]);
    // Calculate the total score for the selected quiz
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['total_score']; // Add individual exercise scores to get the total quiz score
    }

    // Return the data along with the total quiz score
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);

}*/
/*if ($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);  // Get and sanitize the quiz ID
    $usr_id = $_SESSION['usrid'];
    $A = [];

    // Query to fetch unique exercises and their scores
    $r = mysqli_query($connection, "
        SELECT exercise.vocalization, 
               IFNULL(make_exercise.exercise_score, 0) AS total_score
        FROM make_exercise
        INNER JOIN exercise ON make_exercise.id_exercise = exercise.id
        WHERE make_exercise.id_student = $usr_id
        AND exercise.id_test = $id_test
        GROUP BY exercise.vocalization, make_exercise.exercise_score
    ");

    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    // Calculate the total score for the selected quiz
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['total_score']; // Sum up exercise scores
    }

    // Return the data along with the total score
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);
}
*/
/*if($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);
    $usr_id = $_SESSION['usrid'];
    $A = [];
             
  //COALESCE(make_exercise.exercise_score, 0) AS exercise_score
    $r = mysqli_query($connection, "
      SELECT exercise.vocalization, 
             IFNULL(make_exercise.exercise_score, 0) AS exercise_score
        FROM make_exercise
        INNER JOIN exercise ON make_exercise.id_exercise = exercise.id AND make_exercise.id_student = $usr_id
        WHERE exercise.id_test = $id_test
    ");
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    // Calculate total score
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['exercise_score']; // Sum of exercise scores
    }

    // Return response
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);
}*/
if($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);
    $usr_id = $_SESSION['usrid'];
    $A = [];
             
  //COALESCE(make_exercise.exercise_score, 0) AS exercise_score
    $r = mysqli_query($connection, "
      SELECT exercise.vocalization, 
             IFNULL(make_exercise.exercise_score, 0) AS exercise_score
        FROM exercise
        LEFT JOIN make_exercise ON make_exercise.id_exercise = exercise.id AND make_exercise.id_student = $usr_id
        WHERE exercise.id_test = $id_test
    ");
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    // Calculate total score
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['exercise_score']; // Sum of exercise scores
    }

    // Return response
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);
}
/*if ($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);
    $usr_id = $_SESSION['usrid'];
    $A = [];

    // Query to fetch the exercises and the student's actual score for each exercise
    $r = mysqli_query($connection, "
      SELECT exercise.vocalization, 
             COALESCE(make_exercise.exercise_score, 0) AS exercise_score
        FROM make_exercise
        INNER JOIN exercise ON make_exercise.id_exercise = exercise.id 
        WHERE make_exercise.id_student = $usr_id AND exercise.id_test = $id_test
    ");
    
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    // Calculate total score for the quiz based on the student's actual scores for each exercise
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        $total_quiz_score += $exercise['exercise_score'];  // Add the student's score for each exercise
    }

    // Return the response with the data and the total score
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);
}
*/
/*if($_GET['c'] == "mystats" && isset($_GET['id_test'])) {
    $id_test = intval($_GET['id_test']);
    $usr_id = $_SESSION['usrid'];
    $A = [];

    $r = mysqli_query($connection, "
      SELECT DISTINCT exercise.vocalization, 
        make_exercise.exercise_score AS exercise_score,
        FROM make_exercise
        INNER JOIN exercise ON make_exercise.id_exercise = exercise.id AND make_exercise.id_student = $usr_id
        WHERE exercise.id_test = $id_test
    ");
    if ($r) {
        while ($rr = mysqli_fetch_assoc($r)) {
            $A[] = $rr;
        }
    } else {
        echo "Error with the query: " . mysqli_error($connection);
    }

    // Calculate total score
    $total_quiz_score = 0;
    foreach ($A as $exercise) {
        if($exercise['exercise_score']==0){
           $total_quiz_score= $exercise['exercise_score']=0;
        }
        else{

        
        $total_quiz_score += $exercise['exercise_score']; // Sum of exercise scores
    }}

    // Return response
    echo json_encode(["data" => $A, "total_score" => $total_quiz_score]);
} */