// FAQ Category Switching
document.addEventListener('DOMContentLoaded', function() {
    const categoryLinks = document.querySelectorAll('[data-category]');
    const faqContents = document.querySelectorAll('.faq-content');
    
    categoryLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links
            categoryLinks.forEach(l => {
                l.classList.remove('active');
                l.style.backgroundColor = '';
                l.style.color = '#1B1A55';
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            this.style.backgroundColor = '#F5E8C7';
            this.style.color = '#1B1A55';
            this.style.fontWeight = '600';
            
            // Hide all FAQ contents
            faqContents.forEach(content => content.classList.add('d-none'));
            
            // Show selected FAQ content
            const targetCategory = this.getAttribute('data-category');
            document.getElementById(targetCategory).classList.remove('d-none');
        });
    });
});

// Major Data
const majorData = {
    pplg: {
        id: 1,
        photo: '/assets/image/siswa/pplg.png',
        title: 'PEMROGRAMAN PERANGKAT LUNAK & GIM',
        subtitle: 'PPLG - Pengembangan Perangkat Lunak & Gim',
        description: 'Jurusan yang mempersiapkan kamu untuk menjadi talenta digital masa depan. Di sini kamu belajar membangun aplikasi, website, hingga game yang bisa digunakan banyak orang.',
        careers: ['Software Developer (8-15 juta/bulan)', 'Game Developer (10-18 juta/bulan)', 'Full Stack Developer (12-20 juta/bulan)'],
        skills: ['HTML/CSS', 'JavaScript', 'PHP', 'Laravel']
    },
    dkv: {
        id: 2,
        photo: '/assets/image/siswa/dkv.png',
        title: 'DESAIN KOMUNIKASI VISUAL',
        subtitle: 'DKV - Desain Komunikasi Visual',
        description: 'Jurusan yang mengembangkan kreativitas dan kemampuan desain untuk menciptakan karya visual yang menarik dan komunikatif.',
        careers: ['UI/UX Designer (7-12 juta/bulan)', 'Graphic Designer (5-10 juta/bulan)', 'Motion Graphic Artist (8-15 juta/bulan)'],
        skills: ['Photoshop', 'Illustrator', 'After Effects', 'Figma']
    },
    akuntansi: {
        id: 3,
        photo: '/assets/image/siswa/akt.png',
        title: 'AKUNTANSI & KEUANGAN LEMBAGA',
        subtitle: 'AKL - Akuntansi & Keuangan Lembaga',
        description: 'Jurusan yang mempersiapkan tenaga ahli di bidang akuntansi dan keuangan dengan kemampuan analisis yang kuat.',
        careers: ['Staff Accounting (5-8 juta/bulan)', 'Finance Manager (10-15 juta/bulan)', 'Tax Consultant (8-12 juta/bulan)'],
        skills: ['Excel', 'SAP', 'MYOB', 'Pajak']
    },
    anm: {
   
    id: 4,
    photo: '/assets/image/siswa/anm.png',
    title: 'Animasi',
    subtitle: 'ANM - Animasi',
    description: 'Jurusan yang mempelajari proses pembuatan animasi 2D dan 3D, mulai dari konsep, desain karakter, storyboard, hingga produksi animasi digital.',
    careers: [
        'Animator 2D (4–8 juta/bulan)',
        'Animator 3D (5–10 juta/bulan)',
        'Storyboard Artist (4–8 juta/bulan)',
        'Illustrator / Concept Artist (5–12 juta/bulan)',
        'Video Editor (4–8 juta/bulan)'
    ],
    skills: [
        'Drawing / Illustration',
        '2D Animation (Toon Boom, Adobe Animate)',
        '3D Modeling & Animation (Blender, Maya)',
        'Digital Art',
        'Storyboarding',
        'Video Editing'
    ]


    },
    pemasaran: {
        id: 5,
        photo: '/assets/image/siswa/bdp.png',
        title: 'BISNIS DARING & PEMASARAN',
        subtitle: 'BDP - Bisnis Daring & Pemasaran',
        description: 'Jurusan yang mempersiapkan ahli pemasaran digital dan bisnis online di era teknologi modern.',
        careers: ['Digital Marketer (6-12 juta/bulan)', 'Sales Manager (8-15 juta/bulan)', 'E-commerce Specialist (7-13 juta/bulan)'],
        skills: ['Digital Marketing', 'SEO', 'Social Media', 'E-commerce']
    }
};

// Update Major Content Function
function updateMajorContent(majorKey) {
    const data = majorData[majorKey];
    
    document.getElementById('major-title').textContent = data.title;
    document.getElementById('major-photo').innerHTML = `<img src="${data.photo}" alt="Siswa ${data.subtitle}" class="img-fluid" style="width: 100%; height: 500px; object-fit: cover;">`;
    document.getElementById('major-details').innerHTML = `
        <h3 class="fw-bold mb-3 text-white">${data.subtitle}</h3>
        <p class="mb-4 text-white">${data.description}</p>
        <div class="mb-4">
            <h6 class="fw-bold mb-3 text-white">💼 Prospek Karier:</h6>
            <ul class="list-unstyled">${data.careers.map(career => `<li class="mb-2 text-white">• ${career}</li>`).join('')}</ul>
        </div>
        <div class="mb-4">
            <h6 class="fw-bold mb-3 text-white">🛠️ Skills yang Dipelajari:</h6>
            <div class="d-flex flex-wrap gap-2">${data.skills.map(skill => `<span class="badge bg-light text-dark px-3 py-2">${skill}</span>`).join('')}</div>
        </div>
        <a href="/pendaftaran?jurusan=${data.id}" class="btn btn-lg px-4 py-3" style="background-color: #F5E8C7; color: #1B1A55;">Daftar Sekarang</a>
    `;
}

// Major Navigation Event Listeners
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.major-nav-btn').forEach(button => {
        button.addEventListener('click', function() {
            document.querySelectorAll('.major-nav-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            updateMajorContent(this.getAttribute('data-major'));
        });
    });
});