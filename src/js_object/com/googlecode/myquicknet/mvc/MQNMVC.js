/**
 * MQNMVC
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
        namespace: 'com.googlecode.myquicknet.mvc',
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