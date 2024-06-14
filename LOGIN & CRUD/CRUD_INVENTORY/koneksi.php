<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $db = "crud_bayu";
  $koneksi = mysqli_connect($host,$user,$pass,$db);

  if(!$koneksi) {
    die("koneksi dengan database gagal: ".mysqli_connect_error());
  }