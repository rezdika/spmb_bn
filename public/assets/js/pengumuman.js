// Search Form Handler
document.addEventListener('DOMContentLoaded', function() {
    const searchForm = document.getElementById('searchForm');
    
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const noPendaftaran = document.getElementById('noPendaftaran').value;
            const tanggal = document.getElementById('tanggal').value;
            const bulan = document.getElementById('bulan').value;
            const tahun = document.getElementById('tahun').value;
            const agreement = document.getElementById('agreement').checked;
            
            if (!noPendaftaran || !tanggal || !bulan || !tahun || !agreement) {
                alert('Mohon lengkapi semua data dan centang persetujuan!');
                return;
            }
            
            // Validasi format tanggal
            if (tanggal < 1 || tanggal > 31 || bulan < 1 || bulan > 12 || tahun < 2000 || tahun > 2010) {
                alert('Format tanggal lahir tidak valid!');
                return;
            }
            
            // Simulasi pencarian (dalam implementasi nyata, ini akan mengirim request ke server)
            setTimeout(() => {
                // Simulasi data hasil
                document.getElementById('resultNoPendaftaran').textContent = noPendaftaran;
                document.getElementById('resultNama').textContent = 'AHMAD RIZKI PRATAMA';
                document.getElementById('resultJurusan').textContent = 'Teknik Komputer dan Jaringan (TKJ)';
                document.getElementById('resultGelombang').textContent = 'Gelombang 1';
                
                // Tampilkan hasil
                document.getElementById('resultBox').style.display = 'block';
                document.getElementById('resultBox').scrollIntoView({ behavior: 'smooth' });
            }, 1000);
        });
    }
});