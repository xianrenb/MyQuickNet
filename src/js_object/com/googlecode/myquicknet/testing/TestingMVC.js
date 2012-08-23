/**
 * TestingMVC
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