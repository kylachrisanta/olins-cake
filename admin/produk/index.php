<?php
session_start();
require_once '../konfigurasi/koneksi.php';

if (!isset($_SESSION['status_login_admin']) || $_SESSION['status_login_admin'] !== true) {
    header("Location: ../masuk_admin.php");
    exit;
}

$nama_admin = $_SESSION['nama_admin'];

// Ambil data produk beserta kategorinya
$query = "SELECT p.*, k.nama_kategori FROM produk p JOIN kategori_produk k ON p.id_kategori = k.id_kategori ORDER BY p.id_produk DESC";
$produk_res = $koneksi->query($query);

// Ambil semua data kategori
$kategori_res = $koneksi->query("SELECT * FROM kategori_produk ORDER BY id_kategori DESC");

// Fetch kategories again for the select option in add product form
$kategori_options_res = $koneksi->query("SELECT * FROM kategori_produk");

?>
<?php include '../bagian/header.php'; ?>
<?php include '../bagian/sidebar.php'; ?>

<style>
/* Reset and specific page variables */
.page-content {
    background-color: var(--admin-bg); /* #FFFFFF */
    padding: 30px;
    flex: 1;
}

/* Custom Tabs Styling */
.custom-tabs {
    display: flex;
    border-bottom: 2px solid #e5e7eb;
    margin-bottom: 30px;
    gap: 20px;
}
.custom-tab-btn {
    padding: 10px 15px;
    background: none;
    border: none;
    font-size: 16px;
    font-weight: 600;
    color: #6b7280;
    cursor: pointer;
    border-bottom: 3px solid transparent;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}
.custom-tab-btn i {
    color: var(--admin-secondary);
}
.custom-tab-btn:hover {
    color: var(--admin-primary);
}
.custom-tab-btn.active {
    color: var(--admin-primary);
    border-bottom-color: var(--admin-primary);
}
.custom-tab-btn.active i {
    color: var(--admin-primary);
}

/* Tab Pane Styling */
.tab-pane {
    display: none;
    animation: fadeIn 0.3s ease;
}
.tab-pane.active {
    display: block;
}
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(5px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Modern Card Styling */
.modern-card {
    background: #FFFFFF;
    border-radius: 12px;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px -1px rgba(0, 0, 0, 0.1);
    padding: 30px;
    margin-bottom: 30px;
    border: 1px solid #e5e7eb;
}

/* Card Header */
.modern-card-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 25px;
}
.card-icon-circle {
    width: 32px;
    height: 32px;
    background-color: var(--admin-secondary);
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}
.modern-card-title {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

/* Forms */
.form-group label {
    font-size: 14px;
    font-weight: 500;
    color: #374151;
    margin-bottom: 8px;
    display: block;
}
.form-control {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 10px 12px;
    font-size: 14px;
    color: #111827;
    width: 100%;
}
.form-control:focus {
    border-color: var(--admin-secondary);
    outline: none;
    box-shadow: 0 0 0 3px rgba(157, 145, 103, 0.2);
}

.custom-file-upload {
    display: flex;
    align-items: center;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    overflow: hidden;
}
.custom-file-btn {
    background: #f3f4f6;
    border: none;
    border-right: 1px solid #d1d5db;
    padding: 10px 16px;
    font-weight: 500;
    color: #374151;
    cursor: pointer;
    font-size: 14px;
}
.custom-file-text {
    padding: 10px 16px;
    color: #6b7280;
    font-size: 14px;
    flex: 1;
}
.custom-file-input {
    display: none;
}

.btn-primary-custom {
    background-color: var(--admin-secondary);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: 0.2s;
}
.btn-primary-custom:hover {
    background-color: var(--admin-primary);
}

/* Table specific styling */
.table-toolbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.table-toolbar select, .table-toolbar input {
    border: 1px solid #d1d5db;
    border-radius: 6px;
    padding: 8px 12px;
    font-size: 14px;
}
.table-toolbar .search-box {
    position: relative;
}
.table-toolbar .search-box input {
    padding-right: 30px;
    width: 250px;
}
.table-toolbar .search-box i {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #9ca3af;
}

.modern-table {
    width: 100%;
    border-collapse: collapse;
}
.modern-table th {
    background: white;
    color: #111827;
    font-weight: 600;
    font-size: 14px;
    padding: 12px 16px;
    border-bottom: 2px solid #e5e7eb;
    text-align: left;
}
.modern-table td {
    padding: 16px;
    border-bottom: 1px solid #e5e7eb;
    color: #374151;
    font-size: 14px;
    vertical-align: middle;
}
.modern-table tr:hover {
    background: #f9fafb;
}

.badge-kategori {
    background-color: #f3f0e7; /* Light Olive Harvest */
    color: var(--admin-primary);
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 12px;
    font-weight: 600;
    display: inline-block;
}

.btn-action {
    width: 32px;
    height: 32px;
    border-radius: 6px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: white;
    text-decoration: none;
    margin-right: 5px;
    transition: 0.2s;
}
.btn-edit {
    background-color: var(--admin-secondary);
}
.btn-edit:hover {
    background-color: var(--admin-primary);
}
.btn-delete {
    background-color: #ef4444;
}
.btn-delete:hover {
    background-color: #dc2626;
}

.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
    font-size: 14px;
    color: #6b7280;
}
.pagination-controls {
    display: flex;
    gap: 5px;
}
.page-btn {
    border: 1px solid #d1d5db;
    background: white;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    color: #374151;
}
.page-btn.active {
    background: var(--admin-secondary);
    color: white;
    border-color: var(--admin-secondary);
}
</style>

