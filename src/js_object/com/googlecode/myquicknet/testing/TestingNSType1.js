/**
 * TestingNSType1
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingNSType1',
        methods: {
            _: function () {
                return this;
            },
            fa: function() {
                return 'ok!';
            }
        }
    });
}());
