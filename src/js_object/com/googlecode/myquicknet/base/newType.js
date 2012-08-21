/**
 * newType
 * @package MyQuickNet
 * @version 2.1
 * @copyright (c) 2012 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/**
 *
 */
var base = {};
var my = {};
var self = {};
var shared = {};
var newType;

(function (global) {
    'use strict';

    var NewType = function () {
        this['_com.googlecode.myquicknet.base.NewType'] = {};
    }

    NewType.prototype = {};

    NewType.prototype._ = function () {
        var my = this['_com.googlecode.myquicknet.base.NewType'];
        my.stack = [];
        return this;
    };

    NewType.prototype._backup = function () {
        var my = this['_com.googlecode.myquicknet.base.NewType'];
        my.stack.push(global.base);
        my.stack.push(global.my);
        my.stack.push(global.self);
        my.stack.push(global.shared);
    };

    NewType.prototype._decorateMethod = function (method) {
        var my = this['_com.googlecode.myquicknet.base.NewType'];
        var vBase = my.base;
        var vMethod = method;
        var vFullName = my.fullName.toString();
        var vNewType = this;
        var vSelf = my.self;
        var vShared = my.shared;

        return function () {
            var r;
            vNewType._backup();
            global.base = (vBase && vBase.prototype) ? vBase.prototype : null;
            global.my = this['_' + vFullName];
            global.self = vSelf;
            global.shared = vShared;
            r = vMethod.apply(this, arguments);
            vNewType._restore();
            return r;
        };
    };

    NewType.prototype._decorateSharedMethod = function (method) {
        var my = this['_com.googlecode.myquicknet.base.NewType'];
        var vBase = my.base;
        var vMethod = method;
        var vNewType = this;
        var vSelf = my.self;
        var vShared = my.shared;

        return function () {
            var r;
            vNewType._backup();
            global.base = vBase.shared || null;
            global.my = null;
            global.self = vSelf;
            global.shared = vShared;
            r = vMethod.apply(this, arguments);
            vNewType._restore();
            return r;
        };
    };

    NewType.prototype._defCore = function (_) {
        var my = this['_com.googlecode.myquicknet.base.NewType'];

        if (my.base) {
            _[my.name] = (function (vBase, _, vName, vFullName) {
                return function () {
                    var propertyName;
                    vBase.call(this);
                    this['_' + vFullName] = {};

                    for (propertyName in _[vName].prototype) {
                        if ((typeof _[vName].prototype[propertyName] === 'object') && (propertyName.charAt(0) === '_')) {
                            this[propertyName] = _[vName].prototype[propertyName];
                        }
                    }
                };
            }(my.base, _, my.name, my.fullName));

            _[my.name].prototype = new (my.base)();
        } else {
            _[my.name] = (function (_, vName, vFullName) {
                return function () {
                    var propertyName;
                    this['_' + vFullName] = {};

                    for (propertyName in _[vName].prototype) {
                        if ((typeof _[vName].prototype[propertyName] === 'object') && (propertyName.charAt(0) === '_')) {
                            this[propertyName] = _[vName].prototype[propertyName];
                        }
                    }
                };
            }(_, my.name, my.fullName));

            _[my.name].prototype = {};
        }

        my.self = _[my.name];
    };

    NewType.prototype._restore = function () {
        var my = this['_com.googlecode.myquicknet.base.NewType'];
        global.shared = my.stack.pop();
        global.self = my.stack.pop();
        global.my = my.stack.pop();
        global.base = my.stack.pop();
    };

    NewType.prototype.def = function (args) {
        var _, baseNameSplits, baseNameSplitsCount, f, i, interfacesCount, interfaceName, methodName, namespaceSplits, namespaceSplitsCount;
        var my = this['_com.googlecode.myquicknet.base.NewType'];

        if ('namespace' in args) {
            my.namespace = args.namespace.toString();
            _ = global;
            namespaceSplits = my.namespace.split('.');
            namespaceSplitsCount = namespaceSplits.length;

            for (i = 0; i < namespaceSplitsCount; ++i) {
                if (!(namespaceSplits[i] in _)) {
                    _[namespaceSplits[i]] = {}
                }

                _ = _[namespaceSplits[i]];
            }
        } else {
            my.namespace = '';
            _ = global;
        }

        my.name = args.name.toString();

        if (my.namespace === '') {
            my.fullName = my.name.toString();
        } else {
            my.fullName = my.namespace.toString() + '.' + my.name.toString();
        }

        if (typeof args.base === 'string') {
            my.base = global;
            baseNameSplits = args.base.split('.');
            baseNameSplitsCount = baseNameSplits.length;

            for (i = 0; i < baseNameSplitsCount; ++i) {
                my.base = my.base[baseNameSplits[i]];
            }
        } else {
            my.base = args.base || null;
        }

        my.interfaces = args.interfaces || [];
        my.methods = args.methods || {};
        my.shared = args.shared || {};
        my.sharedMethods = args.sharedMethods || {};
        this._defCore(_);
        interfacesCount = my.interfaces.length;
        interfaceName = '';

        for (i = 0; i < interfacesCount; ++i) {
            if (typeof my.interfaces[i] === 'string') {
                interfaceName = my.interfaces[i].toString();
            } else {
                interfaceName = my.interfaces[i].typeName.toString();
            }

            _[my.name].prototype['_' + interfaceName] = {};
        }

        for (methodName in my.methods) {
            if (typeof my.methods[methodName] === 'function') {
                _[my.name].prototype[methodName] = this._decorateMethod(my.methods[methodName]);
            }
        }

        if (my.base) {
            f = (function () {});
            f.prototype = my.base.shared;
            _[my.name].shared = new f();
        } else {
            _[my.name].shared = {};
        }

        for (methodName in my.sharedMethods) {
            if (typeof my.sharedMethods[methodName] === 'function') {
                _[my.name].shared[methodName] = this._decorateSharedMethod(my.sharedMethods[methodName]);
            }
        }

        _[my.name].typeName = my.fullName.toString();
    };

    NewType.prototype.isInstance = function (object, type) {
        var typeName = (typeof type === 'string') ? type : (type.typeName.toString());
        return object.hasOwnProperty('_' + typeName);
    };

    NewType.shared = {};
    NewType.typeName = 'com.googlecode.myquicknet.base.NewType';

    (function (global) {
        var _, i, namespaceSplits, namespaceSplitsCount;
        _ = global;
        namespaceSplits = 'com.googlecode.myquicknet.base'.split('.');
        namespaceSplitsCount = namespaceSplits.length;

        for (i = 0; i < namespaceSplitsCount; ++i) {
            if (!(namespaceSplits[i] in _)) {
                _[namespaceSplits[i]] = {}
            }

            _ = _[namespaceSplits[i]];
        }

        _.NewType = NewType;
    }(global));

    global.newType = new com.googlecode.myquicknet.base.NewType();
    global.newType._();
}(this));
