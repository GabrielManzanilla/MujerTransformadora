import './bootstrap';
import {Register} from './register/index'

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
document.addEventListener("DOMContentLoaded", () => {
 new Register();
});

