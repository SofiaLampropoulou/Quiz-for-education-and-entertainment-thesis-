
<?php
include "header.php";
?>

<?php
include "menu.php";
?>
<body>

<div class="container">

 <h1>Quiz</h1>
 <div class="othoni">

        
   
  
        <table class="table table-hover">
        <tr><th>Τίτλος</th><th>Συνολικός χρόνος σε λεπτά</th><th>Ημερομηνία δημιουργίας</th></tr>
            <tbody id="squiz">
            </tbody>
        </table>
    </div>
    </div>
</div>


        </body>
        <script>
       


        function showstudentquizes(){
            id=<?php echo $_GET['id'];?>;
            
            $.getJSON("api.php?c=allstudentquiz&id="+id,(res)=>{
                $("#squiz").html("");
                res.forEach(res => {
                const completedopen = res.completed ? "Άνοιγμα" : "Ανενεργό";
                const completedclass = res.completed ? "btn-success" : "btn-secondary";
              
           
                $("#squiz").append(`<tr><td>${res.title}</td><td>${res.total_time}</td><td>${res.date_of_creation}</td>
                <button onclick="togglecompleted(${res.id}, ${res.completed})"
                                    class="btn ${completedclass}" id="completed-btn-${res.id}">${completedopen}
                            </button></td></tr>
                `)
            });
            });
     
        }
     
        function togglecompleted(id, currentcompleted) {
           // $currentVisibility = $_GET['visibility'];
            const newcompleted = currentcompleted ? 0 : 1;
        $.get("api.php?c=toggle_completed&id=" + id + "&completed=" + newcompleted, (res) => {
            const result = JSON.parse(res);
            if (result.status === "success") {
                // Update the button text and style based on the new visibility status
               // const newVisibility = result.new_visibility;
                const button = $("#completed-btn-" + id);
                if (newcompleted === 1) {
                    button.text("Άνοιγμα").removeClass("btn-secondary").addClass("btn-success");
                } else {
                    button.text("Κλείσιμο").removeClass("btn-success").addClass("btn-secondary");
                }
                 // Update the `onclick` attribute with the new visibility state
            button.attr("onclick", `togglecompleted(${id}, ${result.new_completed})`);
            } else {
                alert("Failed to update completed. Please try again.");
            }
        });
    }



        showstudentquizes();
          </script>