<?php
session_start();

include('koneksi.php');
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
  echo "<script>alert('Anda Belum Login!');window.location='../index.html';</script>";
  exit;
}


if (isset($_POST['logout'])) {
  session_unset();
  session_destroy();
  header("Location: /LOGIN&CRUD/index.php");
  exit;
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>CRUD BAYU XI PPLG 2</title>
  <style type="text/css">
    * {
      font-family: "Trebuchet MS";
    }

    h1 {
      text-transform: uppercase;
      color: lightskyblue;
    }

    table {
      border: 1px solid #ddeeee;
      border-collapse: collapse;
      border-spacing: 0;
      width: 70%;
      margin: 10px auto 10px auto;
    }

    table thead th {
      background-color: #ddefef;
      border: 1px solid #ddeeee;
      color: #336b6b;
      padding: 10px;
      text-align: left;
      text-shadow: 1px 1px 1px #fff;
    }

    table tbody td {
      border: 1px solid #ddeeee;
      color: #333;
      padding: 10px;
      text-align: left;
    }

    .Btn {
      --black: #000000;
      --ch-black: #141414;
      --eer-black: #1b1b1b;
      --night-rider: #2e2e2e;
      --white: #ffffff;
      --af-white: #f3f3f3;
      --ch-white: #e1e1e1;
      display: flex;
      align-items: center;
      justify-content: flex-start;
      width: 45px;
      height: 45px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      position: relative;
      overflow: hidden;
      transition-duration: .3s;
      box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
      background-color: var(--night-rider);
    }

    .sign {
      width: 100%;
      transition-duration: .3s;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .sign svg {
      width: 17px;
    }

    .sign svg path {
      fill: var(--af-white);
    }

    .text {
      position: absolute;
      right: 0%;
      width: 0%;
      opacity: 0;
      color: var(--af-white);
      font-size: 1.2em;
      font-weight: 600;
      transition-duration: .3s;
    }

    .Btn:hover {
      width: 125px;
      border-radius: 5px;
      transition-duration: .3s;
    }

    .Btn:hover .sign {
      width: 30%;
      transition-duration: .3s;

    }

    .Btn:hover .text {
      opacity: 1;
      width: 70%;
      transition-duration: .3s;
    }

    .Btn:active {
      transform: translate(2px, 2px);
    }
  </style>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
  <script src='main.js'></script>
</head>

<body>
  <a href="/LOGIN&CRUD/index.html" button class="Btn">
    <div class="sign"><svg viewBox="0 0 512 512">
        <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"></path>
      </svg></div>
    <div class="text">Logout</div>

  </a>
  <center>
    <h1>Data Produk</h1>
  </center>
  <center><a style="border-radius: 32px;background-color: lightskyblue;color: #fff;padding: 10px;font-size: 12px;text-decoration: none;" href="tambah_produk.php">+ &nbsp; Tambah Produk</a></center>
  <br>
  <table>
    <thead>
      <th>No.</th>
      <th>Produk</th>
      <th>Deskripsi</th>
      <th>Harga Beli</th>
      <th>Harga Jual</th>
      <th>Gambar</th>
      <th>Action</th>
    </thead>
    <tbody>
      <?php
      $query = "SELECT * FROM produk ORDER BY id ASC";
      $result = mysqli_query($koneksi, $query);

      if (!$result) {
        die("Query Error : " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
      }
      $no = 1;

      while ($row = mysqli_fetch_assoc($result)) {
      ?>
        <tr>
          <td><?php echo $no; ?></td>
          <td><?php echo $row['nama_produk']; ?></td>
          <td><?php echo substr($row['deskripsi'], 0, 20); ?>...</td>
          <td>Rp <?php echo number_format($row['harga_beli'], 0, ',', '.'); ?></td>
          <td>Rp <?php echo number_format($row['harga_jual'], 0, ',', '.'); ?></td>
          <td><img style="width: 120px;" src="gambar/<?php echo $row['gambar_produk']; ?>"></td>
          <td>
            <a style="background-color: black;border-radius: 8px;color: #fff;padding: 10px;font-size: 12px;text-decoration: none;" href="edit_produk.php?id=<?php echo $row['id']; ?>">Edit</a>
            <a style="background-color: red;border-radius: 8px;color: #fff;padding: 10px;font-size: 12px;text-decoration: none;" href="proses_hapus.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Anda yakin ingin hapus data ini?')">Hapus</a>
          </td>
        </tr>
      <?php
        $no++;
      }
      ?>

    </tbody>
  </table>
</body>

</html>