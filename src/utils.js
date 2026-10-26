const root = document.documentElement;
const themeButton = document.getElementById("theme_switch");

// get current theme from system preference or local storage
let currentTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
const saved = localStorage.getItem('theme');
if(saved !== null) {currentTheme = saved; }
setTheme(currentTheme);

function setTheme(theme){
    root.dataset.theme = theme;
    currentTheme = theme;
    localStorage.setItem('theme', theme);
    themeButton.classList.toggle('sun', currentTheme === 'dark');
    themeButton.classList.toggle('moon', currentTheme === 'light');
}
function switchTheme(){
    const next = currentTheme === 'dark' ? 'light' : 'dark';
    setTheme(next);
}