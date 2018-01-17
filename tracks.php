<?php

$GenreId = $_GET['genre'];

$pdo = new PDO('sqlite:chinook.db');
$sql = 'SELECT tracks.Name as trackName, albums.Title, artists.Name, tracks.UnitPrice
        FROM tracks
        INNER JOIN albums
        ON albums.AlbumId = tracks.AlbumId
        INNER JOIN artists
        ON albums.ArtistId = artists.ArtistId
        WHERE tracks.GenreId = ?';

$statement = $pdo->prepare($sql);
$statement->bindParam(1, $GenreId);
$statement->execute();
$tracks = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Genres</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
</head>

<body>

    <table class="table">
        <tr>
            <th>Track Name</th>
            <th>Album Title</th>
            <th>Artist Name</th>
            <th>Price</th>
        </tr>
        <?php foreach ($tracks as $track) : ?>
        <tr>
            <td><?php echo $track->trackName ?></td>
            <td><?php echo $track->Title ?> </td>
            <td><?php echo $track->Name ?> </td>
            <td><?php echo $track->UnitPrice ?> </td>
        </tr>
        <?php endforeach ?>
    </table>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>

</html>