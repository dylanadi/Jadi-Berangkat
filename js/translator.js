
// Script Translate dengan Google Translate API secara Programmatic
document.addEventListener('DOMContentLoaded', () => {
    // 1. Hide Google Translate UI elements globally
    const style = document.createElement('style');
    style.innerHTML = `
        body { top: 0 !important; }
        .skiptranslate { display: none !important; }
        #goog-gt-tt { display: none !important; }
        .goog-te-spinner-pos { display: none !important; }
    `;
    document.head.appendChild(style);

    // 2. Inject invisible Google Translate element
    const gtDiv = document.createElement('div');
    gtDiv.id = 'google_translate_element';
    gtDiv.style.display = 'none';
    document.body.appendChild(gtDiv);

    // 3. State Management
    const defaultLang = 'id';
    let currentLang = localStorage.getItem('site_lang') || defaultLang;

    function setCookie(key, value, expiry) {
        let expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString() + ';path=/';
    }

    // 4. Initialize Google Translate Script ONLY if English is selected
    window.googleTranslateElementInit = function() {
        new google.translate.TranslateElement({
            pageLanguage: 'id',
            autoDisplay: false
        }, 'google_translate_element');
    };

    if (currentLang === 'en') {
        // Set cookie so Google knows to translate to English
        setCookie('googtrans', '/id/en', 1);
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        document.head.appendChild(script);
    } else {
        // Clear cookie if Indonesian
        setCookie('googtrans', '', -1);
    }

    // 5. Global function to switch language
    window.switchLanguage = function(lang) {
        if (lang === currentLang) return;
        localStorage.setItem('site_lang', lang);
        
        if (lang === 'en') {
            setCookie('googtrans', '/id/en', 1);
        } else {
            setCookie('googtrans', '', -1);
        }
        
        // Reload to apply translation flawlessly
        window.location.reload();
    };

    // 6. Update UI buttons state (using MutationObserver to handle dynamic header.js)
    function updateUI() {
        // Desktop buttons
        const btnIdDesk = document.querySelectorAll('.lang-selector-id');
        const btnEnDesk = document.querySelectorAll('.lang-selector-en');
        
        // Mobile buttons
        const btnIdMob = document.querySelectorAll('.lang-selector-id-mob');
        const btnEnMob = document.querySelectorAll('.lang-selector-en-mob');

        btnIdDesk.forEach(el => {
            el.style.opacity = currentLang === 'id' ? '1' : '0.4';
            el.style.boxShadow = currentLang === 'id' ? '0 0 0 2px #2f6f42' : 'none';
        });
        btnEnDesk.forEach(el => {
            el.style.opacity = currentLang === 'en' ? '1' : '0.4';
            el.style.boxShadow = currentLang === 'en' ? '0 0 0 2px #2f6f42' : 'none';
        });

        btnIdMob.forEach(el => {
            if (currentLang === 'id') {
                el.className = 'lang-selector-id-mob flex items-center gap-2 bg-base px-3 py-2 rounded-xl border border-black/5 hover:border-holiday transition';
                el.querySelector('span').className = 'font-bold text-sm';
            } else {
                el.className = 'lang-selector-id-mob flex items-center gap-2 bg-transparent px-3 py-2 rounded-xl border border-transparent hover:bg-base hover:border-black/5 transition';
                el.querySelector('span').className = 'font-bold text-sm text-gray-400 hover:text-ink';
            }
        });

        btnEnMob.forEach(el => {
            if (currentLang === 'en') {
                el.className = 'lang-selector-en-mob flex items-center gap-2 bg-base px-3 py-2 rounded-xl border border-black/5 hover:border-holiday transition';
                el.querySelector('span').className = 'font-bold text-sm';
            } else {
                el.className = 'lang-selector-en-mob flex items-center gap-2 bg-transparent px-3 py-2 rounded-xl border border-transparent hover:bg-base hover:border-black/5 transition';
                el.querySelector('span').className = 'font-bold text-sm text-gray-400 hover:text-ink';
            }
        });
    }

    // Run initially and observe DOM for header injection
    updateUI();
    const observer = new MutationObserver((mutations) => {
        updateUI();
    });
    observer.observe(document.body, { childList: true, subtree: true });
});
