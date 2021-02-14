<?php
   // config for connect database 
   $connect = mysqli_connect("localhost", "root", "", "hw7"); 

function fill_music($connect){
    if (isset($_POST['rr'])) {
        $rr = $_POST['rr'];
    } else {
        $rr = '';
    }
    if (isset($_POST['tt'])) {
        $tt = $_POST['tt'];
    } else {
        $tt = '';
    }

    if($tt !=0){
        $sql = "SELECT music.MusicName,music.Lyrics, artist.BandName, album.AlbumName,album.ReleaseYear
        FROM ((music
        INNER JOIN artist ON music.BandID = artist.BandID)
        INNER JOIN album ON music.AlbumID = album.AlbumID)
        WHERE album.AlbumID LIKE '%$tt%'";
    }else{
        $sql = "SELECT music.MusicName,music.Lyrics, artist.BandName, album.AlbumName,album.ReleaseYear
        FROM ((music
        INNER JOIN artist ON music.BandID = artist.BandID)
        INNER JOIN album ON music.AlbumID = album.AlbumID)
        WHERE MusicName LIKE '%$rr%' or artist.BandName LIKE '%$rr%'";
    }

    $result = mysqli_query($connect, $sql);

    $arr = array();

    while($row = $result->fetch_object())
    {
         $arr[] = $row;
    }
    echo json_encode($arr,JSON_UNESCAPED_UNICODE);
}
    echo fill_music($connect);
?>    




