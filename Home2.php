<?php
include 'header2.php';
include 'navbar2.php';
?>

<body>
    <div class="container">
        <img src="http://www.one.org.ma/FR/Projet_Simulation/img/Logo_crc.jpg" class='first' alt='img1' />
        <img src="http://www.one.org.ma/FR/Projet_Simulation/img/onee-logo.png" class="second" alt='logo' />

        
    </div>

    <div class="container2">
        <h1>Facture d'électricité simulée	</h1>
            <h1>فـاتـورة الـكـهـربـاء</h1>
           
        </div>
       


        <?php
            $ancienErr = $nouveauErr = $select1Err = $filErr = "";
            $ancien = $nouveau = $select1 = $fil = "";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
                  if(empty($_POST["ancien"])) {
                      $ancienErr = "Name is Required";
                  }
                  else {
                      $ancien = test_input($_POST["ancien"]);
                  }

                  if(empty($_POST["nouveau"])) {
                    $nouveauErr = "Name is Required";
                }
                else {
                    $nouveau = test_input($_POST["nouveau"]);
                }

                if(empty($_POST["select1"])) {
                    $select1Err = "Name is Required";
                }
                else {
                    $select1 = test_input($_POST["select1"]);
                }

                if(empty($_POST["fil"])) {
                    $filErr = "Name is Required";
                }
                else {
                    $fil = test_input($_POST["fil"]);
                }
                  
            }

            

            

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
              }
        ?>
 
        <form method="post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="container3">
            <h3>Ancien index : </h3>
            <input type="number" name='ancien' placeholder="Ancien Index" />
            <span class="error">* <?php echo $ancienErr;?></span>
        </div>

        <div class="container4">
            <h3>Nouveau Index : </h3>
            <input type="number" name='nouveau' placeholder="Nouveau Index" />
            <span class="error">* <?php echo $nouveauErr;?></span>
        </div>

        <div class="container5">
            <h3>Calib : </h3>
            <select name="select1">
            <option value="Calibe" selected disabled hidden>Calibe</option>
                <option value="5-10">5-10</option>
                <option value="15-20">15-20</option>
                <option value=">30">>30</option>
               
            </select> <span class="error">* <?php echo $select1Err;?></span>
        </div>

        <div class="container6">
            <h3>Type de compteur : </h3>
            <select name="fil">
            <option value="Calibe" selected disabled hidden>Choisir</option>
                <option value="2 FIL">2 FIL</option>
                
            </select><span class="error">* <?php echo $filErr;?></span>
        </div>
        <div class="btn1">
             <button type="submit">Submit</button>
        </div>
       
        </form>

        <?php
echo "<h2>Your Input:</h2>";
echo $ancien;
echo "<br>";
echo $nouveau;
echo "<br>";
echo $select1;
echo "<br>";
echo $fil;
echo "<br>";
?>

        
<script src="script.js"></script>
</body>

