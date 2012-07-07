/**
 * TestingMVCConfig
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
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