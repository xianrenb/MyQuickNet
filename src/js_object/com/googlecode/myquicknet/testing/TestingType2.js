/**
 * TestingType2
 * @package MyQuickNet
 * @version 2.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://www.opensource.org/licenses/gpl-3.0.html GNU General Public License version 3 (GPLv3)
 */
/**
 *
 */
var TestingType2;

(function () {
    'use strict';

    newType.def({
        name: 'TestingType2',
        base: TestingType1,
        interfaces: [TestingInterface1],
        shared: {
            s: 6
        },
        methods: {
            _: function (a, b) {
                base._.call(this, b, a);
                my.a = base.getA.call(this);
                my.b = base.getB.call(this);
                my.x = 7;
                shared.s += 8;
                return this;
            },
            _fa: function (a, b) {
                my.x += 9;
                return a - b;
            },
            fc: function (a, b) {
                my.x += 10;
                return a - b;
            },
            getA: function () {
                return my.a;
            },
            getB: function () {
                return my.b;
            },
            getX: function () {
                return my.x;
            },
            getS: function () {
                return shared.s;
            }
        },
        sharedMethods: {
            _sfa: function (a) {
                var result = a;
                result += shared.s;
                return result;
            },
            _sfb: function () {
                return 1;
            },
            sfc: function (a) {
                return this._sfa(a);
            }
        }
    });
}());
