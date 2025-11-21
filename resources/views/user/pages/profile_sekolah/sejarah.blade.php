@extends('user.main')

@section('title', 'Sejarah - SMK Bakti Nusantara 666')

@section('hero')
<section class="position-relative" style="height: 400px; background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('{{ asset('assets/image/hero_section/sekolah1.png') }}'); background-size: cover; background-position: center;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <h1 class="text-white text-center display-4 fw-bold">Sejarah</h1>
    </div>
</section>
@endsection

@section('breadcrumb')
<nav aria-label="breadcrumb" class="bg-light py-3">
    <div class="container">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="fas fa-home"></i> Home</a></li>
            <li class="breadcrumb-item active">Sejarah</li>
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
                      <img src="{{ asset('assets/image/peresmiangedung.png') }}" alt="Foto Bersama Tenaga Pendidik" class="img-fluid rounded shadow" style="max-height: 500px; width: 100%; object-fit: cover;">
    
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Peresmian Gedung Sekolah Pusat Keunggulan SMK Nusantara 666</h3>
                        <p class="text-justify">SMK Bakti Nusantara 666 yang berlokasi di Jalan Percobaan Cileunyi KM17.1 No.65 Kabipaten Bandung menjadi salah satu SMK di Kabupaten Bandung yang terpilih sebagai SMK Pusat Keunggulan. Pada Rabu (15/12/2021) dilakukan peresmian Gedung Praktik SMK PK Bakti Nusantara 666. Gedung yang merupakan bagian dari bantuan pemerintah senilai 2,4 miliar tersebut diserahkan oleh Disdik Provinsi Jawa Barat yang diwakili oleh Dr. Hj Otin Martini, M.Pd selaku KCD wilayah 8 kepada Pembina Yayasan H. Nandang AT dan Kepala SMK Bakti Nusantara 666 Dani Wardani, S.Hum, M.Pd disaksikan oleh pengurus yayasan lainnya, Perwakilan DUDI, Disdik Jabar, Politeknik Negeri Bandung, BBPPMPV KPTK Gowa, Orang tua siswa, siswa dan undangan lainnya.</p>
                        <p class="text-justify">Program SMK Pusat Keunggulan itu sendiri bertujuan untuk menghasilkan lulusan yang terserap di dunia kerja atau menjadi wirausaha melalui keselarasan pendidikan vokasi yang mendalam dan menyeluruh dengan dunia kerja.</p>
                        <p class="text-justify">Sekolah yang terpilih dalam program SMK Pusat Keunggulan diharapkan menjadi rujukan serta melakukan pengimbasan untuk mendorong peningkatan kualitas dan kinerja SMK di sekitarnya. Dengan terpilihnya SMK Bakti Nusantara menjadi SMK Pusat Keunggulan, sekolah kami ditantang untuk kedepannya agar bisa lebih baik lagi.</p>
                        <p class="text-justify">Adapun pelaksana pendampingan SMK PK Bakti Nusantara 666 dilakukan oleh perguruan tinggi yang telah memenuhi kriteria yakni Politeknik Negeri Bandung (POLBAN) dan Pendamping dari Balai Besar Penjaminan Mutu Pendidikan Vokasi KPTK Gowa Makasar juga langsung dibawah Kepala Bidang SMK Disdik Jabar.</p>
                        <p class="text-justify">Dalam segi kompetensi keahlian Rekayasa Perangkat Lunak (RPL) serta potensi dan sektor pengembangan Ekonomi Kreatif, SMK PK Bakti Nusantara 666 saat ini berkolaborasi dengan kompetensi keahlian lain yaitu Akuntansi, Animasi, Desain Komunikasi Visual(DKV) dan Pemasaran. KCD wilayah 8 Dinas Provinsi Jawa Barat, Dr Hj Otin Martini MPd mengatakan harapannya bahwa SMK PK Bakti Nusantara 666 lulusannya mampu berkompetisi BMW (Bekerja, Melanjutkan ke jenjang lebih tinggi dan Wirausaha).</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Workshop Penyelarasan Kurikulum Dan Penyusunan Bahan Ajar</h3>
                        <p class="text-justify">Proses pelibatan DUDI bisa dalam pengembangan kurikulum sehingga kurikulum menjadi lebih relevan dengan kebutuhan. DUDI juga bisa memberikan pelatihan bagi guru dan tenaga pendidik agar terus memutakhirkan pengetahuan dengan mengikuti perkembangan mesin atau teknik yang sesuai dengan program kejuruan. Ada kalanya DUDI mengirimkan tenaga profesionalnya sebagai guru pendamping atau mentor agar peserta didik berinteraksi langsung dengan para profesional.</p>
                        <p class="text-justify">Sesuai dengan UU Sisdiknas Nomor 23 Tahun 2013, DUDI juga bisa dilibatkan dalam pembiayaan pendidikan. Di sekolah yang erat kerja samanya dengan DUDI, DUDI juga bisa dilibatkan dalam pembangunan laboratorium atau tempat praktik atau pemberian bantuan peralatan praktik di sekolah. Sekolah yang erat hubungannya dengan DUDI dan bisa menerapkan praktik keahlian ganda dipastikan bisa menghasilkan lulusan yang dibutuhkan oleh DUDI.</p>
                        <p class="text-justify">Walau sudah menjalin kerja sama dengan DUDI, tidak semua lulusan pendidikan vokasi bisa diterima pada perusahaan atau industri yang terkait dengan program keahliannya. Oleh karena itu, peserta didik diharapkan bisa memiliki kemampuan berwirausaha (entrepreneurship), sehingga bukan hanya menjadi tenaga kerja yang terampil, tetapi juga mampu menciptakan usaha baru atau menciptakan profesi baru.</p>
                        <p class="text-justify">Maka dari itu untuk memenuhi kebutuhan lulusan atau tamatan yang sesuai dengan kebutuhan DUDI, SMK Bakti Nusantara 666 melakukan penguatan kerjasama sekolah dengan DUDI dan penyelerasan kurikulum agar terjalin Link & Match (8 + i) keterlibatan dunia kerja di segala aspek penyelenggaraan pendidikan vokasi.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Workshop Penjajakan Dan Penguatan Kerja Sama Sekolah Dengan DUDI</h3>
                        <p class="text-justify">Pendidikan vokasi yang baik adalah pendidikan vokasi yang juga menghasilkan lulusan yang sesuai dengan kebutuhan DUDI. Untuk bisa melakukan hal tersebut, proses belajar-mengajar haruslah sesuai dan selaras dengan DUDI. Kehadiran DUDI bukan hanya sebagai tempat bagi peserta didik pendidikan vokasi untuk melakukan praktik magang. Namun, pelibatan DUDI harus merefleksikan implementasi dari keahlian ganda DUDI dengan sekolah agar tujuan pendidikan bisa tercapai.</p>
                        <p class="text-justify">Proses pelibatan DUDI bisa dalam pengembangan kurikulum sehingga kurikulum menjadi lebih relevan dengan kebutuhan. DUDI juga bisa memberikan pelatihan bagi guru dan tenaga pendidik agar terus memutakhirkan pengetahuan dengan mengikuti perkembangan mesin atau teknik yang sesuai dengan program kejuruan. Ada kalanya DUDI mengirimkan tenaga profesionalnya sebagai guru pendamping atau mentor agar peserta didik berinteraksi langsung dengan para profesional.</p>
                        <p class="text-justify">Sesuai dengan UU Sisdiknas Nomor 23 Tahun 2013, DUDI juga bisa dilibatkan dalam pembiayaan pendidikan. Di sekolah yang erat kerja samanya dengan DUDI, DUDI juga bisa dilibatkan dalam pembangunan laboratorium atau tempat praktik atau pemberian bantuan peralatan praktik di sekolah. Sekolah yang erat hubungannya dengan DUDI dan bisa menerapkan praktik keahlian ganda dipastikan bisa menghasilkan lulusan yang dibutuhkan oleh DUDI.</p>
                        <p class="text-justify">Walau sudah menjalin kerja sama dengan DUDI, tidak semua lulusan pendidikan vokasi bisa diterima pada perusahaan atau industri yang terkait dengan program keahliannya. Oleh karena itu, peserta didik diharapkan bisa memiliki kemampuan berwirausaha (entrepreneurship), sehingga bukan hanya menjadi tenaga kerja yang terampil, tetapi juga mampu menciptakan usaha baru atau menciptakan profesi baru.</p>
                        <p class="text-justify">Maka dari itu untuk memenuhi kebutuhan lulusan atau tamatan yang sesuai dengan kebutuhan DUDI, SMK Bakti Nusantara 666 melakukan penguatan kerjasama sekolah dengan DUDI dan penyelerasan kurikulum agar terjalin Link & Match (8 + i) keterlibatan dunia kerja di segala aspek penyelenggaraan pendidikan vokasi.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm border-0">
                    <div class="card-body p-4">
                        <h3 class="mb-4" style="color: #1B1A55;">Sosialisasi Pengembangan SMK Pusat Keunggulan</h3>
                        <p class="text-justify">SMK Bakti Nusantara 666 menjadi salah satu sekolah yang ditunjuk oleh pemerintah menjadi smk pusat keunggulan, sesuai dengan acuan Kepmendikbudristek no 165 tahun 2021, pengembangan SMK menjadi Pusat Keunggulan (Center of Excellence) secara khusus, bertujuan untuk:</p>
                        <ol>
                            <li>Memperkuat kemitraan antara Kemendikbud dan pemerintah daerah dalam pendampingan program SMK Pusat Keunggulan;</li>
                            <li>Memperkuat kualitas sumber daya manusia SMK, antara lain kepala SMK, pengawas sekolah, dan guru untuk mewujudkan manajemen dan pembelajaran berbasis dunia kerja;</li>
                            <li>Memperkuat kompetensi keterampilan nonteknis (soft skills) dan keterampilan teknis (hard skills) peserta didik yang sesuai dengan kebutuhan dunia kerja, serta mengembangkan karakter yang sesuai dengan nilai-nilai Pancasila;</li>
                            <li>Mewujudkan perencanaan yang berbasis data melalui manajemen berbasis sekolah;</li>
                            <li>Meningkatkan efisiensi dan mengurangi kompleksitas pada sekolah dengan menggunakan platform digital;</li>
                            <li>Peningkatan sarana dan prasarana praktik belajar siswa yang berstandar dunia kerja; dan</li>
                            <li>Memperkuat kemitraan dan kerja sama antara Kemendikbud dengan dunia kerja dalam pengembangan dan pendampingan Program SMK Pusat Keunggulan.</li>
                        </ol>
                        <p class="text-justify">SMK Bakti Nusantara 666 melalui program bantuan pemerintah pengembangan sekolah menjadi smk pusat keunggulan berusaha memenuhi tujuan tersebut. Dalam surat penunjukkan SMK penerima bantuan smk pusat keunggulan disebutkan bahwa sekolah yang ditunjuk setelah mendapatkan bantuan dalam kurun waktu tiga tahun harus dapat bertrasnformasi mengarah pada peningkatan baik kualitas maupun kuantitas, terutama dalam delapan ruang lingkup kerja sama (link and match) smk dengan dunia usaha atau dunia industri.</p>
                        <p class="text-justify">Maka dari itu SMK Bakti Nusantara 666 melaksanakan kegiatan sosialisasi pengembangan SMK PK pada warga sekolah, dihadiri oleh Direktur pendidkan YPDM Bakti Nusantara 666 (H.Suherman., S.E., M.M), Kepala SMK Bakti Nusantara 666 (Dani Wardani, S.Hum., M.Pd), Pengawas Sekolah (Drs. Lukman., M.Pd), Ketua Jurusan TIK Politeknik Bandung (Bambang Wisnuadhi, S.Si., M.T) dan perwakilan DU/DI PT. Inovindo Digital Media (Doni Romdoni, A.Md.Kom) dan dengan kegiatan ini diharapkan peserta dapat:</p>
                        <ol>
                            <li>Memahami dasar program smk pusat keunggulan;</li>
                            <li>Mengetahui dan memahami kebijakan Kemendikbud dan YPDM Bakti Nusantara 666 terkait pengembangan SMK Pusat Keunggulan;</li>
                            <li>Mengetahui dan memahami dasar pokok atau elemen penting super link and match sekolah dengan DUDI dalam 8+i ruang lingkup;</li>
                            <li>Kepemimpinan pendidik dan tenaga pendidikan makin terasah</li>
                            <li>Motivasi pendidik dan tenaga pendidikan meningkat</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
