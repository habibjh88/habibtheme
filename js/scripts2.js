/*
Theme Name: Habib
Author: Habib
*/


jQuery(function($) {

    'use strict';
    /* ======= MENU OPEN ======= */
    (function() {
        $(".menu-trigger").on('click', function() {
            $('body').toggleClass('is-menu-open');
        });

        $(".side-menu-button").on('click', function() {
            $('body').removeClass('is-menu-open');
        });
    }());



});