<?php 
    session_start();
    include('server.php');
    $NumofFlim = mysqli_real_escape_string($conn, $_POST['NumOfFlim']);
    echo  $NumofFlim;
    $errors = array();
    $FilmID = $_SESSION['FilmID'];
    $mID = $_SESSION['ID'];
    $TheatreID = $_SESSION['TheatreID'];
    $Showtime = $_SESSION['ShowTime'];
  
   // echo $Showtime ;

$sql2 =  " UPDATE Showtime SET RemainingSeat = RemainingSeat- $NumofFlim  WHERE FilmID = '$FilmID' AND TheatreID= '$TheatreID' AND ShowTime= '$Showtime' ;" ;
        mysqli_multi_query($conn,$sql2);    

    While ($NumofFlim > 0){
            $sql =  "INSERT INTO Ticket (mID,FilmID,TheatreID,T_Showtime) VALUES ('$mID','$FilmID','$TheatreID', '$Showtime');" ;
            mysqli_multi_query($conn,$sql);   
            $NumofFlim--;

}

    unset($_SESSION['FilmID']);
    unset($_SESSION['TheatreID']);
    unset($_SESSION['ShowTime']);
    unset($_SESSION['RemainingSeat']);
    header('location: payment.php');

?>