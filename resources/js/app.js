import Alpine from 'alpinejs';

window.Alpine = Alpine;

document.body.classList.remove('overflow-y-hidden', 'overflow-hidden');
document.documentElement.classList.remove('overflow-y-hidden', 'overflow-hidden');

Alpine.start();
