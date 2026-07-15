$content = Get-Content -Path "d:\Zavier Project\example-app\resources\views\layouts\public.blade.php" -Raw
$script = @"
    /* Active Link Hash */
    const sections = document.querySelectorAll('section[id], div[id="profil"], footer[id="kontak"]');
    const navLinks = document.querySelectorAll('#desktop-nav a, #mobile-menu a');
    
    function updateActiveNav() {
        let scrollY = window.pageYOffset;
        sections.forEach(current => {
            const sectionHeight = current.offsetHeight;
            const sectionTop = current.offsetTop - 100;
            let sectionId = current.getAttribute('id');
            
            if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                navLinks.forEach(link => {
                    link.classList.remove('text-pmi', 'bg-red-50');
                    if(link.getAttribute('href').includes(sectionId)) {
                        link.classList.add('text-pmi', 'bg-red-50');
                    }
                });
            }
        });
    }
    
    window.addEventListener('scroll', updateActiveNav);
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            navLinks.forEach(l => l.classList.remove('text-pmi', 'bg-red-50'));
            this.classList.add('text-pmi', 'bg-red-50');
        });
    });
"@
$content = $content -replace "var hamburger  = document.getElementById\('hamburger-btn'\);", ($script + "`n    var hamburger  = document.getElementById('hamburger-btn');")
Set-Content -Path "d:\Zavier Project\example-app\resources\views\layouts\public.blade.php" -Value $content -Encoding UTF8
