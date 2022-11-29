<?php

    // Sign In & Sign Up berganti menjadi Sign Out ketika sudah Sign In di Home.php
    function button() {

        if(isset($_SESSION['auth'])) {
            
            echo '<a href="profile.php">Profile</a>';
            echo '<a href="auth/includes/signout.inc.php">Sign Out</a>';

        } else {

            echo '<a href="auth/signin.php">Sign In</a>
                    <a href="auth/signup.php">Sign Up</a>
            ';

        }

    }

    // Profile
    function profile($profile) {

        include __DIR__ . '/../includes/conn.inc.php';

        $sql = "SELECT * FROM tb_pengguna WHERE id_pengguna = '$profile'";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {
            
            $row = $stmt->fetch_assoc();

            $namaRow = isset($row['nama_pengguna']) ? mysqli_real_escape_string($conn, $row['nama_pengguna']) : '';
            $genderRow = isset($row['gender']) ? mysqli_real_escape_string($conn, $row['gender']) : '';
            $noTelpRow = isset($row['no_telp']) ? mysqli_real_escape_string($conn, $row['no_telp']) : '';

            

            echo '
                <div class="isiprof">
                    <p>Nama Lengkap</p>
                    <input class="nl" type="text" id="nama-lengkap" name="nama-lengkap" value="' . $namaRow . '" disabled>
                    <p>Jenis Kelamin</p>
                        
                    <div class="pilih">
                ';

            if ($genderRow == 'laki') {
                echo'
                <div class="field1">
                    <input type="radio" id="c1" name="c1" value="lk" checked/>
                    <label for="c1">Laki-laki</label>
                </div>
                            
                <div class="field2">
                    <input type="radio" id="c2" name="c1" value="pr"/>
                    <label for="c1">Perempuan</label>
                </div>
                ';
            } else {
                echo'
                <div class="field1">
                    <input type="radio" id="c1" name="c1" value="lk"/>
                    <label for="c1">Laki-laki</label>
                </div>
                            
                <div class="field2">
                    <input type="radio" id="c2" name="c1" value="pr" checked/>
                    <label for="c1">Perempuan</label>
                </div>
                ';
            }
                        
                    
                       
            echo '
                </div>
                    <p>Nomor Telpon</p>
                    <input class="nl" type="text" id="no-telp" name="no-telp" value="' . $noTelpRow . '" disabled>
                </div>
            ';

        }

    }

    // Mata uang
    function curr($curr) {

        $curr = "IDR " . number_format($curr, 0, ',', '.');

        echo $curr;

    }

    // Format Tanggal
    function dateTime($date) {

        $monthObj = date('d F Y', strtotime($date));
        echo ($monthObj);

    }

    // Pendapatan List
    function pendapatan($p) {

        include __DIR__ . '/../includes/conn.inc.php';

        $sql = "SELECT * FROM tb_pendapatan WHERE id_pengguna = '$p'";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {

            while ($row = $stmt->fetch_assoc()) {

                $idRow = isset($row['id']) ? mysqli_real_escape_string($conn, $row['id']) : '';
                $tanggalRow = isset($row['tanggal_pendapatan']) ? mysqli_real_escape_string($conn, $row['tanggal_pendapatan']) : '';
                $rincianRow = isset($row['rincian_pendapatan']) ? mysqli_real_escape_string($conn, $row['rincian_pendapatan']) : '';
                $jenisRow = isset($row['jenis_pendapatan']) ? mysqli_real_escape_string($conn, $row['jenis_pendapatan']) : '';
                $totalRow = isset($row['total_pendapatan']) ? mysqli_real_escape_string($conn, $row['total_pendapatan']) : '';

                if (empty($rincianRow)) {

                    $rincianRow = "-";

                }

?>

                <tr>
                    <td><?php echo $idRow ?></td>
                    <td><?php dateTime($tanggalRow) ?></td>
                    <td><?php echo $rincianRow ?></td>
                    <td><?php echo $jenisRow ?></td>
                    <td><?php curr($totalRow) ?></td>
                </tr>

<?php

            }

        } 
        
    }

    // Pengeluaran List
    function pengeluaran($p) {

        include __DIR__ . '/../includes/conn.inc.php';

        $sql = "SELECT * FROM tb_pengeluaran WHERE id_pengguna = '$p'";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {

            while ($row = $stmt->fetch_assoc()) {

                $idRow = isset($row['id']) ? mysqli_real_escape_string($conn, $row['id']) : '';
                $tanggalRow = isset($row['tanggal_pengeluaran']) ? mysqli_real_escape_string($conn, $row['tanggal_pengeluaran']) : '';
                $rincianRow = isset($row['rincian_pengeluaran']) ? mysqli_real_escape_string($conn, $row['rincian_pengeluaran']) : '';
                $jenisRow = isset($row['jenis_pengeluaran']) ? mysqli_real_escape_string($conn, $row['jenis_pengeluaran']) : '';
                $totalRow = isset($row['total_pengeluaran']) ? mysqli_real_escape_string($conn, $row['total_pengeluaran']) : '';

                if (empty($rincianRow)) {

                    $rincianRow = "-";

                }

?>

                <tr>
                    <td><?php echo $idRow ?></td>
                    <td><?php dateTime($tanggalRow) ?></td>
                    <td><?php echo $rincianRow ?></td>
                    <td><?php echo $jenisRow ?></td>
                    <td><?php curr($totalRow) ?></td>
                </tr>

<?php

            }

        } 
        
    }

    // Tabungan List
    function tabungan($p) {

        include __DIR__ . '/../includes/conn.inc.php';

        $sql = "SELECT * FROM tb_tabungan WHERE id_pengguna = '$p'";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {

            while ($row = $stmt->fetch_assoc()) {

                $idRow = isset($row['id']) ? mysqli_real_escape_string($conn, $row['id']) : '';
                $tanggalRow = isset($row['tanggal_tabungan']) ? mysqli_real_escape_string($conn, $row['tanggal_tabungan']) : '';
                $rincianRow = isset($row['rincian_tabungan']) ? mysqli_real_escape_string($conn, $row['rincian_tabungan']) : '';
                $jenisRow = isset($row['jenis_tabungan']) ? mysqli_real_escape_string($conn, $row['jenis_tabungan']) : '';
                $totalRow = isset($row['total_tabungan']) ? mysqli_real_escape_string($conn, $row['total_tabungan']) : '';

                if (empty($rincianRow)) {

                    $rincianRow = "-";

                }

?>

                <tr>
                    <td><?php echo $idRow ?></td>
                    <td><?php dateTime($tanggalRow) ?></td>
                    <td><?php echo $rincianRow ?></td>
                    <td><?php echo $jenisRow ?></td>
                    <td><?php curr($totalRow) ?></td>
                </tr>
    
<?php
    
            }

        } 
        
    }

    // Anggaran List
    function anggaran($p) {

        include __DIR__ . '/../includes/conn.inc.php';

        $sql = "SELECT * FROM tb_anggaran WHERE id_pengguna = '$p'";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {

            while ($row = $stmt->fetch_assoc()) {

                $idRow = isset($row['id']) ? mysqli_real_escape_string($conn, $row['id']) : '';
                $namaRow = isset($row['nama_anggaran']) ? mysqli_real_escape_string($conn, $row['nama_anggaran']) : '';
                $jenisRow = isset($row['jenis_anggaran']) ? mysqli_real_escape_string($conn, $row['jenis_anggaran']) : '';
                $jumlahRow = isset($row['jumlah_anggaran']) ? mysqli_real_escape_string($conn, $row['jumlah_anggaran']) : '';
                $tanggalAwal = isset($row['tanggal_awal']) ? mysqli_real_escape_string($conn, $row['tanggal_awal']) : '';
                $tanggalAkhir = isset($row['tanggal_akhir']) ? mysqli_real_escape_string($conn, $row['tanggal_akhir']) : '';

?>
    
                <tr>
                    <td><?php echo $idRow ?></td>
                    <td><?php echo $namaRow ?></td>
                    <td><?php echo $jenisRow ?></td>
                    <td><?php curr($jumlahRow) ?></td>
                    <td><?php echo $tanggalAwal ?></td>
                    <td><?php echo $tanggalAkhir ?></td>
                </tr>
    
<?php
    
            }

        } 
        
    }

    // Anggaran List
    function anggaran2($p) {

        include __DIR__ . '/../includes/conn.inc.php';

        $sql = "SELECT * FROM tb_anggaran WHERE id_pengguna = '$p'";
        $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

        if ($stmt) {

            while ($row = $stmt->fetch_assoc()) {

                $idRow = isset($row['id']) ? mysqli_real_escape_string($conn, $row['id']) : '';
                $namaRow = isset($row['nama_anggaran']) ? mysqli_real_escape_string($conn, $row['nama_anggaran']) : '';
                $jenisRow = isset($row['jenis_anggaran']) ? mysqli_real_escape_string($conn, $row['jenis_anggaran']) : '';
                $jumlahRow = isset($row['jumlah_anggaran']) ? mysqli_real_escape_string($conn, $row['jumlah_anggaran']) : '';
                $tanggalAwal = isset($row['tanggal_awal']) ? mysqli_real_escape_string($conn, $row['tanggal_awal']) : '';
                $tanggalAkhir = isset($row['tanggal_akhir']) ? mysqli_real_escape_string($conn, $row['tanggal_akhir']) : '';

?>
    
                <tr>
                    <td><?php echo $idRow ?></td>
                    <td><?php echo $namaRow ?></td>
                    <td><?php echo $jenisRow ?></td>
                    <td><?php curr($jumlahRow) ?></td>
                    <td><?php echo $tanggalAwal ?></td>
                    <td><?php echo $tanggalAkhir ?></td>
                </tr>
    
<?php
    
            }

        } 
        
    }

    // Laporan Keuangan List
    function laporan_keuangan($p) {

    include __DIR__ . '/../includes/conn.inc.php';

    $sql = "SELECT * FROM tb_laporan_keuangan WHERE id_pengguna = '$p'";
    $stmt = $conn->query($sql) or die("Something wrong with database! Please call admin.");

    if ($stmt) {

        while ($row = $stmt->fetch_assoc()) {

            $idRow = isset($row['id']) ? mysqli_real_escape_string($conn, $row['id']) : '';
            $bulanRow = isset($row['bulan_laporan']) ? mysqli_real_escape_string($conn, $row['bulan_laporan']) : '';
            $idPengeluaranRow = isset($row['id_pengeluaran']) ? mysqli_real_escape_string($conn, $row['id_pengeluaran']) : '';
            $idPendapatanRow = isset($row['id_pendapatan']) ? mysqli_real_escape_string($conn, $row['id_pendapatan']) : '';
            $idTabunganRow = isset($row['id_tabungan']) ? mysqli_real_escape_string($conn, $row['id_tabungan']) : '';
            $idAnggaranRow = isset($row['id_anggaran']) ? mysqli_real_escape_string($conn, $row['id_anggaran']) : '';
            $statusRow = isset($row['status_keuangan']) ? mysqli_real_escape_string($conn, $row['status_keuangan']) : '';

            if ($idPengeluaranRow !== 'NULL') {

                $namaTransaksi = "Pengeluaran";
                $totalTransaksiRow = isset($row['total_pengeluaran']) ? mysqli_real_escape_string($conn, $row['total_pengeluaran']) : ''; 

            }
            
            if ($idPendapatanRow !== 'NULL') {

                $namaTransaksi = "Pendapatan";
                $totalTransaksiRow = isset($row['total_pendapatan']) ? mysqli_real_escape_string($conn, $row['total_pendapatan']) : ''; 

            }

            if ($idTabunganRow !== 'NULL') {

                $namaTransaksi = "Tabungan";
                $totalTransaksiRow = isset($row['total_tabungan']) ? mysqli_real_escape_string($conn, $row['total_tabungan']) : ''; 

            }

            if ($idAnggaranRow !== 'NULL') {

                $namaTransaksi = "Anggaran";
                $totalTransaksiRow = isset($row['total_anggaran']) ? mysqli_real_escape_string($conn, $row['total_anggaran']) : ''; 

            }

?>

            <tr>
                <td><?php echo $idRow ?></td>
                <td><?php echo $namaTransaksi ?></td>
                <td><?php echo curr($totalTransaksiRow) ?></td>
                <td><?php echo $statusRow ?></td>
            </tr>

<?php
    
            }

        } 
        
    }

?>