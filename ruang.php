<?php
require "config/config.php";
// add
if (isset($_POST['add'])) {
    $kdRuang = $_POST['kdRuang'];
    $nmRuang = $_POST['nmRuang'];

    $cek = mysqli_query($con, "SELECT * FROM ruang WHERE kdRuang = '$kdRuang'");
    if (mysqli_num_rows($cek) > 0) {
        echo '<script>alert("Kode Ruangan sudah ada");window.location.href="ruang.php";</script>';
    } else {
        $add = mysqli_query($con, "INSERT INTO ruang VALUES(null,'$kdRuang','$nmRuang')");
        if ($add) {
            echo '<script>alert("Ruangan baru berhasil ditambahkan");window.location.href="ruang.php";</script>';
        } else {
            echo '<script>alert("Ruangan baru gagal ditambahkan");window.location.href="ruang.php";</script>';
        }
    }
}

// delete
if (isset($_POST['delete'])) {
    $idRuang = $_POST['idRuang'];
    $delete = mysqli_query($con, "DELETE FROM ruang WHERE idRuang = '$idRuang'");
    if ($delete) {
        echo '<script>alert("Ruangan telah dihapus");window.location.href="ruang.php";</script>';
    } else {
        echo '<script>alert("Ruangan gagal dihapus");window.location.href="ruang.php";</script>';
    }
}

// edit
if (isset($_POST['edit'])) {
    $idRuang = $_POST['idRuang'];
    $kdRuang = $_POST['kdRuang'];
    $nmRuang = $_POST['nmRuang'];

    $edit = mysqli_query($con, "UPDATE ruang SET kdRuang = '$kdRuang', nmRuang = '$nmRuang' WHERE idRuang = '$idRuang'");
    if ($edit) {
        echo '<script>alert("Ruangan berhasil diedit");window.location.href="ruang.php";</script>';
    } else {
        echo '<script>alert("ruangan gagal diedit");window.location.href="ruang.php";</script>';
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

    <title>Ruang</title>

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
                    <h1 class="h3 text-gray-800">Data Ruang</h1>
                    <button class="btn btn-primary btn-icon-split my-2" data-toggle="modal" data-target="#addRuang">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                            <span class="text-white">Tambah Data</span>
                        </span>
                    </button>
                    <!-- Modal Add -->
                    <div class="modal fade" id="addRuang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ruang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kdRuang">Kode Ruangan</label>
                                            <input type="text" class="form-control" id="kdRuang" aria-describedby="kdRuang" name="kdRuang" required="">
                                        </div>
                                        <div class="form-group">
                                            <label for="nmRuang">Nama Ruangan</label>
                                            <input type="text" class="form-control" id="nmRuang" aria-describedby="nmRuang" name="nmRuang" required="">
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
                                            <th>Kode Ruangan</th>
                                            <th>Nama Ruangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        <?php
                                        require "config/config.php";
                                        $no = 1;
                                        $show = mysqli_query($con, "SELECT * FROM ruang");
                                        while ($a = mysqli_fetch_array($show)) {
                                            $idRuang = $a['idRuang'];
                                            $kdRuang = $a['kdRuang'];
                                            $nmRuang = $a['nmRuang'];

                                        ?>
                                            <tr>
                                                <td><?php echo $no++ ?></td>
                                                <td><?php echo $kdRuang ?></td>
                                                <td><?php echo $nmRuang ?></td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteRuang<?php echo $idRuang ?>"><i class="fas fa-trash"></i></button>
                                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#editKategori<?php echo $idRuang ?>"><i class="fas fa-pen"></i></button>
                                                </td>
                                                <!-- Modal Delete -->
                                                <div class="modal fade" id="deleteRuang<?php echo $idRuang ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kategori</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <input type="hidden" value="<?php echo $idRuang ?>" name="idRuang">
                                                                        <h6>Yakin Ingin Menghapus Ruangan "<?php echo $nmRuang ?>?"</h6>
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
                                                <div class="modal fade" id="editKategori<?php echo $idRuang ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="" method="POST">
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="idRuang" value="<?php echo $idRuang ?>">
                                                                    <div class="form-group">
                                                                        <label for="kdRuang">Kode Ruangan</label>
                                                                        <input type="text" class="form-control" id="kdRuang" aria-describedby="kdRuang" name="kdRuang" required="" value="<?php echo $kdRuang ?>">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="nmRuang">Nama Ruangan</label>
                                                                        <input type="hidden" name="idRuang" value="<?php echo $idRuang ?>">
                                                                        <input type="text" class="form-control" id="nmRuang" aria-describedby="nmRuang" name="nmRuang" required="" value="<?php echo $nmRuang ?>">
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