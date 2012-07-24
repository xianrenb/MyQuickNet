/**
 * MQNTools
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var MQNTools;

(function () {
    'use strict';

    newType.def({
        name: 'MQNTools',
        methods: {
            _: function () {
                return this;
            },
            htmlspecialchars: function (text, convertSingleQuote) {
                var out = text.toString();
                out = out.replace(/&/g, '&amp;')
                .replace(/</g, '&lt;')
                .replace(/>/g, '&gt;')
                .replace(/"/g, '&quot;');

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