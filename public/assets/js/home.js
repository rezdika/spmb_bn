// Home Page JavaScript Functions

function toggleText() {
    const shortText = document.getElementById('shortText');
    const fullText = document.getElementById('fullText');
    
    if (fullText.style.display === 'none') {
        shortText.style.display = 'none';
        fullText.style.display = 'block';
    } else {
        shortText.style.display = 'block';
        fullText.style.display = 'none';
    }
}

function showFacility(index) {
    const facilities = [
        {
            image: '/assets/image/fasilitas/labkom.jpg',
            title: 'Laboratorium Komputer Modern',
            description: 'Laboratorium komputer modern yang dilengkapi lebih dari 40 perangkat PC dengan spesifikasi tinggi, koneksi internet stabil, serta software pendukung untuk pemrograman, desain grafis, jaringan komputer, hingga simulasi industri digital.'
        },
        {
            image: '/assets/image/fasilitas/labgambar.jpg',
            title: 'Laboratorium Gambar',
            description: 'Ruang khusus bagi siswa untuk belajar dasar menggambar teknik, ilustrasi, dan desain digital. Dilengkapi drawing table, alat gambar lengkap, serta perangkat komputer grafis untuk mendukung kreativitas dan penguasaan konsep visual.'
        },
        {
            image: '/assets/image/fasilitas/labcom.jpg',
            title: 'laboratorium maintenance',
            description: 'Fasilitas praktik untuk pembelajaran perakitan komputer, perawatan hardware, troubleshooting, instalasi sistem operasi, dan simulasi kerja teknisi komputer sesuai standar industri.'
        },
            {
            image: '/assets/image/fasilitas/Perpus.jpg',
            title: 'Perpustakaan',
            description: 'Perpustakaan nyaman dengan koleksi buku pelajaran, referensi, literatur umum, dan beragam sumber digital. Dilengkapi area membaca, komputer katalog, dan suasana tenang yang mendukung aktivitas belajar siswa.'
             },
        {
            image: '/assets/image/fasilitas/ruangbk.jpg',
            title: 'Ruang BK',
            description: 'Ruang Bimbingan Konseling yang didesain untuk memberikan layanan konseling akademik, pribadi, dan karier. Nyaman dan privat untuk membantu siswa mendapatkan pendampingan terbaik selama belajar di sekolah.'
             },
        {
            image: '/assets/image/fasilitas/ruangcctv.jpg',
            title: 'Ruang CCTV & Keamanan',
            description: 'Ruang pengawasan sekolah yang dilengkapi sistem CCTV terintegrasi untuk memastikan keamanan lingkungan sekolah. Seluruh area sekolah dapat dipantau secara real-time melalui layar monitor beresolusi tinggi.'
        }
    ];
    
    // Update image
    document.getElementById('facilityImage').src = facilities[index].image;
    
    // Update content
    document.getElementById('facilityTitle').textContent = facilities[index].title;
    document.getElementById('facilityDescription').textContent = facilities[index].description;
    
    // Update active state
    document.querySelectorAll('.facility-item').forEach((item, i) => {
        item.classList.toggle('active', i === index);
    });
}

function showTestimonial(index) {
    const testimonials = [
        {
            image: '/assets/image/siswa/pplg.png',
            avatar: '/assets/image/siswa/pplg.png',
            name: 'Rizky Pratama',
            position: 'Software Engineer at Gojek',
            quote: 'SMK Bakti Nusantara 666 benar-benar mengubah hidup saya. Dari siswa biasa menjadi Software Engineer di perusahaan unicorn dengan gaji yang tidak pernah saya bayangkan sebelumnya.'
        },
        {
            image: '/assets/image/siswa/dkv.png',
            avatar: '/assets/image/siswa/dkv.png',
            name: 'Anisa Putri',
            position: 'UI/UX Designer at Tokopedia',
            quote: 'Jurusan DKV di SMK Bakti Nusantara 666 memberikan saya fondasi yang kuat dalam desain. Sekarang saya bekerja sebagai UI/UX Designer di salah satu unicorn terbesar Indonesia.'
        },
        {
            image: '/assets/image/siswa/akt.png',
            avatar: '/assets/image/siswa/akt.png',
            name: 'Budi Santoso',
            position: 'Finance Manager at Bank Mandiri',
            quote: 'Ilmu akuntansi yang saya pelajari di SMK Bakti Nusantara 666 sangat aplikatif. Sekarang saya menjadi Finance Manager di bank terbesar Indonesia.'
        },
        {
            image: '/assets/image/siswa/siswa1.png',
            avatar: '/assets/image/siswa/siswa1.png',
            name: 'Sari Dewi',
            position: 'Entrepreneur - Owner of Digital Agency',
            quote: 'SMK Bakti Nusantara 666 tidak hanya mengajarkan skill teknis, tapi juga jiwa entrepreneurship. Sekarang saya memiliki digital agency dengan 20+ karyawan.'
        },
        {
            image: '/assets/image/siswa/pplg.png',
            avatar: '/assets/image/siswa/pplg.png',
            name: 'Dimas Pratama',
            position: 'Mobile Developer at Bukalapak',
            quote: 'Pembelajaran mobile development di SMK Bakti Nusantara 666 sangat up-to-date. Saya langsung diterima kerja sebagai Mobile Developer setelah lulus.'
        },
        {
            image: '/assets/image/siswa/dkv.png',
            avatar: '/assets/image/siswa/dkv.png',
            name: 'Maya Sari',
            position: 'Creative Director at Advertising Agency',
            quote: 'Kreativitas yang diasah di SMK Bakti Nusantara 666 membawa saya menjadi Creative Director di agency advertising ternama. Terima kasih SMK BN 666!'
        }
    ];
    
    // Update main image
    document.getElementById('testimonialImage').src = testimonials[index].image;
    
    // Update avatar
    document.getElementById('testimonialAvatar').src = testimonials[index].avatar;
    
    // Update content
    document.getElementById('testimonialName').textContent = testimonials[index].name;
    document.getElementById('testimonialPosition').textContent = testimonials[index].position;
    document.querySelector('#testimonialContent .lead').textContent = `"${testimonials[index].quote}"`;
    
    // Update active state
    document.querySelectorAll('.testimonial-avatar').forEach((item, i) => {
        if (i === index) {
            item.classList.add('active');
            item.querySelector('img').style.border = '3px solid #F5E8C7';
            item.querySelector('img').style.opacity = '1';
        } else {
            item.classList.remove('active');
            item.querySelector('img').style.border = '3px solid transparent';
            item.querySelector('img').style.opacity = '0.6';
        }
    });
}

function playTestimonial() {
    alert('Video testimonial akan segera tersedia!');
}