@extends('user.main')

@section('title', 'Visi & Misi - SMK Bakti Nusantara 666')

@section('hero')
<section class="position-relative" style="height: 400px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <h1 class="text-white text-center display-4 fw-bold">Visi & Misi</h1>
    </div>
</section>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Visi & Misi</li>
        </ol>
    </div>
</nav>
@endsection

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Profil Sekolah</h3>
                        <table class="table table-borderless">
                            <tr>
                                <td width="200"><strong>Nama Sekolah</strong></td>
                                <td>: SMK Bakti Nusantara 666</td>
                            </tr>
                            <tr>
                                <td><strong>NPSN</strong></td>
                                <td>: 20267919</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: Swasta</td>
                            </tr>
                            <tr>
                                <td><strong>Akreditasi</strong></td>
                                <td>: A</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat</strong></td>
                                <td>: Jl Perobaan No.65 Cileunyi Kab.Bandung Jawa Barat 40393</td>
                            </tr>
                            <tr>
                                <td><strong>No Telp</strong></td>
                                <td>: 022-63730220</td>
                            </tr>
                            <tr>
                                <td><strong>Email</strong></td>
                                <td>: baknus@smkbn666.com</td>
                            </tr>
                            <tr>
                                <td><strong>Website</strong></td>
                                <td>: www.smkbn666.sch.id</td>
                            </tr>
                            <tr>
                                <td><strong>Kepala Sekolah</strong></td>
                                <td>: Dani Wardani, S.Hum., M.Pd.</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Profil</h3>
                        <p class="text-justify">SMK Bakti Nusantara 666 adalah Sekolah Menengah Kejuruan berbasis Industri kreatif, terletak di Kawasan Bandung Bandung timur yang beridiri sejak tahun 2007. Dengan tenaga pengajar yang Profesional dan kompeten dibidangnya. SMK Bakti Nusantara 666 telah terakreditasi A dan memiliki khas tersendiri dalam membentuk karakter siswa melalui program unggulan sehingga menghasilkan lulusan berkualitas sehingga langsung diserap oleh industri.</p>
                        
                        <h5 class="mt-4 mb-3">SMK Bakti Nusantara 666 memiliki kelompok kompetensi keahlian:</h5>
                        <ol>
                            <li>Pengembangan Perangkat Lunak dan Gim</li>
                            <li>Desain Komunikasi Visual</li>
                            <li>Animasi</li>
                            <li>Akuntansi dan Keuangan Lembaga</li>
                            <li>Bisnis Daring dan Pemasaran</li>
                        </ol>
                        
                        <p class="text-justify mt-3">Keberadaannya didukung oleh dunia usaha dan dunia industri, baik dalam pembelajaran maupun penyerapan lulusannya. Pembelajaran teori dan praktek tidak hanya dilakukan di dalam kelas tetapi di dunia industri melalui praktek kerja industri di perusahaan yang relevan. Memasuki pergaulan global yang penuh dengan kompetisi ini, kita perlu menyiapkan mental anak-anak kita agar mampu bersaing dengan baik dengan memiliki akhlaq, kemandirian, kecerdasan, juga tentunya kreatifitas dan inovasi yang sesuai tumbuh kembangnya. SMK Bakti Nusantara 666 berpartisipasi membangun masyarakat pembelajar dalam menyongsong era baru dan menjadikan anak-anak kita generasi yang mampu berkompetisi tanpa kehilangan wajah budaya dan moral.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Visi</h3>
                        <p class="text-justify">Menjadi lembaga pendidikan dan pelatihan yang mampu membentuk insan religius, kompeten, disiplin, inovatif, unggul dalam prestasi dan mandiri di tahun 2024</p>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Misi</h3>
                        <ol>
                            <li>Membentuk warga sekolah yang taat beribadah kepada Tuhan Yang Maha Esa (insan religius)</li>
                            <li>Menyiapkan warga sekolah yang mampu menguasai ilmu pengetahuan dan teknologi terutama dibidang kejuruan yang dipelajari (kompeten)</li>
                            <li>Membentuk warga sekolah yang menghargai waktu, taat pada aturan dan memiliki komitmen yang kuat terhadap peningkatan kualitas diri (disiplin)</li>
                            <li>Membentuk warga sekolah yang mampu menyelesaikan permasalahan dengan cara baru (inovatif)</li>
                            <li>Membentuk warga sekolah yang mampu bersaing secara akademik maupun non akademik untuk menghadapi tantangan lokal dan nasional (unggul dalam prestasi)</li>
                            <li>Membentuk warga sekolah yang mampu melakukan sesuatu sendiri (mandiri)</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
