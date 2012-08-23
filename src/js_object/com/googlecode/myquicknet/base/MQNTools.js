/**
 * MQNTools
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.base',
        name: 'MQNTools',
        methods: {
            _: function () {
                return this;
            },
            htmlspecialchars: function (text, convertSingleQuote) {
                var out = text.toString();
                out = out.replace(/&/g, '&amp;');
                out = out.replace(/</g, '&lt;');
                out = out.replace(/>/g, '&gt;');
                out = out.replace(/"/g, '&quot;');

                if (convertSingleQuote) {
                    out = out.replace(/'/g, '&apos;');
                }

                return out;
            },
            nl2br: function (text, isXhtml) {
                var out = text.toString();

                if ((typeof isXhtml === 'undefined') || isXhtml) {
                    out = out.replace(/\r\n|\n\r|\n|\r/g, '<br />');
                } else {
                    out = out.replace(/\r\n|\n\r|\n|\r/g, '<br>');
                }

                return out;
            },
            print: function (id, text) {
                var element = document.getElementById(id.toString());
                element.innerHTML += this.nl2br(text.toString()).toString();
            }
        }
    });
}());