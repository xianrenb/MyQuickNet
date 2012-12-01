/**
 * TestingMVC
 * @package MyQuickNet
 * @version 4.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, unparam: true, vars: true, browser: true */
/*global base: false, com: false, newType: false */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingMVC',
        base: com.googlecode.myquicknet.testing_config.TestingMVCConfig,
        methods: {
            _: function (config) {
                base._.call(this, config);
                return this;
            }
        }
    });
}());
