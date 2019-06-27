<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Mahasiswa</title>
    <style>
    ul li  {
      list-style: none;
      float: left;
      padding:15px;
      background-color: black;
    }

    ul li a {
      text-decoration: none;
      color: white;
    }

    ul li a:hover {
      background-color: white;
      color: black;
      padding: 15px;
    }

    div.clear {
      clear: both;
    }
    h1 {
      text-align: center;
    }

    table {
      margin: auto;
      border-collapse: collapse;
    }

    tr,td,th {
      padding: 10px;
    }
    </style>
  </head>
  <body>
    <div id="container">
    <ul>
      <li>
        <a href="tampil.php">Tampil</a>
      </li>
      <li>
        <a href="tambah.php">Tambah</a>
      </li>
      <li>
        <a href="edit.php">Edit</a>
      </li>
      <li>
        <a href="Delete.php">Delete</a>
      </li>
      <li>
        <a href="#">Logout</a>
      </li>
  </ul>
  <div class="clear"></div>
  <h1>edit Data</h1>

  <table border="1">
    <thead>
      <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Fakultas</th>
        <th>Jurusan</th>
        <th>IPK</th>
        <th>Edit</th>
      </tr>
    </thead>
    <tbody>
      <?php
      session_start();
      if(!isset($_SESSION["email"])) {
        header('location:login.php');
      }

      require 'Classes/Tampil_controller.php';
      $db = new Tampil_controller;

      foreach($db->tampil() as $x) {
        echo "<tr>";
        echo "<td>".$x['nim']."</td>";
        echo "<td>".$x['nama']."</td>";
        echo "<td>".$x['tempat_lahir']."</td>";
        echo "<td>".$x['tanggal']."</td>";
        echo "<td>".$x['fakultas']."</td>";
        echo "<td>".$x['jurusan']."</td>";
        echo "<td>".$x['ipk']."</td>";
        echo "<td>";
        ?>
        <form action="edit_form.php" method="post">
          <input type="hidden" name="nim" value="<?php echo $x['nim'] ?>">
          <input type="submit" name="submit" value="Edit">
        </form>
        <?php
        echo "</td>";
        echo "</tr>";
      }

     ?>
    </tbody>
  </table>
  </div>
  </body>
</html>
