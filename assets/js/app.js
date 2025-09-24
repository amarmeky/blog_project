let language = localStorage.getItem('language') || 'en';

function loadLanguage() {
    fetch(`assets/lang/${language}.json`)
        .then(response => response.json())
        .then(data => {
            document.querySelectorAll('[data-translate]').forEach(element => {
                const key = element.getAttribute('data-translate');
                if (data[key]) {
                    element.innerText = data[key];
                }
            });
            document.getElementById('language-switch').innerText = data.language_switch;
        });
}
function switchLanguage() {
    language = (language === 'en') ? 'ar' : 'en';
    localStorage.setItem('language', language);
    loadLanguage();
}
loadLanguage();


