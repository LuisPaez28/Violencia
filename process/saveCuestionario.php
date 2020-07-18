<?php
try {
    require '../conn/conn.php';
   
  
    $puntaje=0;
    for ($i=1; $i < 13; $i++) { 
        if($_POST['cst'.$i]=="Si")$puntaje+=3;
        if($_POST['cst'.$i]=="A veces")$puntaje+=2;
        if($_POST['cst'.$i]=="Rara Vez")$puntaje+=1;
        if($_POST['cst'.$i]=="No")$puntaje+=0;
    }
    $data = (object)array();
    $data->name = $puntaje;
    echo json_encode($data);
} catch (\Throwable $th) {
    echo'Mal';
}
