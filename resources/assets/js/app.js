
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// require('./bootstrap');
import axios from 'axios';
window.Vue = require('vue');
window.axios = axios;

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));
import InstantSearch from 'vue-instantsearch';
Vue.use(InstantSearch);

const app = new Vue({
    el: '#app'
});


// Vue.config.devtools = true;
// Vue.config.debug = true;
// Vue.config.silent = false;


$( document ).ready(function() {
// Initialize Elements
    $('.menu .item').tab();
    $('.ui .dropdown').dropdown();
    $('.ui .checkbox').checkbox();
    $('#menu').click(function () {
        $('.ui.sidebar').sidebar('toggle')
    });
    $('.ui.accordion').accordion();
    $('.message .close').on('click', function () {
        $(this).closest('.message').transition('fade');
    });

// Main Search Display
    $('#wellsearch').keyup(function () {
        if ($('#wellsearch').val() != "") {
            // Has Value
            $('.fluid-results').css({
               "display" : "block"
            });
            $('.page-header').css({
                "height": "140px",
                "min-height": "140px",
            });
            $('.navo-1').css({
                "padding-top": "0px",
                "margin-bottom": "-30px",
                "margin-top": "0px",
                "opacity": "0",
            });
            setTimeout(function () {
                $('.navo-2').css({
                    "padding-right": "20px",
                    "opacity": "1",
                    "width": "auto",
                    "display": "inline",
                });
            }, 800);
        } else {
            // NO VALUE RESTORE DEFAULT
            $('.page-header').css({
                "height": "50vh",
                "min-height": "320px",
            });
            $('.navo-1').css({
                "padding-top": "20vh",
                "margin": "calc(2rem - 0.14285714em ) 0em 1rem",
                "opacity": "1",
            });
            $('.fluid-results').css({
                "display" : "none"
            });
            setTimeout(function () {
                $('.navo-2').css({
                    "padding-right": "-300px",
                    "opacity": "0",
                    "display": "none",
                });
            }, 800);
        }
    });
});