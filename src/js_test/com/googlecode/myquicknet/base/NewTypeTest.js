/**
 * NewTypeTest
 * @package MyQuickNet
 * @version 3.0
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, vars: true, browser: true */
(function () {
    'use strict';

    newType.def({
        namespace: 'com.googlecode.myquicknet.base',
        name: 'NewTypeTest',
        methods: {
            _: function () {
                return this;
            },
            run: function () {
                module('NewTypeTest');
                this.test1();
                this.test2();
                this.test3();
                this.test4();
                this.test5();
                this.test6();
            },
            test1: function () {
                test('TestingNewType', function () {
                    var error, errorName, type;
                    ok(newType instanceof Object);
                    ok(newType.isInstance(newType, Object));
                    ok(newType.isInstance(newType, 'Object'));
                    ok(newType instanceof com.googlecode.myquicknet.base.NewType);
                    ok(newType.isInstance(newType, com.googlecode.myquicknet.base.NewType));
                    ok(newType.isInstance(newType, 'com.googlecode.myquicknet.base.NewType'));
                    ok(com.googlecode.myquicknet.base.NewType instanceof Object);
                    ok(com.googlecode.myquicknet.base.NewType instanceof Function);
                    ok(newType.isInstance(com.googlecode.myquicknet.base.NewType, Object));
                    ok(newType.isInstance(com.googlecode.myquicknet.base.NewType, Function));
                    ok(newType.isInstance(com.googlecode.myquicknet.base.NewType, 'Object'));
                    ok(newType.isInstance(com.googlecode.myquicknet.base.NewType, 'Function'));
                    equal(newType.getTypeFromFullName('com.googlecode.myquicknet.base.NewType'), com.googlecode.myquicknet.base.NewType);

                    try {
                        type = newType.getTypeFromFullName('bad.full.Name');
                        error = false;
                        errorName = '';
                    } catch (e) {
                        type = null;
                        error = true;
                        errorName = e.name.toString();
                    }

                    equal(type, null);
                    ok(error);
                    equal(errorName, 'ReferenceError');
                    equal(newType.getTypeFullName(com.googlecode.myquicknet.base.NewType), 'com.googlecode.myquicknet.base.NewType');
                    equal(newType.getTypeName(com.googlecode.myquicknet.base.NewType), 'NewType');
                });
            },
            test2: function () {
                test('TestingType1', function () {
                    var testingType1, testingType1a;
                    ok(TestingType1 instanceof Object);
                    ok(TestingType1 instanceof Function);
                    ok(newType.isInstance(TestingType1, Object));
                    ok(newType.isInstance(TestingType1, Function));
                    ok(newType.isInstance(TestingType1, 'Object'));
                    ok(newType.isInstance(TestingType1, 'Function'));
                    equal(newType.getTypeFullName(TestingType1), 'TestingType1');
                    equal(newType.getTypeName(TestingType1), 'TestingType1');
                    testingType1 = new TestingType1();
                    testingType1._(1, 2);
                    ok(testingType1 instanceof Object);
                    ok(testingType1 instanceof TestingType1);
                    ok(!(testingType1 instanceof TestingType2));
                    ok(!(testingType1 instanceof TestingType3));
                    ok(newType.isInstance(testingType1, Object));
                    ok(newType.isInstance(testingType1, 'Object'));
                    ok(newType.isInstance(testingType1, TestingType1));
                    ok(newType.isInstance(testingType1, 'TestingType1'));
                    ok(!newType.isInstance(testingType1, TestingType2));
                    ok(!newType.isInstance(testingType1, 'TestingType2'));
                    ok(!newType.isInstance(testingType1, TestingType3));
                    ok(!newType.isInstance(testingType1, 'TestingType3'));
                    ok(!newType.isInstance(testingType1, TestingInterface1));
                    ok(!newType.isInstance(testingType1, 'TestingInterface1'));
                    ok(!newType.isInstance(testingType1, TestingInterface2));
                    ok(!newType.isInstance(testingType1, 'TestingInterface2'));
                    ok(!newType.isInstance(testingType1, TestingInterface3));
                    ok(!newType.isInstance(testingType1, 'TestingInterface3'));
                    equal(testingType1.getA(), 1);
                    equal(testingType1.getB(), 2);
                    equal(testingType1.getX(), 2);
                    equal(testingType1.getS(), 4);
                    equal(testingType1.fb(3, 4), -1);
                    equal(testingType1.getA(), 1);
                    equal(testingType1.getB(), 2);
                    equal(testingType1.getX(), 6);
                    equal(testingType1.getS(), 4);
                    equal(testingType1.fd(5, 6), -1);
                    equal(testingType1.getA(), 1);
                    equal(testingType1.getB(), 2);
                    equal(testingType1.getX(), 11);
                    equal(testingType1.getS(), 4);
                    testingType1a = new TestingType1();
                    testingType1a._(1, 2);
                    equal(testingType1a.getA(), 1);
                    equal(testingType1a.getB(), 2);
                    equal(testingType1a.getX(), 2);
                    equal(testingType1a.getS(), 7);
                    equal(testingType1a.fb(3, 4), -1);
                    equal(testingType1a.getA(), 1);
                    equal(testingType1a.getB(), 2);
                    equal(testingType1a.getX(), 6);
                    equal(testingType1a.getS(), 7);
                    equal(testingType1a.fd(5, 6), -1);
                    equal(testingType1a.getA(), 1);
                    equal(testingType1a.getB(), 2);
                    equal(testingType1a.getX(), 11);
                    equal(testingType1a.getS(), 7);
                });
            },
            test3: function () {
                test('TestingType2', function () {
                    var testingType2, testingType2a;
                    ok(TestingType2 instanceof Object);
                    ok(TestingType2 instanceof Function);
                    ok(newType.isInstance(TestingType2, Object));
                    ok(newType.isInstance(TestingType2, Function));
                    ok(newType.isInstance(TestingType2, 'Object'));
                    ok(newType.isInstance(TestingType2, 'Function'));
                    equal(newType.getTypeFullName(TestingType2), 'TestingType2');
                    equal(newType.getTypeName(TestingType2), 'TestingType2');
                    testingType2 = new TestingType2();
                    testingType2._(1, 2);
                    ok(testingType2 instanceof Object);
                    ok(testingType2 instanceof TestingType1);
                    ok(testingType2 instanceof TestingType2);
                    ok(!(testingType2 instanceof TestingType3));
                    ok(newType.isInstance(testingType2, Object));
                    ok(newType.isInstance(testingType2, 'Object'));
                    ok(newType.isInstance(testingType2, TestingType1));
                    ok(newType.isInstance(testingType2, 'TestingType1'));
                    ok(newType.isInstance(testingType2, TestingType2));
                    ok(newType.isInstance(testingType2, 'TestingType2'));
                    ok(!newType.isInstance(testingType2, TestingType3));
                    ok(!newType.isInstance(testingType2, 'TestingType3'));
                    ok(newType.isInstance(testingType2, TestingInterface1));
                    ok(newType.isInstance(testingType2, 'TestingInterface1'));
                    ok(!newType.isInstance(testingType2, TestingInterface2));
                    ok(!newType.isInstance(testingType2, 'TestingInterface2'));
                    ok(!newType.isInstance(testingType2, TestingInterface3));
                    ok(!newType.isInstance(testingType2, 'TestingInterface3'));
                    equal(testingType2.getA(), 2);
                    equal(testingType2.getB(), 1);
                    equal(testingType2.getX(), 7);
                    equal(testingType2.getS(), 14);
                    equal(testingType2.fb(3, 4), -1);
                    equal(testingType2.getA(), 2);
                    equal(testingType2.getB(), 1);
                    equal(testingType2.getX(), 16);
                    equal(testingType2.getS(), 14);
                    equal(testingType2.fd(5, 6), -1);
                    equal(testingType2.getA(), 2);
                    equal(testingType2.getB(), 1);
                    equal(testingType2.getX(), 26);
                    equal(testingType2.getS(), 14);
                    testingType2a = new TestingType2();
                    testingType2a._(1, 2);
                    equal(testingType2a.getA(), 2);
                    equal(testingType2a.getB(), 1);
                    equal(testingType2a.getX(), 7);
                    equal(testingType2a.getS(), 22);
                    equal(testingType2a.fb(3, 4), -1);
                    equal(testingType2a.getA(), 2);
                    equal(testingType2a.getB(), 1);
                    equal(testingType2a.getX(), 16);
                    equal(testingType2a.getS(), 22);
                    equal(testingType2a.fd(5, 6), -1);
                    equal(testingType2a.getA(), 2);
                    equal(testingType2a.getB(), 1);
                    equal(testingType2a.getX(), 26);
                    equal(testingType2a.getS(), 22);
                    equal(TestingType2.shared.sfc(1), 23);
                    equal(TestingType2.shared.sfc(2), 24);
                });
            },
            test4: function () {
                test('TestingType3', function () {
                    var o, testingType3, testingType3a;
                    ok(TestingType3 instanceof Object);
                    ok(TestingType3 instanceof Function);
                    ok(newType.isInstance(TestingType3, Object));
                    ok(newType.isInstance(TestingType3, Function));
                    ok(newType.isInstance(TestingType3, 'Object'));
                    ok(newType.isInstance(TestingType3, 'Function'));
                    equal(newType.getTypeFullName(TestingType3), 'TestingType3');
                    equal(newType.getTypeName(TestingType3), 'TestingType3');
                    testingType3 = new TestingType3();
                    testingType3._(1, 2);
                    ok(testingType3 instanceof Object);
                    ok(testingType3 instanceof TestingType1);
                    ok(testingType3 instanceof TestingType2);
                    ok(testingType3 instanceof TestingType3);
                    ok(newType.isInstance(testingType3, Object));
                    ok(newType.isInstance(testingType3, 'Object'));
                    ok(newType.isInstance(testingType3, TestingType1));
                    ok(newType.isInstance(testingType3, 'TestingType1'));
                    ok(newType.isInstance(testingType3, TestingType2));
                    ok(newType.isInstance(testingType3, 'TestingType2'));
                    ok(newType.isInstance(testingType3, TestingType3));
                    ok(newType.isInstance(testingType3, 'TestingType3'));
                    ok(newType.isInstance(testingType3, TestingInterface1));
                    ok(newType.isInstance(testingType3, 'TestingInterface1'));
                    ok(newType.isInstance(testingType3, TestingInterface2));
                    ok(newType.isInstance(testingType3, 'TestingInterface2'));
                    ok(newType.isInstance(testingType3, TestingInterface3));
                    ok(newType.isInstance(testingType3, 'TestingInterface3'));
                    equal(testingType3.getA(), 1);
                    equal(testingType3.getB(), 2);
                    equal(testingType3.getX(), 12);
                    equal(testingType3.getS(), 24);
                    equal(testingType3.fb(3, 4), -1);
                    equal(testingType3.getA(), 1);
                    equal(testingType3.getB(), 2);
                    equal(testingType3.getX(), 12);
                    equal(testingType3.getS(), 24);
                    equal(testingType3.fd(5, 6), -1);
                    equal(testingType3.getA(), 1);
                    equal(testingType3.getB(), 2);
                    equal(testingType3.getX(), 26);
                    equal(testingType3.getS(), 24);
                    testingType3a = new TestingType3();
                    testingType3a._(1, 2);
                    equal(testingType3a.getA(), 1);
                    equal(testingType3a.getB(), 2);
                    equal(testingType3a.getX(), 12);
                    equal(testingType3a.getS(), 37);
                    equal(testingType3a.fb(3, 4), -1);
                    equal(testingType3a.getA(), 1);
                    equal(testingType3a.getB(), 2);
                    equal(testingType3a.getX(), 12);
                    equal(testingType3a.getS(), 37);
                    equal(testingType3a.fd(5, 6), -1);
                    equal(testingType3a.getA(), 1);
                    equal(testingType3a.getB(), 2);
                    equal(testingType3a.getX(), 26);
                    equal(testingType3a.getS(), 37);
                    equal(TestingType2.shared.sfc(0), 38);
                    equal(TestingType3.shared.sfc(0), 76);
                    equal(TestingType3.shared.sfc(1), 77);
                    o = testingType3a.newObj();
                    ok(o instanceof TestingType3);
                    o = TestingType3.shared.sNewObj();
                    ok(o instanceof TestingType3);
                });
            },
            test5: function () {
                test('Checking Subtypes', function () {
                    ok(TestingType2.prototype instanceof TestingType1);
                    ok(TestingType3.prototype instanceof TestingType2);
                    ok(!newType.isInstance(TestingType1.prototype, TestingInterface1));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingInterface1'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingInterface2));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingInterface2'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingInterface3));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingInterface3'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingType1));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingType1'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingType2));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingType2'));
                    ok(!newType.isInstance(TestingType1.prototype, TestingType3));
                    ok(!newType.isInstance(TestingType1.prototype, 'TestingType3'));
                    ok(newType.isInstance(TestingType2.prototype, TestingInterface1));
                    ok(newType.isInstance(TestingType2.prototype, 'TestingInterface1'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingInterface2));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingInterface2'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingInterface3));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingInterface3'));
                    ok(newType.isInstance(TestingType2.prototype, TestingType1));
                    ok(newType.isInstance(TestingType2.prototype, 'TestingType1'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingType2));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingType2'));
                    ok(!newType.isInstance(TestingType2.prototype, TestingType3));
                    ok(!newType.isInstance(TestingType2.prototype, 'TestingType3'));
                    ok(newType.isInstance(TestingType3.prototype, TestingInterface1));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingInterface1'));
                    ok(newType.isInstance(TestingType3.prototype, TestingInterface2));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingInterface2'));
                    ok(newType.isInstance(TestingType3.prototype, TestingInterface3));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingInterface3'));
                    ok(newType.isInstance(TestingType3.prototype, TestingType1));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingType1'));
                    ok(newType.isInstance(TestingType3.prototype, TestingType2));
                    ok(newType.isInstance(TestingType3.prototype, 'TestingType2'));
                    ok(!newType.isInstance(TestingType3.prototype, TestingType3));
                    ok(!newType.isInstance(TestingType3.prototype, 'TestingType3'));
                });
            },
            test6: function () {
                test('Testing Namespace', function () {
                    var o, testingNSType1, testingNSType2;
                    ok(com.googlecode.myquicknet.testing.TestingNSType1 instanceof Object);
                    ok(com.googlecode.myquicknet.testing.TestingNSType1 instanceof Function);
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1, Object));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1, Function));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1, 'Object'));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1, 'Function'));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1.prototype, com.googlecode.myquicknet.testing.TestingNSInterface1)));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1.prototype, 'com.googlecode.myquicknet.testing.TestingNSInterface1')));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1.prototype, com.googlecode.myquicknet.testing.TestingNSInterface2)));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1.prototype, 'com.googlecode.myquicknet.testing.TestingNSInterface2')));
                    equal(newType.getTypeFullName(com.googlecode.myquicknet.testing.TestingNSType1), 'com.googlecode.myquicknet.testing.TestingNSType1');
                    equal(newType.getTypeName(com.googlecode.myquicknet.testing.TestingNSType1), 'TestingNSType1');
                    ok(com.googlecode.myquicknet.testing.TestingNSType2 instanceof Object);
                    ok(com.googlecode.myquicknet.testing.TestingNSType2 instanceof Function);
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2, Object));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2, Function));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2, 'Object'));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2, 'Function'));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, com.googlecode.myquicknet.testing.TestingNSInterface1));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, 'com.googlecode.myquicknet.testing.TestingNSInterface1'));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, com.googlecode.myquicknet.testing.TestingNSInterface2));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, 'com.googlecode.myquicknet.testing.TestingNSInterface2'));
                    equal(newType.getTypeFullName(com.googlecode.myquicknet.testing.TestingNSType2), 'com.googlecode.myquicknet.testing.TestingNSType2');
                    equal(newType.getTypeName(com.googlecode.myquicknet.testing.TestingNSType2), 'TestingNSType2');
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1.prototype, com.googlecode.myquicknet.testing.TestingNSType1)));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType1.prototype, 'com.googlecode.myquicknet.testing.TestingNSType1')));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, com.googlecode.myquicknet.testing.TestingNSType1));
                    ok(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, com.googlecode.myquicknet.testing.TestingNSType2)));
                    ok(!(newType.isInstance(com.googlecode.myquicknet.testing.TestingNSType2.prototype, 'com.googlecode.myquicknet.testing.TestingNSType2')));
                    testingNSType1 = new com.googlecode.myquicknet.testing.TestingNSType1();
                    testingNSType2 = new com.googlecode.myquicknet.testing.TestingNSType2();
                    ok(testingNSType1 instanceof Object);
                    ok(testingNSType1 instanceof com.googlecode.myquicknet.testing.TestingNSType1);
                    ok(newType.isInstance(testingNSType1, Object));
                    ok(newType.isInstance(testingNSType1, 'Object'));
                    ok(newType.isInstance(testingNSType1, com.googlecode.myquicknet.testing.TestingNSType1));
                    ok(newType.isInstance(testingNSType1, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    ok(testingNSType2 instanceof Object);
                    ok(testingNSType2 instanceof com.googlecode.myquicknet.testing.TestingNSType2);
                    ok(newType.isInstance(testingNSType2, Object));
                    ok(newType.isInstance(testingNSType2, 'Object'));
                    ok(newType.isInstance(testingNSType2, com.googlecode.myquicknet.testing.TestingNSType2));
                    ok(newType.isInstance(testingNSType2, 'com.googlecode.myquicknet.testing.TestingNSType2'));
                    ok(testingNSType2 instanceof com.googlecode.myquicknet.testing.TestingNSType1);
                    ok(newType.isInstance(testingNSType2, com.googlecode.myquicknet.testing.TestingNSType1));
                    ok(newType.isInstance(testingNSType2, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    ok(newType.isInstance(testingNSType2, com.googlecode.myquicknet.testing.TestingNSInterface1));
                    ok(newType.isInstance(testingNSType2, 'com.googlecode.myquicknet.testing.TestingNSInterface1'));
                    o = testingNSType2.new_TestingNSType1();
                    ok(newType.isInstance(o, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    o = testingNSType2.newT2();
                    ok(newType.isInstance(o, 'com.googlecode.myquicknet.testing.TestingNSType2'));
                    o = testingNSType2.newTestingNSType1();
                    ok(newType.isInstance(o, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    o = com.googlecode.myquicknet.testing.TestingNSType2.shared.snew_TestingNSType1();
                    ok(newType.isInstance(o, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    o = com.googlecode.myquicknet.testing.TestingNSType2.shared.snewT2();
                    ok(newType.isInstance(o, 'com.googlecode.myquicknet.testing.TestingNSType2'));
                    o = com.googlecode.myquicknet.testing.TestingNSType2.shared.snewTestingNSType1();
                    ok(newType.isInstance(o, 'com.googlecode.myquicknet.testing.TestingNSType1'));
                    equal(testingNSType2.testingTestingType2(), 'ok too!');
                    equal(com.googlecode.myquicknet.testing.TestingNSType2.shared.stestingTestingType2(), 'ok too!');
                    o = new TestingType2();
                    o._(0, 0);
                    equal(typeof (o.getA()), 'number');
                });
            }
        }
    });
}());
