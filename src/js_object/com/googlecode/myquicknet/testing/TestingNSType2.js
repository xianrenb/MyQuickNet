/**
 * TestingNSType2
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */

(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.testing',
        name: 'TestingNSType2',
        base: 'com.googlecode.myquicknet.testing.TestingNSType1',
        interfaces: ['com.googlecode.myquicknet.testing.TestingNSInterface1'],
        methods: {
            _: function () {
                return this;
            },
            fa: function() {
                return 'ok too!';
            },
            newTestingNSType1: function() {
                var o = new _.TestingNSType1();
                return o;
            }
        }
    });
}());
