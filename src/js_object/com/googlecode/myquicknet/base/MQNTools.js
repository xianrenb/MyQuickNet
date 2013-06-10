/**
 * MQNTools
 * @module MyQuickNet
 * @version 4.6
 * @copyright (c) 2013 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global newType: false */
/**
 * 
 * @class com.googlecode.myquicknet.base.MQNTools
 * @memberof! <global>
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.base',
        name: 'MQNTools',
        methods:
            /**
             * 
             * @lends com.googlecode.myquicknet.base.MQNTools.prototype
             */
            {
                /**
                 * 
                 * @returns {Object}
                 */
                _: function () {
                    return this;
                },
                /**
                 * 
                 * @param {String} text
                 * @param {Boolean} convertSingleQuote
                 * @returns {String}
                 */
                htmlspecialchars: function (text, convertSingleQuote) {
                    var out = text.toString();
                    out = out.toString().replace(/&/g, '&amp;').toString();
                    out = out.toString().replace(/</g, '&lt;').toString();
                    out = out.toString().replace(/>/g, '&gt;').toString();
                    out = out.toString().replace(/"/g, '&quot;').toString();

                    if (convertSingleQuote) {
                        out = out.toString().replace(/'/g, '&apos;').toString();
                    }

                    return out;
                },
                /**
                 * 
                 * @param {String} text
                 * @param {Boolean|undefined} isXhtml
                 * @returns {String}
                 */
                nl2br: function (text, isXhtml) {
                    var out = text.toString();

                    if ((isXhtml === undefined) || isXhtml) {
                        out = out.toString().replace(/\r\n|\n\r|\n|\r/g, '<br />').toString();
                    } else {
                        out = out.toString().replace(/\r\n|\n\r|\n|\r/g, '<br>').toString();
                    }

                    return out;
                },
                /**
                 * 
                 * @param {String} id
                 * @param {String} text
                 * @returns {undefined}
                 */
                print: function (id, text) {
                    var element = document.getElementById(id.toString());
                    element.innerHTML += this.nl2br(text.toString()).toString();
                }
            }
    });
}());
