import os
import re

def extract_header(content):
    # Try to find the block from <!-- Navbar & Sidebar --> to </header>
    pattern = re.compile(r'(?:<!--\s*Navbar & Sidebar\s*-->\s*)?<div id="menu-overlay".*?</header>', re.DOTALL)
    match = pattern.search(content)
    if match:
        return match.group(0), match.start(), match.end()
    return None, -1, -1

def process_files():
    html_files = [f for f in os.listdir('.') if f.endswith('.html')]
    if 'index.html' not in html_files:
        print("index.html not found!")
        return

    with open('index.html', 'r', encoding='utf-8') as f:
        index_content = f.read()

    header_html, start, end = extract_header(index_content)
    if not header_html:
        print("Could not extract header from index.html")
        return

    with open('components/header.html', 'w', encoding='utf-8') as f:
        f.write(header_html)
    print("Created components/header.html")

    js_code = """
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
"""
    with open('header.js', 'w', encoding='utf-8') as f:
        f.write(js_code.strip())
    print("Created header.js")

    for file in html_files:
        with open(file, 'r', encoding='utf-8') as f:
            content = f.read()

        new_content = content
        
        # Replace header block
        pattern = re.compile(r'(?:<!--\s*Navbar & Sidebar\s*-->\s*)?<div id="menu-overlay".*?</header>', re.DOTALL)
        if pattern.search(new_content):
            new_content = pattern.sub('<div id="header-placeholder"></div>', new_content)
        
        # Inject header.js if not present
        if 'src="header.js"' not in new_content:
            # We want to insert it before the closing </body> tag
            new_content = new_content.replace('</body>', '    <script src="header.js"></script></body>')
            
        if new_content != content:
            with open(file, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Updated {file}")

if __name__ == '__main__':
    process_files()
