import './bootstrap';
import Alpine from 'alpinejs';
import 'flowbite';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('myCartDropdownButton1').click();
});