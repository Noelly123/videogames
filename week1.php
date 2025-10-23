!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
echo "Hello World!";
?>
<?php

     $mysqli = new mysqli("localhost","2433752_user","574sa7_password","db_2433752");

     if ($mysqli -> connect_errno) {
         echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
         exit();
      }
      // Run SQL query
      $sql = "SELECT * FROM videogames ORDER BY released_date";
      $results = mysqli_query($mysqli, $sql);
    
?>
<table>
      <?php while($a_row = mysqli_fetch_assoc($results)):?>
        <tr>
          <td><?=$a_row['game_name']?></td>
          <td><?=$a_row['rating']?></td>
          <td><?=$a_row['game_description']?></td>
          <td><?=$a_row['game_date realease']?></td>
         </tr>
      <?php endwhile;?>
    </table>

</body>
</html>