<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
      <?php
    if($_SESSION['typeuser']=="admin")
    {
?>
        <li><a href="diaxeirisi_grammateias.php">Διαχείρηση γραμματείας</a></li>
        <li><a href="diaxeirisi_kathigiton.php">Διαχείρηση καθηγητών</a></li>
        <li><a href="diaxeirisi_mathiton.php">Διαχείρηση μαθητών</a></li>
     
<?php
 
    }
    ?>

<?php
    if($_SESSION['typeuser']=="professor")
    {
?>


        
        <li><a href="diaxeirisi_mathiton.php">Διαχείρηση μαθητών</a></li>
        <li><a href="professor_mathimata.php">Τα μαθήματά μου</a></li> 
        <li><a href="professor_quiz1.php">Τα quiz μου</a></li>
        <li><a href="professor_stats5.php">Στατιστικά </a></li>
           

<?php 
    }
    ?>

<?php
    if($_SESSION['typeuser']=="student")
    {
?>


<li><a href="student_courses.php">Courses</a></li>
<li><a href="student_mycourses.php">MyCourses</a></li>
<li><a href="student_stats2.php">Στατιστικά</a></li>

       
<?php

    }
    ?>
    
  

 



      </ul>
      <ul class="nav navbar-nav navbar-right">

        <!-- Display email and typeuser -->
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> 
          <?php 
            echo htmlspecialchars($_SESSION['email']); // Display the email safely
            echo " (" . htmlspecialchars($_SESSION['typeuser']) . ")"; // Display typeuser
          ?>
        </a></li>

        <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Αποσύνδεση</a></li>
      </ul>
    </div>
  </div>
  </nav>