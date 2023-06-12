<?= $this->extend("home") ?>
<?= $this->section('content') ?>
<?php if ($isLoggedIn) : ?>
  <?php $user = service('authentication')->user(); ?>
  <h2>Selamat datang, <?= esc($user->username) ?></h2>
  <hr>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Daftar Buku</h3>
          </div>
          <div class="card-body">
            <div class="row row-cols-md-2" id="daftarBuku">
              <!-- Daftar buku akan ditampilkan di sini -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<style>
  .card {
    height: 100%;
  }

  .card-body {
    padding: 0;
  }

  .card-img-top {
    width: 100%;
    object-fit: cover;
    height: 200px;
    /* Ubah ukuran gambar sesuai kebutuhan */
  }

  .col-md-2 {
    margin-bottom: 20px;
    height: 100%;
  }

  .btn-favorite {
    margin-top: 10px;
  }

  .card-title {
    height: 60px;
    /* Sesuaikan dengan kebutuhan */
    margin-bottom: 0;
  }

  .card-text {
    height: 40px;
    /* Sesuaikan dengan kebutuhan */
    margin-bottom: 0;
  }
</style>

<script>
  function ambilDataBukuGratis() {
    const url = 'https://openlibrary.org/subjects/action.json?limit=100';

    fetch(url)
      .then(response => response.json())
      .then(data => {
        tampilkanDaftarBuku(data.works);
      })
      .catch(error => {
        console.log('Error:', error);
      });
  }

  function tampilkanDaftarBuku(works) {
    const daftarBukuContainer = document.getElementById('daftarBuku');

    // Hapus konten yang ada sebelumnya
    daftarBukuContainer.innerHTML = '';

    if (works && works.length > 0) {
      works.forEach(work => {
        const judul = work.title;
        const penulis = work.authors ? work.authors[0].name : 'Penulis tidak diketahui';
        const tahun = work.first_publish_year ? work.first_publish_year : 'Tahun tidak diketahui';
        const coverId = work.cover_id;

        const card = document.createElement('div');
        card.classList.add('col-md-3'); // Menggunakan col-md-2 untuk tampilan 1 baris berisi 5 buku

        // Mengambil URL gambar buku dari Open Library Covers API
        const imageUrl = `https://covers.openlibrary.org/b/id/${coverId}-M.jpg`;

        card.innerHTML = `
          <div class="card text-center mt-2">
            <img src="${imageUrl}" class="card-img-top" alt="${judul}">
            <div class="card-body">
              <p class="card-text mt-2"><b>${judul}</b></p>
              <p class="card-text">Penulis: ${penulis}</p>
              <p class="card-text">Tahun: ${tahun}</p>
              <button class="btn btn-primary btn-favorite" onclick="tambahKeFavorit('${judul}')">Tambah ke Favorit</button>
            </div>
          </div>
        `;

        daftarBukuContainer.appendChild(card);
      });
    } else {
      daftarBukuContainer.innerHTML = '<p>Tidak ada buku yang ditemukan.</p>';
    }
  }

  function tambahKeFavorit(judul, coverId) {
    // Mengecek apakah data buku favorit sudah ada di localStorage
    const bukuFavorit = JSON.parse(localStorage.getItem('bukuFavorit')) || [];

    // Mengecek apakah buku sudah ada di daftar favorit
    const isBukuSudahFavorit = bukuFavorit.some(buku => buku.judul === judul, buku => buku.coverId === coverId);

    if (!isBukuSudahFavorit) {
      // Menambahkan buku ke daftar favorit
      bukuFavorit.push({
        judul,
        coverId
      });

      // Menyimpan daftar favorit di localStorage
      localStorage.setItem('bukuFavorit', JSON.stringify(bukuFavorit));
      console.log(bukuFavorit)
      alert(`Buku "${judul}" ditambahkan ke favorit!`);
    } else {
      alert(`Buku "${judul}" sudah ada di favorit!`);
    }
  }


  ambilDataBukuGratis();
</script>

<?= $this->endSection() ?>