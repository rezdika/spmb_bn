@extends('user.main')

@section('title', 'Sambutan Kepala Sekolah - SMK Bakti Nusantara 666')

@section('content')
<!-- Breadcrumb -->
<section class="py-3" style="background-color: #F8F9FA;">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" style="color: #1B1A55;">Beranda</a></li>
                <li class="breadcrumb-item"><span style="color: #647FBC;">Profil Sekolah</span></li>
                <li class="breadcrumb-item active" aria-current="page">Sambutan Kepala Sekolah</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Sambutan Kepala Sekolah -->
<section class="py-5" style="background-color: white;">
    <div class="container">
        <div class="row align-items-center">
            <!-- Foto Kepala Sekolah -->
            <div class="col-lg-4 col-md-5 mb-4 mb-md-0">
                <div class="text-center">
                    <img src="{{ asset('assets/image/sambutan.png') }}" alt="Kepala Sekolah SMK Bakti Nusantara 666" class="img-fluid rounded-3 shadow-lg" style="width: 100%; max-width: 400px; height: 450px; object-fit: cover;">
                </div>
            </div>
            
            <!-- Sambutan Text -->
            <div class="col-lg-8 col-md-7">
                <div class="ps-lg-4">
                    <div class="mb-4">
                        <span class="badge px-3 py-2 mb-3" style="background-color: #F5E8C7; color: #1B1A55; font-size: 14px;">
                            <i class="fas fa-quote-left me-2"></i>Sambutan Kepala Sekolah
                        </span>
                        <h2 class="fw-bold mb-4" style="color: #1B1A55; line-height: 1.3;">
                            Selamat Datang di SMK Bakti Nusantara 666
                        </h2>
                    </div>
                    
                    <div style="color: #495057; line-height: 1.8; text-align: justify;">
                        <p class="mb-4">
                            <strong>Assalamu'alaikum Warahmatullahi Wabarakatuh,</strong>
                        </p>
                        
                        <p class="mb-4">
                            Puji syukur kehadirat Allah SWT yang telah memberikan rahmat dan karunia-Nya sehingga SMK Bakti Nusantara 666 dapat terus berkembang dan memberikan kontribusi terbaik dalam dunia pendidikan kejuruan di Indonesia.
                        </p>
                        
                        <p class="mb-4">
                            Sebagai Kepala Sekolah, saya dengan bangga menyambut Anda di website resmi SMK Bakti Nusantara 666. Sekolah kami berkomitmen untuk mencetak lulusan yang tidak hanya unggul dalam kompetensi teknis, tetapi juga memiliki karakter yang kuat berdasarkan nilai-nilai <strong>SAJUTA</strong> - <em>Santun, Jujur, dan Taat</em>.
                        </p>
                        
                        <p class="mb-4">
                            Dengan didukung oleh tenaga pendidik yang profesional, fasilitas pembelajaran yang modern, dan kurikulum yang selaras dengan kebutuhan industri, kami yakin dapat menghasilkan lulusan yang siap bersaing di era global dan mampu berkontribusi positif bagi pembangunan bangsa.
                        </p>
                        
                        <p class="mb-4">
                            Kepada para calon peserta didik dan orang tua, kami mengundang Anda untuk bergabung bersama keluarga besar SMK Bakti Nusantara 666. Mari bersama-sama membangun masa depan yang gemilang melalui pendidikan berkualitas.
                        </p>
                        
                        <p class="mb-4">
                            <strong>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</strong>
                        </p>
                        
                        <div class="mt-4 pt-3" style="border-top: 2px solid #F5E8C7;">
                            <p class="mb-2 fw-bold" style="color: #1B1A55;">Drs. H. Ahmad Suryadi, M.Pd</p>
                            <p class="mb-0" style="color: #647FBC; font-size: 0.95rem;">Kepala Sekolah SMK Bakti Nusantara 666</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
</section>
@endsection