/**
 * newType
 * @module MyQuickNet
 * @version 4.7
 * @copyright (c) 2014 MyQuickNet Development Group
 * @license http://opensource.org/licenses/MIT
 */
/*jslint nomen: true, plusplus: true, vars: true, browser: true */
/**
 * 
 * @global
 * @type Object
 */
var _ = {};

/**
 * 
 * @global
 * @type Object
 */
var base = {};

/**
 * 
 * @global
 * @type Object
 */
var my = {};

/**
 * 
 * @global
 * @type Object
 */
var self = {};

/**
 * 
 * @global
 * @type Object
 */
var shared = {};

/**
 * 
 * @global
 * @type Object
 */
var newType;

(function (global) {
    'use strict';
    var newTypeNamespace = 'com.googlecode.myquicknet.base';
    var newTypeTypeFullName = newTypeNamespace.toString() + '.NewType';

    /**
     * 
     * @constructor com.googlecode.myquicknet.base.NewType
     * @memberof! <global>
     */
    var NewType = function () {
        this._Object = {};
        this['_' + newTypeTypeFullName.toString()] = {};
        NewType.prototype._.apply(this, arguments);
    };

    NewType._Object = {};
    NewType._Function = {};
    NewType.prototype = {};
    NewType.prototype.constructor = NewType;

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._
     * @returns {Object}
     */
    NewType.prototype._ = function () {
        var my = this['_' + newTypeTypeFullName.toString()];
        my.stack = [];
        return this;
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._backup
     * @protected
     * @returns {undefined}
     */
    NewType.prototype._backup = function () {
        var my = this['_' + newTypeTypeFullName.toString()];
        my.stack.push(global._);
        my.stack.push(global.base);
        my.stack.push(global.my);
        my.stack.push(global.self);
        my.stack.push(global.shared);
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._backupImportNames
     * @protected
     * @param {Array} importNames
     * @returns {undefined}
     */
    NewType.prototype._backupImportNames = function (importNames) {
        var i, importNamesCount;
        var my = this['_' + newTypeTypeFullName.toString()];
        importNamesCount = importNames.length;

        for (i = 0; i < importNamesCount; ++i) {
            my.stack.push(global[importNames[i].toString()]);
        }
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._createPrototype
     * @protected
     * @param {Object} proto
     * @returns {Object}
     */
    NewType.prototype._createPrototype = function (proto) {
        var Ctor = function () {
            return this;
        };

        Ctor.prototype = proto;
        return new Ctor();
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._decorateMethod
     * @protected
     * @param {Function} method
     * @returns {Function}
     */
    NewType.prototype._decorateMethod = function (method) {
        var my = this['_' + newTypeTypeFullName.toString()];
        var v_ = my._;
        var vBase = my.base;
        var vImportFullNames = my.importFullNames;
        var vImportNames = my.importNames;
        var vMethod = method;
        var vFullName = my.fullName.toString();
        var vNewType = this;
        var vSelf = my.self;
        var vShared = my.shared;

        return function () {
            var i, importNamesCount, r;
            vNewType._backup();
            vNewType._backupImportNames(vImportNames);
            global._ = v_;
            global.base = vBase || null;
            global.my = this['_' + vFullName.toString()];
            global.self = vSelf;
            global.shared = vShared;
            importNamesCount = vImportNames.length;

            for (i = 0; i < importNamesCount; ++i) {
                global[vImportNames[i].toString()] = vNewType.getTypeFromFullName(vImportFullNames[i].toString());
            }

            r = vMethod.apply(this, arguments);
            vNewType._restoreImportNames(vImportNames);
            vNewType._restore();
            return r;
        };
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._decorateSharedMethod
     * @protected
     * @param {Function} method
     * @returns {Function}
     */
    NewType.prototype._decorateSharedMethod = function (method) {
        var my = this['_' + newTypeTypeFullName.toString()];
        var v_ = my._;
        var vBase = my.base;
        var vImportFullNames = my.importFullNames;
        var vImportNames = my.importNames;
        var vMethod = method;
        var vNewType = this;
        var vSelf = my.self;
        var vShared = my.shared;

        return function () {
            var i, importNamesCount, r;
            vNewType._backup();
            vNewType._backupImportNames(vImportNames);
            global._ = v_;
            global.base = (vBase && vBase.shared) ? vBase.shared : null;
            global.my = null;
            global.self = vSelf;
            global.shared = vShared;
            importNamesCount = vImportNames.length;

            for (i = 0; i < importNamesCount; ++i) {
                global[vImportNames[i].toString()] = vNewType.getTypeFromFullName(vImportFullNames[i].toString());
            }

            r = vMethod.apply(this, arguments);
            vNewType._restoreImportNames(vImportNames);
            vNewType._restore();
            return r;
        };
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._defCore
     * @protected
     * @returns {undefined}
     */
    NewType.prototype._defCore = function () {
        var _, baseFullName, propertyName2;
        var my = this['_' + newTypeTypeFullName.toString()];
        _ = my._;

        if (my.base) {
            _[my.name.toString()] = (function (v_, vName, vFullName) {
                return function () {
                    var propertyName;
                    this._Object = {};
                    this['_' + vFullName.toString()] = {};

                    for (propertyName in v_[vName.toString()].prototype) {
                        if ((typeof v_[vName.toString()].prototype[propertyName] === 'object') && (propertyName.toString().charAt(0) === '_')) {
                            this[propertyName.toString()] = v_[vName.toString()].prototype[propertyName.toString()];
                        }
                    }

                    if (typeof v_[vName.toString()].prototype._ === 'function') {
                        v_[vName.toString()].prototype._.apply(this, arguments);
                    }
                };
            }(_, my.name, my.fullName));

            _[my.name.toString()].prototype = this._createPrototype(my.base.prototype);
            baseFullName = this.getTypeFullName(my.base).toString();
            _[my.name.toString()].prototype['_' + baseFullName.toString()] = {};

            for (propertyName2 in my.base.prototype) {
                if ((typeof my.base.prototype[propertyName2] === 'object') && (propertyName2.toString().charAt(0) === '_')) {
                    _[my.name.toString()].prototype[propertyName2.toString()] = my.base.prototype[propertyName2.toString()];
                }
            }
        } else {
            _[my.name.toString()] = (function (v_, vName, vFullName) {
                return function () {
                    var propertyName;
                    this._Object = {};
                    this['_' + vFullName.toString()] = {};

                    for (propertyName in v_[vName.toString()].prototype) {
                        if ((typeof v_[vName.toString()].prototype[propertyName] === 'object') && (propertyName.toString().charAt(0) === '_')) {
                            this[propertyName.toString()] = v_[vName.toString()].prototype[propertyName.toString()];
                        }
                    }

                    if (typeof v_[vName.toString()].prototype._ === 'function') {
                        v_[vName.toString()].prototype._.apply(this, arguments);
                    }
                };
            }(_, my.name, my.fullName));

            _[my.name.toString()].prototype = {};
        }

        _[my.name.toString()].prototype.constructor = _[my.name.toString()];
        _[my.name.toString()]._Object = {};
        _[my.name.toString()]._Function = {};
        my.self = _[my.name.toString()];
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._defImports
     * @protected
     * @param {Array} imports
     * @returns {undefined}
     */
    NewType.prototype._defImports = function (imports) {
        var i, imports2, importsCount, importsItem, importFullName, importFullNameSplits, importName;
        var my = this['_' + newTypeTypeFullName.toString()];
        imports2 = {};
        importsCount = imports.length;

        for (i = 0; i < importsCount; ++i) {
            importsItem = imports[i];
            importFullName = importsItem[0].toString();

            if (importsItem.length < 2) {
                importFullNameSplits = importFullName.toString().split('.');
                importName = importFullNameSplits[importFullNameSplits.length - 1].toString();
            } else {
                importName = importsItem[1].toString();
            }

            imports2[importName.toString()] = importFullName.toString();
        }

        my.importNames = [];
        my.importFullNames = [];
        i = 0;

        for (importName in imports2) {
            if (typeof imports2[importName] === 'string') {
                my.importNames[i] = importName.toString();
                my.importFullNames[i] = imports2[importName.toString()].toString();
                ++i;
            }
        }
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._restore
     * @protected
     * @returns {undefined}
     */
    NewType.prototype._restore = function () {
        var my = this['_' + newTypeTypeFullName.toString()];
        global.shared = my.stack.pop();
        global.self = my.stack.pop();
        global.my = my.stack.pop();
        global.base = my.stack.pop();
        global._ = my.stack.pop();
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype._restoreImportNames
     * @protected
     * @param {Array} importNames
     * @returns {undefined}
     */
    NewType.prototype._restoreImportNames = function (importNames) {
        var i, importNamesCount;
        var my = this['_' + newTypeTypeFullName.toString()];
        importNamesCount = importNames.length;

        for (i = importNamesCount - 1; i >= 0; --i) {
            global[importNames[i].toString()] = my.stack.pop();

            if (global[importNames[i].toString()] === undefined) {
                delete global[importNames[i].toString()];
            }
        }
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype.def
     * @param {Object} args
     * @returns {undefined}
     */
    NewType.prototype.def = function (args) {
        var _, i, interfacesCount, interfaceName, methodName, namespaceSplits, namespaceSplitsCount;
        var my = this['_' + newTypeTypeFullName.toString()];

        if (args.hasOwnProperty('namespace')) {
            my.namespace = args.namespace.toString();
            _ = global;
            namespaceSplits = my.namespace.toString().split('.');
            namespaceSplitsCount = namespaceSplits.length;

            for (i = 0; i < namespaceSplitsCount; ++i) {
                if (!_.hasOwnProperty(namespaceSplits[i].toString())) {
                    _[namespaceSplits[i].toString()] = {};
                }

                _ = _[namespaceSplits[i].toString()];
            }
        } else {
            my.namespace = '';
            _ = global;
        }

        my._ = _;
        my.name = args.name.toString();

        if (my.namespace === '') {
            my.fullName = my.name.toString();
        } else {
            my.fullName = my.namespace.toString() + '.' + my.name.toString();
        }

        if (typeof args.base === 'string') {
            my.base = this.getTypeFromFullName(args.base);
        } else {
            my.base = args.base || null;
        }

        my.interfaces = args.interfaces || [];
        this._defImports(args.imports || []);
        my.methods = args.methods || {};
        my.shared = args.shared || {};
        my.sharedMethods = args.sharedMethods || {};
        this._defCore();
        interfacesCount = my.interfaces.length;
        interfaceName = '';

        for (i = 0; i < interfacesCount; ++i) {
            if (typeof my.interfaces[i] === 'string') {
                interfaceName = my.interfaces[i].toString();
            } else {
                interfaceName = this.getTypeFullName(my.interfaces[i]).toString();
            }

            _[my.name.toString()].prototype['_' + interfaceName.toString()] = {};
        }

        for (methodName in my.methods) {
            if (typeof my.methods[methodName] === 'function') {
                _[my.name.toString()].prototype[methodName.toString()] = this._decorateMethod(my.methods[methodName.toString()]);
            }
        }

        if (my.base && my.base.shared) {
            _[my.name.toString()].shared = this._createPrototype(my.base.shared);
        } else {
            _[my.name.toString()].shared = {};
        }

        for (methodName in my.sharedMethods) {
            if (typeof my.sharedMethods[methodName] === 'function') {
                _[my.name.toString()].shared[methodName.toString()] = this._decorateSharedMethod(my.sharedMethods[methodName.toString()]);
            }
        }

        _[my.name.toString()]._Function.typeFullName = my.fullName.toString();
        _[my.name.toString()]._Function.typeName = my.name.toString();
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype.getTypeFromFullName
     * @param {String} fullName
     * @returns {Object}
     */
    NewType.prototype.getTypeFromFullName = function (fullName) {
        var fullNameSplits, fullNameSplitsCount, i, type;
        fullName = fullName.toString();
        type = global;
        fullNameSplits = fullName.toString().split('.');
        fullNameSplitsCount = fullNameSplits.length;

        for (i = 0; i < fullNameSplitsCount; ++i) {
            if (type.hasOwnProperty(fullNameSplits[i].toString())) {
                type = type[fullNameSplits[i].toString()];
            } else {
                throw new ReferenceError(fullName.toString() + ' not found.');
            }
        }

        return type;
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype.getTypeFullName
     * @param {Object} object
     * @returns {String|null}
     */
    NewType.prototype.getTypeFullName = function (object) {
        var typeFullName;
        typeFullName = null;

        if (object && object.hasOwnProperty('_Function')) {
            if (object._Function.hasOwnProperty('typeFullName')) {
                if (typeof object._Function.typeFullName === 'string') {
                    typeFullName = object._Function.typeFullName.toString();
                }
            }
        }

        return typeFullName;
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype.getTypeName
     * @param {Object} object
     * @returns {String|null}
     */
    NewType.prototype.getTypeName = function (object) {
        var typeName;
        typeName = null;

        if (object && object.hasOwnProperty('_Function')) {
            if (object._Function.hasOwnProperty('typeName')) {
                if (typeof object._Function.typeName === 'string') {
                    typeName = object._Function.typeName.toString();
                }
            }
        }

        return typeName;
    };

    /**
     * 
     * @method com.googlecode.myquicknet.base.NewType.prototype.isInstance
     * @param {Object} object
     * @param {Object|String} type
     * @returns {Boolean}
     */
    NewType.prototype.isInstance = function (object, type) {
        var typeFullName;

        if (typeof type === 'string') {
            typeFullName = type.toString();
        } else {
            if (object instanceof type) {
                return true;
            }

            typeFullName = this.getTypeFullName(type).toString();

            if (typeFullName === null) {
                return false;
            }
        }

        return object.hasOwnProperty('_' + typeFullName.toString());
    };

    NewType.shared = {};
    NewType._Function.typeFullName = newTypeTypeFullName.toString();
    NewType._Function.typeName = 'NewType';

    (function () {
        var _, i, namespaceSplits, namespaceSplitsCount;
        _ = global;
        namespaceSplits = newTypeNamespace.toString().split('.');
        namespaceSplitsCount = namespaceSplits.length;

        for (i = 0; i < namespaceSplitsCount; ++i) {
            if (!_.hasOwnProperty(namespaceSplits[i].toString())) {
                _[namespaceSplits[i].toString()] = {};
            }

            _ = _[namespaceSplits[i].toString()];
        }

        _.NewType = NewType;
    }());

    global.newType = new global.com.googlecode.myquicknet.base.NewType();
}(this));
