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
        <li><a href="professor_quiz.php">Τα quiz μου</a></li>
        <li><a href="#">Βαθμοί μαθητών</a></li>
        <li><a href="#">Στατιστικά επιτυχίας κάθε άσκησης </a></li>

<?php
    }
    ?>

<?php
    if($_SESSION['typeuser']=="student")
    {
?>


        
        <li><a href="student_quiz.php">Quiz</a></li>
        <li><a href="#">Βαθμοί</a></li>
         <li><a href="#">Page 3</a></li>

<?php
    }
    ?>
      </ul>
      <ul class="nav navbar-nav navbar-right">
      
        <li><a href="Logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </div>
  </nav>