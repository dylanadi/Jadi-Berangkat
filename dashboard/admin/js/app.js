document.addEventListener('DOMContentLoaded', () => {
    const contentDiv = document.getElementById('app-content');
    const topbarTitle = document.getElementById('topbar-title');
    const navLinks = document.querySelectorAll('.nav-link');
    
    // Page titles mapping
    const pageTitles = {
        'home': 'Dashboard',
        'catalog': 'Katalog Wisata',
        'artikel': 'Artikel & Berita',
        'settings': 'Pengaturan Sistem'
    };

    // Load page function
    async function loadPage(page) {
        try {
            // Update UI Active State
            navLinks.forEach(link => link.classList.remove('active'));
            const activeLink = document.querySelector(`.nav-link[data-page="${page}"]`);
            if (activeLink) activeLink.classList.add('active');
            
            topbarTitle.textContent = pageTitles[page] || 'Dashboard';

            // Animation out
            if (contentDiv.innerHTML.trim() !== '') {
                await gsap.to(contentDiv, { opacity: 0, y: -20, duration: 0.2, ease: "power2.in" });
            }

            // Fetch content
            const response = await fetch(`pages/${page}.html`);
            if (!response.ok) throw new Error('Page not found');
            const html = await response.text();
            
            // Inject content
            contentDiv.innerHTML = html;
            
            // Execute any scripts in the loaded html
            const scripts = contentDiv.querySelectorAll('script');
            scripts.forEach(oldScript => {
                const newScript = document.createElement('script');
                Array.from(oldScript.attributes).forEach(attr => newScript.setAttribute(attr.name, attr.value));
                newScript.appendChild(document.createTextNode(oldScript.innerHTML));
                oldScript.parentNode.replaceChild(newScript, oldScript);
            });

            // Animation in
            gsap.fromTo(contentDiv, 
                { opacity: 0, y: 30 }, 
                { opacity: 1, y: 0, duration: 0.4, ease: "power2.out", delay: 0.1 }
            );

        } catch (error) {
            console.error('Error loading page:', error);
            contentDiv.innerHTML = `
                <div class="flex flex-col items-center justify-center h-64 text-center">
                    <i class="bi bi-exclamation-triangle text-4xl text-red-500 mb-4"></i>
                    <h2 class="text-xl font-extrabold text-ink">Gagal memuat halaman</h2>
                    <p class="text-gray-500 mt-2">Pastikan Anda mengakses melalui localhost (Server Lokal).</p>
                </div>
            `;
            gsap.to(contentDiv, { opacity: 1, duration: 0.3 });
        }
    }

    // Event Listeners for Sidebar Links
    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const page = link.getAttribute('data-page');
            if (page) {
                // simple hash routing
                window.location.hash = page;
            }
        });
    });

    // Handle hash changes
    window.addEventListener('hashchange', () => {
        let hash = window.location.hash.substring(1);
        if (!hash) hash = 'home';
        loadPage(hash);
    });

    // Initial Load
    let initialHash = window.location.hash.substring(1);
    if (!initialHash) {
        window.location.hash = 'home';
    } else {
        loadPage(initialHash);
    }
});
