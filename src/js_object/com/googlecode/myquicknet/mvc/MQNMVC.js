/**
 * MQNMVC
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global my: false, newType: false */
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