<div class="main-content">
    <div class="topbar">
        <div class="topbar-user">
            <i class="fas fa-user-circle" style="margin-right:5px; color:var(--admin-secondary);"></i> 
            <?= htmlspecialchars($nama_admin) ?>
        </div>
    </div>

    <div class="page-content">
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success" style="background:#dcfce7; color:#166534; border:1px solid #bbf7d0;">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger" style="background:#fee2e2; color:#991b1b; border:1px solid #fecaca;">
                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 24px; font-weight: 700; color: #111827; margin-bottom: 8px;">Kelola Produk & Kategori</h1>
            <p style="color: #6b7280; font-size: 15px; margin: 0;">Kelola data produk dan kategori produk untuk menu Olin's Cake.</p>
        </div>

        <div class="custom-tabs">
            <button class="custom-tab-btn active" onclick="openTab(event, 'tab-produk')" id="btn-tab-produk">
                <i class="fas fa-box"></i> Kelola Produk
            </button>
            <button class="custom-tab-btn" onclick="openTab(event, 'tab-kategori')" id="btn-tab-kategori">
                <i class="fas fa-tags"></i> Kelola Kategori
            </button>
        </div>

        <!-- TAB PRODUK -->
        <div id="tab-produk" class="tab-pane active">
            
            <div class="modern-card">
                <div class="modern-card-header">
                    <div class="card-icon-circle">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="modern-card-title">Tambah Produk Baru</h3>
                </div>
                
                <form action="proses_tambah.php" method="POST" enctype="multipart/form-data">
                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:20px; margin-bottom:20px;">
                        <div class="form-group">
                            <label>Nama Produk</label>
                            <input type="text" name="nama_produk" class="form-control" required placeholder="Contoh: Red Velvet Cake">
                        </div>
                        
                        <div class="form-group">
                            <label>Kategori</label>
                            <select name="id_kategori" class="form-control" required>
                                <option value="">-- Pilih Kategori --</option>
                                <?php while($k = $kategori_options_res->fetch_assoc()): ?>
                                    <option value="<?= $k['id_kategori'] ?>"><?= htmlspecialchars($k['nama_kategori']) ?></option>
                                <?php endwhile; ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Harga (Rp)</label>
                            <input type="number" name="harga" class="form-control" required min="0" placeholder="Contoh: 150000">
                        </div>

                        <div class="form-group">
                            <label>Minimal Pre-Order (Hari)</label>
                            <input type="number" name="minimal_preorder" class="form-control" required min="1" value="2">
                        </div>

                        <div class="form-group">
                            <label>Ukuran</label>
                            <input type="text" name="ukuran" class="form-control" required placeholder="Contoh: 20x20 cm">
                        </div>

                        <div class="form-group">
                            <label>Masa Simpan</label>
                            <input type="text" name="masa_simpan" class="form-control" required placeholder="Contoh: 5 hari di suhu ruang">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom:20px;">
                        <label>Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3" required placeholder="Tulis deskripsi produk di sini..."></textarea>
                    </div>

                    <div class="form-group" style="margin-bottom:25px;">
                        <label>Foto Produk</label>
                        <div class="custom-file-upload">
                            <button type="button" class="custom-file-btn" onclick="document.getElementById('foto_produk_input').click()"><i class="fas fa-image" style="margin-right:5px;"></i> Pilih File</button>
                            <div class="custom-file-text" id="foto_produk_text">Tidak ada file dipilih</div>
                            <input type="file" id="foto_produk_input" name="foto_produk" class="custom-file-input" accept="image/*" required onchange="document.getElementById('foto_produk_text').textContent = this.files[0] ? this.files[0].name : 'Tidak ada file dipilih'">
                        </div>
                        <small style="color:#6b7280; font-size:12px; display:block; margin-top:5px;">Format yang didukung: JPG, JPEG, PNG. Maks: 2MB.</small>
                    </div>

                    <button type="submit" class="btn-primary-custom"><i class="fas fa-save"></i> Simpan Produk</button>
                </form>
            </div>

            <div class="modern-card">
                <h3 class="modern-card-title" style="margin-bottom: 20px;">Daftar Produk</h3>
                
                <div class="table-toolbar">
                    <div style="display:flex; align-items:center; gap:10px; font-size:14px; color:#374151;">
                        <select id="produk-per-page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span>data per halaman</span>
                    </div>
                    <div class="search-box">
                        <input type="text" id="search-produk" placeholder="Cari produk..." onkeyup="filterTable('search-produk', 'table-produk')">
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="modern-table" id="table-produk">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th style="width:80px;">Foto</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Pre-Order (Hari)</th>
                                <th>Masa Simpan</th>
                                <th style="width:120px; text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($produk_res->num_rows > 0): ?>
                                <?php $no = 1; while($row = $produk_res->fetch_assoc()): ?>
                                <tr class="data-row">
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <img src="../../assets/images/<?= htmlspecialchars($row['foto_produk'] ?: 'product1.png') ?>" alt="Foto" style="width:48px; height:48px; object-fit:cover; border-radius:6px; border:1px solid #e5e7eb;">
                                    </td>
                                    <td style="font-weight:500; color:#111827;"><?= htmlspecialchars($row['nama_produk']) ?></td>
                                    <td><span class="badge-kategori"><?= htmlspecialchars($row['nama_kategori']) ?></span></td>
                                    <td style="font-weight:600; color:#111827;">Rp<?= number_format($row['harga'],0,',','.') ?></td>
                                    <td><?= $row['minimal_preorder'] ?> Hari</td>
                                    <td><?= htmlspecialchars($row['masa_simpan']) ?></td>
                                    <td style="text-align:center;">
                                        <a href="edit.php?id=<?= $row['id_produk'] ?>" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="hapus.php?id=<?= $row['id_produk'] ?>" class="btn-action btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus produk ini?');"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr class="no-data"><td colspan="8" style="text-align:center; padding:30px; color:#6b7280;">Belum ada data produk.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <div class="pagination">
                    <div id="produk-info">Menampilkan semua data</div>
                    <div class="pagination-controls">
                        <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

        </div>

        <!-- TAB KATEGORI -->
        <div id="tab-kategori" class="tab-pane">
            
            <div class="modern-card" style="max-width: 600px;">
                <div class="modern-card-header">
                    <div class="card-icon-circle">
                        <i class="fas fa-plus"></i>
                    </div>
                    <h3 class="modern-card-title">Tambah Kategori Baru</h3>
                </div>
                <form action="../kategori/proses_tambah.php" method="POST">
                    <div class="form-group">
                        <label>Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" required placeholder="Contoh: Kue Kering Spesial">
                    </div>
                    <button type="submit" class="btn-primary-custom" style="margin-top:10px;"><i class="fas fa-save"></i> Simpan Kategori</button>
                </form>
            </div>

            <div class="modern-card">
                <h3 class="modern-card-title" style="margin-bottom: 20px;">Daftar Kategori</h3>
                
                <div class="table-toolbar">
                    <div style="display:flex; align-items:center; gap:10px; font-size:14px; color:#374151;">
                        <select id="kategori-per-page">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                        </select>
                        <span>data per halaman</span>
                    </div>
                    <div class="search-box">
                        <input type="text" id="search-kategori" placeholder="Cari kategori..." onkeyup="filterTable('search-kategori', 'table-kategori')">
                        <i class="fas fa-search"></i>
                    </div>
                </div>

                <div style="overflow-x:auto;">
                    <table class="modern-table" id="table-kategori">
                        <thead>
                            <tr>
                                <th style="width:50px;">No</th>
                                <th>Nama Kategori</th>
                                <th style="width:120px; text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($kategori_res->num_rows > 0): ?>
                                <?php $no = 1; while($row = $kategori_res->fetch_assoc()): ?>
                                <tr class="data-row">
                                    <td><?= $no++ ?></td>
                                    <td style="font-weight:500; color:#111827;"><span class="badge-kategori"><?= htmlspecialchars($row['nama_kategori']) ?></span></td>
                                    <td style="text-align:center;">
                                        <a href="../kategori/edit.php?id=<?= $row['id_kategori'] ?>" class="btn-action btn-edit" title="Edit"><i class="fas fa-edit"></i></a>
                                        <a href="../kategori/proses_hapus.php?id=<?= $row['id_kategori'] ?>" class="btn-action btn-delete" title="Hapus" onclick="return confirm('Yakin ingin menghapus kategori ini?');"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr class="no-data"><td colspan="3" style="text-align:center; padding:30px; color:#6b7280;">Belum ada data kategori.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
                
                <div class="pagination">
                    <div id="kategori-info">Menampilkan semua data</div>
                    <div class="pagination-controls">
                        <button class="page-btn"><i class="fas fa-chevron-left"></i></button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn"><i class="fas fa-chevron-right"></i></button>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<script>
