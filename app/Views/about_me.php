<?= $this->extend('home') ?>

<?= $this->section('content') ?>
<div class="container mt-2">
    <div class="row">
        <div class="col-lg-12 text-center h-50">
            <h2>Tentang Saya</h2>
            <div class="text-center">
                <div class="row">
                    <div class="col-lg-12" style="display:flex;flex-direction:column;align-items:center;justify-content:space-evenly;">
                    <div style="width: 200px;height:200px;clip-path:circle();background:url(<?= base_url('../../image/pic.jpg')?>);background-size:cover;" class="m-3"></div>
                        <h4 class="mt-3">NIKO SAPUTRA</h4>
                        <p>Saya adalah Niko Saputra, seorang fresh graduate yang memiliki keahlian dalam pemrograman. Dengan pengalaman dalam HTML, CSS, dan JavaScript, serta pengetahuan dasar tentang Laravel, React.js, Bootstrap, dan CodeIgniter, saya siap membantu Anda mewujudkan proyek-proyek menarik dan menciptakan solusi yang inovatif. Saya bersemangat dan terus belajar dan mengasah keterampilan saya untuk memberikan hasil terbaik. Dengan dedikasi dan kreativitas, saya siap menghadirkan solusi teknologi yang meyakinkan dan memenuhi kebutuhan Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>