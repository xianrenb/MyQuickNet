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
            nl2br: function (text) {
                var ch, i;
                var out = '';
                text = text.toString();

                for (i = 0; i < text.length; ++i) {
                    ch = text.charAt(i).toString();
                    out += (ch === "\n") ? '<br />' : ch.toString();
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