function openTab(evt, tabId) {
    var i, tabcontent, tablinks;
    
    // Sembunyikan semua tab content
    tabcontent = document.getElementsByClassName("tab-pane");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].classList.remove("active");
    }
    
    // Hapus class active dari semua tombol tab
    tablinks = document.getElementsByClassName("custom-tab-btn");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
    }
    
    // Tampilkan tab yang dipilih dan tambahkan class active pada tombol
    document.getElementById(tabId).classList.add("active");
    evt.currentTarget.classList.add("active");
    
    // Update URL agar ketika direfresh tetap berada di tab yang sama
    const url = new URL(window.location);
    url.searchParams.set('tab', tabId.replace('tab-', ''));
    window.history.pushState({}, '', url);
}

// Simple filter table function
function filterTable(inputId, tableId) {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = document.getElementById(inputId);
    filter = input.value.toLowerCase();
    table = document.getElementById(tableId);
    tr = table.getElementsByClassName("data-row");

    var visibleCount = 0;
    for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td");
        found = false;
        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }
        if (found) {
            tr[i].style.display = "";
            visibleCount++;
        } else {
            tr[i].style.display = "none";
        }
    }
    
    // Update info text
    var infoId = tableId.replace('table-', '') + '-info';
    var infoEl = document.getElementById(infoId);
    if(infoEl) {
        if(filter === '') {
            infoEl.innerText = "Menampilkan semua data (" + tr.length + ")";
        } else {
            infoEl.innerText = "Menampilkan " + visibleCount + " data pencarian";
        }
    }
}

// Cek URL param saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const tab = urlParams.get('tab');
    
    if (tab === 'kategori') {
        const btn = document.getElementById('btn-tab-kategori');
        if(btn) btn.click();
    }
    
    // Init info text
    var trProd = document.getElementById('table-produk').getElementsByClassName("data-row");
    if(document.getElementById('produk-info')) document.getElementById('produk-info').innerText = "Menampilkan 1 sampai " + trProd.length + " dari " + trProd.length + " data";
    
    var trKat = document.getElementById('table-kategori').getElementsByClassName("data-row");
    if(document.getElementById('kategori-info')) document.getElementById('kategori-info').innerText = "Menampilkan 1 sampai " + trKat.length + " dari " + trKat.length + " data";
});
</script>

<?php include '../bagian/footer.php'; ?>
