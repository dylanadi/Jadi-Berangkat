document.addEventListener('DOMContentLoaded', () => {
    fetch('components/header.html')
        .then(response => response.text())
        .then(data => {
            const placeholder = document.getElementById('header-placeholder');
            if (placeholder) {
                placeholder.innerHTML = data;
                
                // Initialize Header Scripts
                const headerWrapper = document.getElementById('header-wrapper');
                const navContainer = document.getElementById('nav-container');

                window.addEventListener('scroll', () => {
                    if (window.scrollY > 50) {
                        if (headerWrapper) {
                            headerWrapper.classList.add('top-3');
                            headerWrapper.classList.remove('top-0');
                        }
                        if (navContainer) {
                            navContainer.classList.add('shadow-[0_18px_55px_rgba(0,0,0,0.2)]');
                        }
                    } else {
                        if (headerWrapper) {
                            headerWrapper.classList.remove('top-3');
                            headerWrapper.classList.add('top-0');
                        }
                        if (navContainer) {
                            navContainer.classList.remove('shadow-[0_18px_55px_rgba(0,0,0,0.2)]');
                        }
                    }
                });

                // GSAP Sidebar Mobile Menu
                if (typeof gsap !== 'undefined') {
                    const tlMenu = gsap.timeline({ paused: true });
                    tlMenu.to('#menu-overlay', { display: 'block', opacity: 1, duration: 0.3 })
                          .to('#mobile-sidebar', { x: 0, duration: 0.4, ease: "power3.out", boxShadow: "20px 0 50px rgba(0,0,0,0.5)" }, "<");

                    const openBtn = document.getElementById('open-menu-btn');
                    const closeBtn = document.getElementById('close-menu-btn');
                    const overlay = document.getElementById('menu-overlay');

                    if (openBtn) openBtn.addEventListener('click', () => tlMenu.play());
                    if (closeBtn) closeBtn.addEventListener('click', () => tlMenu.reverse());
                    if (overlay) overlay.addEventListener('click', () => tlMenu.reverse());
                }
            }
        })
        .catch(error => console.error('Error loading header:', error));
});