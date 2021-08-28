<?php
require "config/config.php";
// add
if (isset($_POST['add'])) {
    $kdBarang = $_POST['kdBarang'];
    $nmBarang = $_POST['nmBarang'];
    $merkBarang = $_POST['merkBarang'];
    $kategori = $_POST['kategori'];
    $tglPembelian = $_POST['tglPembelian'];
    $jmlhBarang = $_POST['jmlhBarang'];

    $add = mysqli_query($con, "INSERT INTO barang_masuk VALUES(null,'$kdBarang','$nmBarang','$merkBarang','$kategori','$tglPembelian','$jmlhBarang',NOW())");
    if ($add) {
        echo '<script>alert("Barang berhasil ditambahkan");window.location.href="barang-masuk.php";</script>';
    } else {
        echo '<script>alert("Barang gagal ditambahkan");window.location.href="barang-masuk.php";</script>';
    }
}

// delete
if (isset($_POST['delete'])) {
    $idBarangMasuk = $_POST['idBarangMasuk'];
    $delete = mysqli_query($con, "DELETE FROM barang_masuk WHERE idBarangMasuk = '$idBarangMasuk'");
    if ($delete) {
        echo '<script>alert("Barang telah dihapus");window.location.href="barang-masuk.php";</script>';
    } else {
        echo '<script>alert("Barang gagal dihapus");window.location.href="barang-masuk.php";</script>';
    }
}

