/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

var $ = require('jquery');

require("bootstrap/js/dist/");
// start the Stimulus application
import './bootstrap';
import 'bootstrap/dist/js/bootstrap';

// activates collapse functionality
import { Collapse } from './bootstrap';

require('@fortawesome/fontawesome-free/css/all.min.css');
require('@fortawesome/fontawesome-free/js/all.js');


import Chart from 'chart.js';

new Chart($("#myElement"), {
    ...
});