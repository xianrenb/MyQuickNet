/**
 * TestingMVCConfig
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
var TestingMVCConfig;

(function () {
    'use strict';

    newType.def({
        name: 'TestingMVCConfig',
        base: MQNMVC,
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