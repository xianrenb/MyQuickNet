/**
 * MQNMVC
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var MQNMVC;

(function () {
    'use strict';

    newType.def({
        name: 'MQNMVC',
        methods: {
            _: function (config) {
                if (config && config.urlBase) {
                    my.urlBase = config.urlBase.toString();
                } else {
                    my.urlBase = 'http://localhost/';
                }

                return this;
            },
            getUrlBase: function () {
                return my.urlBase;
            }
        }
    });
}());