// edit
if (isset($_POST['edit'])) {
    $idBarangMasuk = $_POST['idBarangMasuk'];
    $kdBarang = $_POST['kdBarang'];
    $nmBarang = $_POST['nmBarang'];
    $merkBarang = $_POST['merkBarang'];
    $kategori = $_POST['kategori'];
    $tglPembelian = $_POST['tglPembelian'];
    $jmlhBarang = $_POST['jmlhBarang'];

    $edit = mysqli_query($con, "UPDATE barang_masuk SET kdBarang = '$kdBarang', nmBarang = '$nmBarang', merkBarang = '$merkBarang', kategori = '$kategori', tglPembelian = '$tglPembelian', jmlhBarang = '$jmlhBarang' WHERE idBarangMasuk = '$idBarangMasuk'");
    if ($edit) {
        echo '<script>alert("Barang berhasil diedit");window.location.href="ruang.php";</script>';
    } else {
        echo '<script>alert("Barang gagal diedit");window.location.href="ruang.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Barang</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require "ui/sidebar.php" ?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require "ui/navbar.php" ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 text-gray-800">Data Barang</h1>
                    <button class="btn btn-primary btn-icon-split my-2" data-toggle="modal" data-target="#addBarang">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                            <span class="text-white">Tambah Data</span>
                        </span>
                    </button>
                    <!-- Modal Add -->
                    <div class="modal fade" id="addBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Barang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kdBarang">Kode Barang</label>
                                            <input type="text" class="form-control" id="kdBarang" aria-describedby="kdBarang" name="kdBarang" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="nmBarang">Nama Barang</label>
                                            <input type="text" class="form-control" id="nmBarang" aria-describedby="nmBarang" name="nmBarang" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="merkBarang">Merk</label>
                                            <input type="text" class="form-control" id="merkBarang" aria-describedby="merkBarang" name="merkBarang" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1">Kategori</label>
                                            <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                                <?php
                                                require "config/config.php";
                                                $show = mysqli_query($con, "SELECT * FROM kategori");
                                                while ($a = mysqli_fetch_array($show)) {
                                                    $idKategori = $a['idKategori'];
                                                    $nmKategori = $a['nmKategori'];

                                                ?>
                                                    <option value="<?php echo $idKategori ?>"><?php echo $nmKategori ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="tglPembelian">Tanggal Pembelian</label>
                                            <input type="date" class="form-control" id="tglPembelian" aria-describedby="tglPembelian" name="tglPembelian" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="jmlhBarang">Jumlah Barang</label>
                                            <input type="number" class="form-control" id="jmlhBarang" aria-describedby="jmlhBarang" name="jmlhBarang" required="">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="add">Tambahkan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- End Modal -->
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tabel Ruangan</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Merk</th>
                                            <th>Kategori</th>
                                            <th>Tanggal Pembelian</th>
                                            <th>Jumlah Barang</th>
                                            <th>Tanggal Tambah</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        require "config/config.php";
                                        $no = 1;
                                        $show = mysqli_query($con, "SELECT * FROM barang_masuk INNER JOIN kategori ON barang_masuk.idKategori = kategori.idKategori");
                                        while ($a = mysqli_fetch_array($show)) {
                                            $idBarangMasuk = $a['idBarangMasuk'];
                                            $kdBarang = $a['kdBarang'];
                                            $nmBarang = $a['nmBarang'];
                                            $merkBarang = $a['merkBarang'];
                                            $idKategori = $a['idKategori'];
                                            $nmKategori = $a['nmKategori'];
                                            $tglPembelian = $a['tglPembelian'];
                                            $jmlhBarang = $a['jmlhBarang'];
                                            $tglTambah = $a['tglTambah'];

                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $kdBarang ?></td>
                                                <td><?php echo $nmBarang ?></td>
                                                <td><?php echo $merkBarang ?></td>
                                                <td><?php echo $nmKategori ?></td>
                                                <td><?php echo $tglPembelian ?></td>
                                                <td><?php echo $jmlhBarang ?></td>
                                                <td><?php echo $tglTambah ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger my-1" data-toggle="modal" data-target="#deleteBarang<?php echo $idBarangMasuk ?>"><i class="fas fa-trash"></i></button>
                                                    <button type="button" class="btn btn-success my-1" data-toggle="modal" data-target="#editBarang<?php echo $idBarangMasuk ?>"><i class="fas fa-pen"></i></button>
                                                </td>
                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="deleteBarang<?php echo $idBarangMasuk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Barang</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <input type="hidden" value="<?php echo $idBarangMasuk ?>" name="idBarangMasuk">
                                                                        <h6>Yakin Ingin Menghapus Barang dengan Kode "<?php echo $kdBarang ?>?"</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-danger" name="delete">Hapus</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                                <!-- Modal Edit -->
                                                <div class="modal fade" id="editBarang<?php echo $idBarangMasuk ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Barang</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="idBarangMasuk" value="<?php echo $idBarangMasuk ?>">
                                                                    <div class="form-group">
                                                                        <label for="kdBarang">Kode Barang</label>
                                                                        <input type="text" class="form-control" id="kdBarang" aria-describedby="kdBarang" name="kdBarang" required="" value="<?php echo $kdBarang ?>" disabled>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nmBarang">Nama Barang</label>
                                                                        <input type="text" class="form-control" id="nmBarang" aria-describedby="nmBarang" name="nmBarang" required="" value="<?php echo $nmBarang ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="merkBarang">Merk</label>
                                                                        <input type="text" class="form-control" id="merkBarang" aria-describedby="merkBarang" name="merkBarang" required="" value="<?php echo $merkBarang ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="exampleFormControlSelect1">Kategori</label>
                                                                        <select class="form-control" id="exampleFormControlSelect1" name="kategori">
                                                                            <?php
                                                                            require "config/config.php";
                                                                            $ambil = mysqli_query($con, "SELECT * FROM kategori");
                                                                            while ($a = mysqli_fetch_array($ambil)) {
                                                                                $idKategori = $a['idKategori'];
                                                                                $nmKategori = $a['nmKategori'];

                                                                            ?>
                                                                                <option value="<?php echo $idKategori ?>"><?php echo $nmKategori ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="tglPembelian">Tanggal Pembelian</label>
                                                                        <input type="date" class="form-control" id="tglPembelian" aria-describedby="tglPembelian" name="tglPembelian" required="" value="<?php echo $tglPembelian ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="jmlhBarang">Jumlah Barang</label>
                                                                        <input type="number" class="form-control" id="jmlhBarang" aria-describedby="jmlhBarang" name="jmlhBarang" required="" value="<?php echo $jmlhBarang ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success" name="edit">Simpan</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- End Modal -->
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php require "ui/footer.php" ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>