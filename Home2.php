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
        $Tarifs = array("T1"=>0.794, "T2"=>0.883, "T3"=>0.9451, "T4"=> 1.0489, "T5"=>1.2915, "T6"=>1.4975);
        $tranch = array("tranch1"=>1,"tranch2"=>2,"tranch3"=>3,"tranch4"=>4,"tranch5"=>5,"tranch6"=>6);
        $Trn1 = 100 * $Tarifs["T1"];
        $Trn3 = 210 * $Tarifs["T3"];
        $Trn4 = 310 * $Tarifs["T4"];
        $Trn5 = 510 * $Tarifs["T5"];
        $tva = 14;
        $tambre = 0.45;
        $calibre = array( "calibre1" => 22.65, "calibre2" => 37.05, "calibre3" => 46.20);
      
    ?>
    
<?php 
        class Tranche{
            public $borne_minimale ;
            public $borne_maximale ;
            public $prix_unitaire ; 

            function __construct($borne_min,$borne_max,$prix){
                $this -> borne_minimale = $borne_min;
                $this -> borne_maximale = $borne_max;
                $this -> prix_unitaire = $prix;
            }     
        }
        $tranche1 = new Tranche(0,100,$Tarifs["T1"]);
        $tranche2 = new Tranche(101,150,$Tarifs["T2"]);
        $tranche3 = new Tranche(151,210,$Tarifs["T3"]);
        $tranche4 = new Tranche(211,310,$Tarifs["T4"]);
        $tranche5 = new Tranche(311,510,$Tarifs["T5"]);
        $tranche6 = new Tranche(511,null,$Tarifs["T6"]);


        $Table = array();
        array_push($Table,$tranche1,$tranche2,$tranche3,$tranche4,$tranche5,$tranche6);
        $calibre = array( "calibre1" => 22.65, "calibre2" => 37.05, "calibre3" => 46.20);
        $max ;
        $min ;  
        $moyen; 
        $CalibreType;
        $Totale = array();
        $TotaleHT = array();
        $Total=0;
        if(isset($_POST["Submit"])){
            $max = $_POST["max"];
            $min = $_POST["min"];
            $THT=0;
            
            $CalibreType = $_POST['Calibre'];
            if (empty($max) || empty($min) || empty($CalibreType)) {
                echo "<script>alert(\"max or min , type is empty\")</script>";

            } else {
                $moyen  = $max - $min;
            } 	       
            if($moyen <= 150){
                if($moyen <= $Table[0] -> borne_maximale ){
                    $Totale[0] = $moyen;
                    $TotaleHT[0] =  $moyen * $Table[0] -> prix_unitaire;
                    $Tranch = $tranch["tranch1"];
                    
                }
                elseif($moyen <= $Table[1] -> borne_maximale && $moyen >= $Table[1] -> borne_minimale){
                    $Totale[0] = 100;
                    $Totale[1] = $moyen - $Totale[0];
                    $TotaleHT[0] = $Totale[0] * $Table[0] -> prix_unitaire;
                    $TotaleHT[1] = $Totale[1] * $Table[1] -> prix_unitaire;
                    $Tranch = $tranch["tranch1"];
                    $Tranch = $tranch["tranch2"];

                     
                }
            }
            else {
                if($moyen <= $Table[2] -> borne_maximale && $moyen >= $Table[2] -> borne_minimale){
                    $Totale[2] = $moyen;
                    $TotaleHT[2] = $moyen * $Table[2] -> prix_unitaire;
                    $Tranch = $tranch["tranch3"];
                     
                }
                elseif ($moyen <= $Table[3]-> borne_maximale && $moyen >= $Table[3] -> borne_minimale) {
                    $Totale[3] = $moyen;
                    $TotaleHT[3] = $moyen * $Table[3] -> prix_unitaire;
                    $Tranch = $tranch["tranch4"];
                   
                }
                elseif ($moyen <= $Table[4] -> borne_maximale && $moyen >= $Table[4]-> borne_minimale) {
                    $Totale[4] = $moyen;
                    $TotaleHT[4] = $moyen * $Table[4] -> prix_unitaire;
                    $Tranch = $tranch["tranch5"];
                   
                }
                else{
                    $Totale[5] = $moyen;
                    $TotaleHT[5] = $moyen * $Table[5] -> prix_unitaire;
                    $Tranch = $tranch["tranch6"];
                  
                }

            }
              if($CalibreType == "min"){
                 $TypeCalibre =   $calibre["calibre1"];
              }
              elseif($CalibreType == "moyen"){
                  $TypeCalibre = $calibre["calibre2"];
              }
              elseif($CalibreType == "max"){
                  $TypeCalibre =  $calibre["calibre3"];
              }
            foreach($TotaleHT as $key => $value)
            {
              $THT += $TotaleHT[$key];
            }
            foreach($TotaleHT as $key => $value)
            {
              $Total +=($TotaleHT[$key]  * $tva /100)  ;
            } 
            $nbrTranche = 0;
            foreach($tranch as $key => $value){
              $nbrTranche += $tranch[$key];
            }
        }
        
