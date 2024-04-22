<?php
session_start();
$connection= mysqli_connect("localhost", "root","","dbsf2");
mysqli_query($connection,"set names 'utf8' ");



if($_GET['c']=="signup")
{

  $sql="INSERT INTO `professor` (`id`, `email`, `password`, `firstname`, `lastname`, `id_lesson`) VALUES 
  (NULL, '$_POST[email]', '$_POST[password]', '$_POST[firstname]', '$_POST[lastname]', NULL)";
    

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





if ($_GET['c']=="allcategories"){
    $sql="select * from `lesson` ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if($_GET['c']=="newquiz")
{
    $sql="INSERT INTO `test` 
     (`id`, `id_professor`, `id_lesson`, `total_time`, `date_of_creation`, `title`) 
     VALUES (NULL,'$_SESSION[usrid]', '$_GET[id]', '$_POST[total_time]',
      '$_POST[date_of_creation]', '$_POST[test]' )" ;


    $r=mysqli_query($connection,$sql);
   

    echo "ok";
}



if($_GET['c']=="allquiz")
{
    $sql="select * from `test`" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
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

if ($_GET['c']=="onequiz"){
    $sql="select * from `test` where id=$_GET[id] ";
    
      
  
      $r=mysqli_query($connection,$sql);
      $A=$r->fetch_all(MYSQLI_ASSOC);
      echo json_encode($A);     

}

if($_GET['c']=="studentquiz")
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
}
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

if($_GET['c']=="showex")
{
    $sql="select * from `exercise` where id_test=$_GET[id]" ;

    $r=mysqli_query($connection,$sql);
    $A=$r->fetch_all(MYSQLI_ASSOC);

    echo json_encode($A);
}

if($_GET['c']=="allanswers")
{
    $sql="select * from `answer`" ;

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