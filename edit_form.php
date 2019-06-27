<?php

session_start();
if(!isset($_SESSION["email"])) {
  header('location:login.php');
}

if(isset($_POST["submit"])) {

  if($_POST["submit"] === "Edit") {
    require 'Classes/Database/Query.php';
    $db = new Query;

    $nim = $_POST["nim"];

    $result = $db->nim($nim)->FetcArray();

    $nim  = $result['nim'];
    $nama = $result['nama'];
    $tempat_lahir = $result['tempat_lahir'];
    $tgl = strtotime($result['tanggal']);
    $tanggal = date('d-m-Y',$tgl);
    $fakultas = $result['fakultas'];
    $jurusan = $result['jurusan'];
    $ipk     = $result['ipk'];

  }
  else if($_POST['submit'] === "Update") {
    require 'Classes/Edit_controller.php';
    $update = new Edit_controller;

    $nim  = htmlentities(strip_tags(trim($_POST["nim"])));
    $nama = htmlentities(strip_tags(trim($_POST["nama"])));
    $tempat_lahir = htmlentities(strip_tags(trim($_POST["tempat_lahir"])));
    $fakultas = htmlentities(strip_tags(trim($_POST["fakultas"])));
    $jurusan  = htmlentities(strip_tags(trim($_POST["jurusan"])));
    $ipk      = htmlentities(strip_tags(trim($_POST["ipk"])));

    $tanggal = $_POST["tanggal_lahir"];
    $tgl = strtotime($tanggal);
    $tanggal_lahir = date('Y-m-d',$tgl);

    $update->getData($nim,$nama,$tempat_lahir,$tanggal_lahir,$fakultas,$jurusan,$ipk);
  }



}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Edit Mahasiswa</title>
    <style>

    div.error {
      color: red;
      background-color: rgba(244, 121, 121, 0.61);
    }

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
  <h1>Edit Data</h1>
  <?php if(isset($_POST["submit"]))  {
    echo "<div class='error'>$tambah->message</div>";
  }?>
  <form action="edit_form.php" method="post" enctype="application/x-www-form-urlencoded">
  <table>
    <!-- nim -->
    <tr>
      <td>
        <label for="nim">NIM:</label>
      </td>
      <td>
        <input type="text" name="nim" id="nim" readonly placeholder="1 s/d 8" value="<?php echo $nim; ?>">
      </td>
      <td>nim tidak bisa di edit</td>
    </tr>
    <!-- Nama -->
    <tr>
      <td>
        <label for="nama">Nama:</label>
      </td>
      <td>
        <input type="text" name="nama" id="nama" placeholder="nama" value="<?php echo $nama; ?>">
      </td>
    </tr>
    <!-- tempat lahir -->
    <tr>
      <td>
        <label for="tempat_lahir">Tempat Lahir:</label>
      </td>
      <td>
        <input type="text" name="tempat_lahir" id="tempat_lahir" value="<?php echo $tempat_lahir; ?>">
      </td>
    </tr>

    <!-- Tanggal Lahir -->
    <tr>
      <td>
        <label for="tanggal_lahir">Tanggal Lahir:</label>
      </td>
      <td>
        <input type="text" name="tanggal_lahir" placeholder="dd-mm-yyyy" value="<?php echo $tanggal; ?>">
      </td>
    </tr>
    <!-- Fakultas -->
    <tr>
      <td>
        <label for="fakultas">Fakultas:</label>
      </td>
      <td>
        <select name="fakultas" id="fakultas">
          <option value="<?php echo $fakultas; ?>"><?php echo $fakultas; ?></option>
          <option value="FMIPA">FMIPA</option>
          <option value="Teknik">Teknik</option>
          <option value="Ekonomi">Ekonomi</option>
        </select>
      </td>
    </tr>
    <!-- Jurusan -->
    <tr>
      <td>
        <label for="jurusan">Jurusan:</label>
      </td>
      <td>
        <input type="text" name="jurusan" placeholder="jurusan" value="<?php echo $jurusan; ?>">
      </td>
    </tr>

    <!-- IPK -->
    <tr>
      <td>
        <label for="ipk">IPK:</label>
      </td>
      <td>
        <input type="text" name="ipk" id="ipk" placeholder="contoh:20.3" value="<?php echo $ipk ?>">
      </td>
      <td>
        <small>wajib menggunakan angka dan tidak boleh mengunakan tanda min(-)</small>
        <?php if(isset($_POST["submit"])) {
          echo "<div class='error'>$tambah->pesan</div>";
        }?>
      </td>

    </tr>
    <tr>
      <td>
        <input type="submit" name="submit" value="Update">
      </td>
    </tr>
  </table>
  </form>
  </div>
  </body>
</html>
