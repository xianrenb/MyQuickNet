/**
 * TestingMVC
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, vars: true, browser: true */
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
