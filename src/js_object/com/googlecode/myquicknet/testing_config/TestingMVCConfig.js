/**
 * TestingMVCConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, vars: true, browser: true */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing_config',
        name: 'TestingMVCConfig',
        base: com.googlecode.myquicknet.mvc.MQNMVC,
        methods: {
            _: function (config) {
                config = {
                    urlBase: 'http://localhost/MyQuickNet/'
                };

                base._.call(this, config);
                return this;
            }
        }
    });
}());