?>
 
 
 
   <br><br>
   git add .
   <div class="container11">
    <form  method="POST">
          <label for="fname">Nouvel index</label>
          <input type="text" id="fmax" name="max" placeholder="Max..">
          <br><br>
          <label for="fname">Ancien index</label>
          <input type="text" id="fmin" name="min" placeholder="Min..">
          <br><br>
       <input type="radio" name="Calibre" value="min"  class="type">5-10
          <input type="radio" name="Calibre" value="moyen"  class="type">15-20
          <input type="radio" name="Calibre" value="max"  class="type">> 30
          
                <br><br>
      <div class='btn1'>
          <input type="submit" class = 'btn11' value="Submit" name='Submit'>
           
          <input type='submit' class = 'btn11' onclick="btnprint()" value='Print' id="btnPrint">
           </div>
    </form>
    <br><br>
  </div>
  <br><br>
  <?php 
    if(isset($_POST["Submit"])){
  ?>
  <div class="container mt-3 table-responsive table1" id="table1">
    <div class=" divNav row " >
      <?php 
      if(isset($_POST["Submit"])){ ?>
        <div>Ancien index : <?php echo $max ?></div>
        <div>Nouvel index : <?php echo $min ?></div>
        <div>Consommation : <?php echo $moyen ?></div>
      <?php
            }
      ?>
    </div>
    
    <table  class="table table-borderless table1">
      <thead>
        <tr>
          <th></th>
          <th > مفوتر<br>
              Facturé</th>
          <th>س.و<br>
              P.U</th>
          <th>المبلغ د.إ.ر<br>
              Montant HT</th>
          <th>ض.ق.م<br>
              Taux TVA</th>
          <th>مبلغ الرسوم<br>
              Montant Taxes</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>CONSOMMATION ELECTRICITE</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="right">إستھلاك الكھرباء</td>
        </tr>
      <?php 
      if(isset($_POST["Submit"])){
        foreach($Totale as $key => $value){
          
      ?>
        <tr>
            <td>TRANCHE<?php echo " $Tranch "?></td>
            <td><?php echo $value ?></td>
            <td><?php echo $Table[$key]->prix_unitaire ?></td>
            <td><?php echo $TotaleHT[$key] ?></td>
            <td><?php echo $tva . "%";?></td>
            <td><?php echo $TotaleHT[$key] * $tva /100 ?></td>
            <td class="right"><?php echo " $Tranch "?>الشطر</td>
        </tr>
        <?php
            }
        }
        ?>
        <?php 
          if(isset($_POST["Submit"])){
        ?>
        <tr>
          <td> REDEVANCE FIXE ELECTRICITE</td>
          <td></td>
          <td></td>
          <td><?php echo $TypeCalibre?></td>
          <td><?php echo $tva . "%";?></td>
          <td><?php echo $TypeCalibre * $tva /100 ?></td>
          <td class="right"> إثاوة   ثابتة الكھرباء </td>
        </tr>
        <?php
        }
        ?>
        <tr>
          <td>TAXES POUR LE COMPTE DE L’ETAT</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td class="right">الرسوم المؤداة لفائدة الدولة </td>
        </tr>
        <?php 
          if(isset($_POST["Submit"])){
            //  for($i=0;$i<count($TotaleHT);$i++){
        ?>
        <tr>
          <td class="text-secondary">TOTAL TVA</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><?php echo $SOUS_Toatla = $Total + ($TypeCalibre * $tva /100)?></td>
          <td class="text-secondary right">مجموع ض.ق.م</td>
        </tr>
        <?php
        }
        //  }
        ?>
        <?php 
        if(isset($_POST["Submit"])){
        ?>
        <tr>
          <td class="text-secondary"> TIMBRE</td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td><?php echo $tambre?></td>
          <td class="text-secondary right">الطابع</td>
        </tr>
        <?php
        }
        ?>
        <?php 
          if(isset($_POST["Submit"])){
        ?>
        <tr>
          <td>SOUS-TOTAL</td>
          <td></td>
          <td></td>
          <td><?php echo $SOUS_THT = $THT+ $TypeCalibre ?></td>
          <td></td>
          <td><?php echo $SOUS_T = $SOUS_Toatla + $tambre?></td>
          <td class="right">المجموع الجزئي</td>
        </tr> 
        <?php
        }
        ?>
        <br><br> <?php 
          if(isset($_POST["Submit"])){
        ?>
        <tr>
          <td>TOTAL ÉLECTRICITÉ</td>
          <td></td>
          <td></td>
          <td></td>
          <td><?php echo $SOUS_T + $SOUS_THT?></td>
          <td></td>
          <td class="right">مجموع  الكھرباء</td>
        </tr>
        <?php
        }
        ?>
      </tbody>
    </table>
  </div>
  <?php
        }
        ?>
  <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank">
        
  </iframe>
 
<script src="scrip