<?php

   $myInputs = $_POST["myInputs"];
   $myhead = $_POST["myhead"];

   foreach ($myhead as $eachInput) {
   	   echo $eachInput . "<br>";
   }

   foreach ($myInputs as $eachInput) {
       echo $eachInput . "<br>";
   }

?>
