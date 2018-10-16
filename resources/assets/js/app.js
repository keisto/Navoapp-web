
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

var isMobile = false; //initiate as false
// device detection
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent)
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) {
    isMobile = true;
}
// if (isMobile) {
//     $('#mobile-alert').css({"display":"flex"});
//     setTimeout(function () {
//         $('#mobile-alert').css({"display":"none"});
//     }, 2500);
// }

$('.message .close').on('click', function() {
    $(this).closest('.message').transition('fade').remove();
});

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
// Flash Notifications
    if($('#flash-notification')) {
        $('#flash-notification').css({'z-index':1000});
        setTimeout(function () {
           $('#flash-notification').fadeOut(750);
        }, 2500);
    }

    // Main Search Display
    if (!isMobile) {
        $('#wellsearch').keyup(function () {
            if ($('#wellsearch').val() != "") {
                // Has Value
                $('.fluid-results').css({
                    "display": "block"
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
                    "display": "none"
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
    }


    if ($('#home-header').attr('id') != undefined) {
        if (isMobile) {
            $('#register-button').hide();
            $('.page-header').css({
                "height": "320px",
            });
            $('#home-header').css({
                "flex-direction" : "column"
            });
            $('#home-header img').css({
                "display" : "none"
            });
            $('.three.statistics').css({
                "justify-content" : "center"
            })
        }
    }

    // Mobile modifications
    if ($('#search-header').attr('id') != undefined) {
        if (isMobile) {
            $('.navo-1').remove();
            $('.navo-2').remove();
            $('.fluid-results').css({
                "display" : "block"
            });
            $('.page-header').css({
                "height": "140px",
                "min-height": "140px",
            });
        }
    }
});