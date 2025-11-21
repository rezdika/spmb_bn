// Panduan Page JavaScript Functions

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