/*
 * File: jquery.barfiller.js
 * Version: 1.0.1
 * Description: A plugin that fills bars with a percentage you set.
 * Author: 9bit Studios
 * Copyright 2012, 9bit Studios
 * http://www.9bitstudios.com
 * Free to use and abuse under the MIT license.
 * http://www.opensource.org/licenses/mit-license.php
 */

(function($) {

    $.fn.barfiller = function(options) {

        var defaults = $.extend({
            barColor: '#16b597',
            tooltip: true,
            duration: 1000,
            animateOnResize: true,
            symbol: "%"
        }, options);


        /******************************
        Private Variables
        *******************************/

        var object = $(this);
        var settings = $.extend(defaults, options);
        var barWidth = object.width();
        var fill = object.find('.fill');
        var toolTip = object.find('.tip');
        var fillPercentage = fill.attr('data-percentage');
        var resizeTimeout;
        var transitionSupport = false;
        var transitionPrefix;

        /******************************
        Public categorys
        *******************************/

        var categorys = {

            init: function() {
                return this.each(function() {
                    if (categorys.getTransitionSupport()) {
                        transitionSupport = true;
                        transitionPrefix = categorys.getTransitionPrefix();
                    }

                    categorys.appendHTML();
                    categorys.setEventHandlers();
                    categorys.initializeItems();
                });
            },

            /******************************
            Append HTML
            *******************************/

            appendHTML: function() {
                fill.css('background', settings.barColor);

                if (!settings.tooltip) {
                    toolTip.css('display', 'none');
                }
                toolTip.text(fillPercentage + settings.symbol);
            },


            /******************************
            Set Event Handlers
            *******************************/
            setEventHandlers: function() {
                if (settings.animateOnResize) {
                    $(window).on("resize", function(event) {
                        clearTimeout(resizeTimeout);
                        resizeTimeout = setTimeout(function() {
                            categorys.refill();
                        }, 300);
                    });
                }
            },

            /******************************
            Initialize
            *******************************/

            initializeItems: function() {
                var pctWidth = categorys.calculateFill(fillPercentage);
                object.find('.tipWrap').css({ display: 'inline' });

                if (transitionSupport)
                    categorys.transitionFill(pctWidth);
                else
                    categorys.animateFill(pctWidth);
            },

            getTransitionSupport: function() {

                var thisBody = document.body || document.documentElement,
                    thisStyle = thisBody.style;
                var support = thisStyle.transition !== undefined || thisStyle.WebkitTransition !== undefined || thisStyle.MozTransition !== undefined || thisStyle.MsTransition !== undefined || thisStyle.OTransition !== undefined;
                return support;
            },

            getTransitionPrefix: function() {
                if (/mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase())) {
                    return '-moz-transition';
                }
                if (/webkit/.test(navigator.userAgent.toLowerCase())) {
                    return '-webkit-transition';
                }
                if (/opera/.test(navigator.userAgent.toLowerCase())) {
                    return '-o-transition';
                }
                if (/msie/.test(navigator.userAgent.toLowerCase())) {
                    return '-ms-transition';
                } else {
                    return 'transition';
                }
            },

            getTransition: function(val, time, type) {

                var CSSObj;
                if (type === 'width') {
                    CSSObj = { width: val };
                } else if (type === 'left') {
                    CSSObj = { left: val };
                }

                time = time / 1000;
                CSSObj[transitionPrefix] = type + ' ' + time + 's ease-in-out';
                return CSSObj;

            },

            refill: function() {
                fill.css('width', 0);
                toolTip.css('left', 0);
                barWidth = object.width();
                categorys.initializeItems();
            },

            calculateFill: function(percentage) {
                percentage = percentage * 0.01;
                var finalWidth = barWidth * percentage;
                return finalWidth;
            },

            transitionFill: function(barWidth) {

                var toolTipOffset = barWidth - toolTip.width();
                fill.css(categorys.getTransition(barWidth, settings.duration, 'width'));
                toolTip.css(categorys.getTransition(toolTipOffset, settings.duration, 'left'));

            },

            animateFill: function(barWidth) {
                var toolTipOffset = barWidth - toolTip.width();
                fill.stop().animate({ width: '+=' + barWidth }, settings.duration);
                toolTip.stop().animate({ left: '+=' + toolTipOffset }, settings.duration);
            }

        };

        if (categorys[options]) { // $("#element").pluginName('categoryName', 'arg1', 'arg2');
            return categorys[options].apply(this, Array.prototype.slice.call(arguments, 1));
        } else if (typeof options === 'object' || !options) { // $("#element").pluginName({ option: 1, option:2 });
            return categorys.init.apply(this);
        } else {
            $.error('category "' + category + '" does not exist in barfiller plugin!');
        }
    };

})(jQuery);