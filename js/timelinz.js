/**
 * Timelinz
 * @version 1.0.2
 * @copyright 2015 Rasool Dastoori http://codecanyon.net/user/dastoori
 * @license under CodeCanyon License (http://codecanyon.net/licenses)
 * @lastModified 2015-10-30
 */

/*globals define: false, module: false*/

(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        // AMD. Register as an anonymous module.
        define([], factory);
    } else if (typeof exports === 'object') {
        // CommonJS
        module.exports = factory();
    } else {
        // Browser globals (root is window)
        root.Timelinz = factory();
    }
})(this, function () {
    'use strict';

    ///////////////
    // Utilities //
    ///////////////

    /**
     * A no-operation function
     */
    var noop = function () {};

    /**
     * Prepend leading zero to the number
     * @param   {Number} num
     * @param   {Number} count
     * @returns {String}
     */
    var pad = function (num, count) {
        count = count || 2;
        return ((new Array(count + 1)).join('0') + num).slice(count * -1);
    };

    /**
     * Merge defaults with options
     * @private
     * @param   {Object}    defaults Default settings
     * @param   {...Object} options User options
     * @returns {Object}    Merged values of defaults and options
     */
    var extend = function (defaults /* , ...options */) {
        [].slice.call(arguments, 1).forEach(function (option) {
            if (!option) {
                return;
            }
            Object.keys(option).forEach(function (prop) {
                defaults[prop] = option[prop];
            });
        });
        return defaults;
    };

    /**
     * Convert html to Element
     * @param   {String}  html
     * @returns {Element}
     */
    var toElement = function (html) {
        var elem = document.createElement('div');
        elem.innerHTML = html;
        return elem.children[0];
    };

    /**
     * Template engine
     * @param   {String} template
     * @param   {Object} params   Template parameters
     * @returns {String}
     */
    var tmpl = function (template, params) {
        if (!params) {
            return template;
        }
        Object.keys(params).forEach(function (key) {
            template = template.replace(
                new RegExp('{' + key + '}', 'g'),
                params[key]
            );
        });
        return template;
    };

    /**
     * Compile template and return Element
     * @param   {String} template
     * @param   {Object} params   Template parameters
     * @returns {Element}
     */
    var compile = function (template, params) {
        return toElement(tmpl(template, params));
    };


    /////////////
    // Private //
    /////////////

    var UNITS = ['seconds', 'minute', 'hour', 'day', 'month', 'year', 'decade'];
    var MONTHS = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

    /**
     * Default templates
     * @private
     * @type {Object}
     */
    var defaultTemplates = {
        main: '<div class="timelinz"></div>',
        intervalWrap: '<div class="timelinz__interval-wrap"></div>',
        interval: '<div class="timelinz__interval">' +
                    '<span class="timelinz__interval-time">{time}</span>' +
                '</div>',
        lineWrap: '<div class="timelinz__line-wrap"></div>',
        line: '<div class="timelinz__line timelinz__line_name_{name}">' +
                   '<div class="timelinz__empty-line"></div>' +
               '</div>',
        filledLine: '<div class="timelinz__filled-line"></div>',
        normalPoint: '<{tag} class="timelinz__point"></{tag}>',
        imagePoint: '<{tag} class="timelinz__point timelinz__point_has_image">' +
                        '<img src="{img}" class="timelinz__point-img">' +
                    '</{tag}>'
    };

    /**
     * Default options
     * @private
     * @type {Object}
     */
    var defaultOptions = {
        /**
         * Margin between each lines
         * @type {Number}
         */
        marginBetweenLines: 10,

        /**
         * Specifies the time interval
         * @type {String}
         */
        intervalUnit: 'year',

        /**
         * Add extra interval before and after the other intervals
         * @type {Array}
         */
        extraIntervals: [1, 2],

        /**
         * Interval formatter function
         * @param   {Date}   time Interval
         * @returns {String}
         */
        intervalFormat: function (time) {
            return calcUnit[this.intervalUnit].format(time);
        },

        /**
         * Specifies whether the points should be in ascending order or reverse
         * @type {Boolean}
         */
        reverseOrder: false,

        /**
         * Sorts the list of timeline points
         * @param   {Array}   points    Timeline points
         * @param   {Boolean} isReverse Specifies whether the points should be in ascending order or reverse. default value is `false`
         * @returns {Object}            sorted data
         */
        sortPoints: function (points, isReverse) {
            return points.sort(function (a, b) {
                return new Date((isReverse ? b : a).time) - new Date((isReverse ? a : b).time);
            });
        },

        /**
         * Fires when the timeline is start rendering
         * @type {Function}
         */
        onLineRender: noop,

        /**
         * Fires after the timeline is rendered
         * @type {Function}
         */
        onLineRendered: noop,

        /**
         * Fires after the point are rendered
         * @type {Function}
         */
        onPointRendered: noop,

        /**
         * Fires when point is clicked
         * @type {Function}
         */
        onPointClicked: noop,

        /**
         * Fires after the timelinz is rendered
         * @type {Function}
         */
        onRenderCompleted: noop
    };

    /**
     * Calculate percent of the `value` between the `min` and `max` numbers
     * @param   {Number} value
     * @param   {Number} min
     * @param   {Number} max
     * @returns {Number} percentage number
     */
    var calcRangeToPercentage = function (value, min, max) {
        return (value - min) / (max - min);
    };

    /**
     * Calculate value of the `percentage` between the `min` and `max` number
     * @param   {Number} percentage number
     * @param   {Number} min
     * @param   {Number} max
     * @returns {Number} value
     */
    var calcRangeFromPercentage = function (percentage, min, max) {
        return percentage * (max - min) + min;
    };

    /**
     * Calculate units
     * @type {Object}
     */
    var calcUnit = {
        seconds: function (time) {
            return time.getSeconds();
        },

        minute: function (time) {
            return time.getMinutes();
        },

        hour: function (time) {
            return time.getHours();
        },

        day: function (time) {
            return time.getDate();
        },

        month: function (time) {
            return time.getMonth() + 1;
        },

        year: function (time) {
            return time.getFullYear();
        },

        decade: function (time) {
            return ~~(time.getFullYear() / 10) * 10;
        }
    };

    // Unit ranges
    calcUnit.seconds.range = [0, 60];
    calcUnit.minute.range = [0, 60];
    calcUnit.hour.range = [0, 23];
    calcUnit.day.range = [1, 31];
    calcUnit.month.range = [1, 12];
    calcUnit.year.range = [0, 9];

    // Unit format
    calcUnit.minute.format = function (time) {
        return calcUnit.hour.format(time).slice(0, -2) + pad(time.getMinutes());
    };

    calcUnit.hour.format = function (time) {
        return calcUnit.day.format(time) + ' ' + pad(time.getHours()) + ':00';
    };

    calcUnit.day.format = function (time) {
        return MONTHS[time.getMonth()] + ' ' + pad(time.getDate());
    };

    calcUnit.month.format = function (time) {
        return MONTHS[time.getMonth()] + ' ' + time.getFullYear();
    };

    calcUnit.year.format = calcUnit.year.bind(calcUnit.year);

    calcUnit.decade.format = function (time) {
        return calcUnit.decade(time) + '\'s';
    };

    /**
     * Add and subtract time
     * @param   {Date} time
     * @param   {Number} value
     * @param   {String} unit
     * @returns {Date}
     */
    var calcTime = function (time, value, unit) {
        if (unit === 'minute') {
            time.setMinutes(time.getMinutes() + value);
        } else if (unit === 'hour') {
            time.setHours(time.getHours() + value);
        } else if (unit === 'day') {
            time.setDate(time.getDate() + value);
        } else if (unit === 'month') {
            // Add month, with consideration of leap years
            var getDaysInMonth = function (year, month) {
                return [31, (((year % 4 === 0) && (year % 100 !== 0)) || (year % 400 === 0)) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][month];
            };
            var day = time.getDate();
            time.setDate(1);
            time.setMonth(time.getMonth() + value);
            time.setDate(Math.min(day, getDaysInMonth(time.getFullYear(), time.getMonth())));
        } else if (unit === 'year') {
            time.setFullYear(time.getFullYear() + value);
        } else if (unit === 'decade') {
            time.setFullYear(calcUnit.decade(time) + (value * 10));
        }
        return time;
    };

    /**
     * Generate range between the `minTime` and `maxTime` based on `intervalUnit`
     * @param   {Date}    minTime
     * @param   {Date}    maxTime
     * @param   {String}  intervalUnit
     * @param   {Array}   extraIntervals
     * @param   {Boolean} isReverse
     * @returns {Array}
     */
    var generateIntervalRange = function (minTime, maxTime, intervalUnit, extraIntervals, isReverse) {
        var rng = [];
        minTime = new Date(minTime.getTime());
        maxTime = new Date(maxTime.getTime());
        calcTime(minTime, -extraIntervals[0], intervalUnit);
        calcTime(maxTime, extraIntervals[1], intervalUnit);

        while (minTime <= maxTime) {
            rng[isReverse ? 'unshift' : 'push'](new Date(minTime.getTime()));
            calcTime(minTime, 1, intervalUnit);
        }
        return rng;
    };

    /**
     * Generate filled range
     * @param   {Array}   points
     * @param   {String}  unit
     * @param   {Boolean} isReverse
     * @returns {Array}
     */
    var generateFilledRange = function (points, unit, isReverse) {
        var rng = [];
        var tmp;
        var last = false;

        for (
            var i = isReverse ? points.length - 1 : 0;
            isReverse ? i >= 0 : i < points.length;
            isReverse ? i-- : i++
        ) {
            var point = points[i];
            var time = new Date(point.time);

            // Reset `tmp` when new range is started
            if (!last && point.filled) {
                tmp = [{
                    time: time,
                    elem: point.elem
                }];

            // Push `tmp` to `rng` when range is ends
            } else if (last && !point.filled || i === (isReverse ? 0 : points.length - 1)) {
                tmp[isReverse ? 'unshift' : 'push']({
                    time: time,
                    elem: point.elem
                });
                rng[isReverse ? 'unshift' : 'push'](tmp);
            }
            last = point.filled;
        }
        return rng;
    };

    /**
     * Get unique key from time based on unit
     * @param   {Date}   time
     * @param   {String} unit
     * @returns {String}
     */
    var getKeyFromTime = function (time, unit) {
        if (unit === 'year' || unit === 'decade') {
            return '' + calcUnit[unit](time);
        }

        var unitIndex = UNITS.indexOf(unit);
        var key = [];

        // Get value of larger units except decade
        for (var i = unitIndex; i < UNITS.length - 1; i++) {
            key.unshift(calcUnit[UNITS[i]](time));
        }
        return key.join('-');
    };

    /**
     * Calculate time and range to percent
     * @param   {Date}   time
     * @param   {String} unit
     * @returns {Object}
     */
    var getRangePercentageFromTime = function (time, unit) {
        var lUnitName = UNITS[UNITS.indexOf(unit) - 1];
        var lUnit = calcUnit[lUnitName](time);

        // Get last digit of the year
        if (unit === 'decade') {
            lUnit %= 10;
        }

        return calcRangeToPercentage(lUnit, calcUnit[lUnitName].range[0], calcUnit[lUnitName].range[1]);
    };

    /**
     * Calculate position based on position of the interval elements
     * @param   {Date}    time
     * @param   {Array}   intervalRange IntervalRange
     * @param   {String}  unit          IntervalUnit
     * @param   {Boolean} isReverse     Reverse order
     * @returns {Number}                Top position
     */
    var calcPosition = function (time, intervalRange, unit, isReverse) {
        var calcTop = function (elem) {
            return elem.offsetTop + (elem.offsetHeight / 2);
        };

        // Get `offsetTop` of lower and higher element and calculate percentage
        var lValue = calcTop(intervalRange[getKeyFromTime(time, unit)]);
        var hValue = intervalRange[getKeyFromTime(calcTime(new Date(time.getTime()), isReverse ? -1 : 1, unit), unit)];
        if (hValue) {
            var percent = getRangePercentageFromTime(time, unit) * (isReverse ? -1 : 1);
            return Math.round(calcRangeFromPercentage(percent, lValue, calcTop(hValue)));
        } else {
            return lValue;
        }
    };

    /**
     * Sort data and calculate min and max time
     */
    var calcMinAndMaxAndPrepareData = function () {
        var self = this;
        var options = self.options;
        var reverseOrder = options.reverseOrder;
        var minTime = [];
        var maxTime = [];

        // Sort data by time
        self.data.forEach(function (line) {
            if (!line.points || !line.points.length) {
                return;
            }

            // Set current time instead of "now"
            line.points.forEach(function (point) {
                if (point.time === 'now') {
                    point.time = new Date().toJSON();
                }
            });

            // Sort points
            options.sortPoints(line.points, reverseOrder);

            // Push min and max time of each line
            minTime.push(new Date(line.points[0].time));
            maxTime.push(new Date(line.points[line.points.length - 1].time));
        });

        // Get min and max time of the timeline
        self.minTime = new Date(Math.min.apply(null, reverseOrder ? maxTime : minTime));
        self.maxTime = new Date(Math.max.apply(null, reverseOrder ? minTime : maxTime));
    };

    /**
     * Generate interval range and append it to parent
     * @param  {Element} parent
     */
    var generateAndRenderIntervalRange = function (parent) {
        var self = this;
        var templates = self.templates;
        var options = self.options;
        var intervalUnit = options.intervalUnit;

        // Generate interval range
        var intervalRange = generateIntervalRange(self.minTime, self.maxTime, intervalUnit, options.extraIntervals, options.reverseOrder);

        // Generate interval's element
        var $intervalWrap = toElement(templates.intervalWrap);
        self.intervalRange = {};
        intervalRange.forEach(function (time) {
            var $interval = compile(templates.interval, {
                time: options.intervalFormat(time)
            });
            $intervalWrap.appendChild($interval);
            self.intervalRange[getKeyFromTime(time, intervalUnit)] = $interval;
        });

        // Generate timelinz element and append it to parent
        var $elem = toElement(templates.main);
        self.self.$elem = $elem;
        $elem.appendChild($intervalWrap);
        parent.appendChild($elem);
    };

    /**
     * Generate lines and append it to `parent`
     * @param  {Element} parent
     */
    var generateLinesAndAppendTo = function (parent) {
        var self = this;
        var templates = self.templates;
        var options = self.options;
        var intervalRange = self.intervalRange;
        var intervalUnit = options.intervalUnit;
        var reverseOrder = options.reverseOrder;
        var lineWidth;

        // Generate line wrap
        var $lineWrap = toElement(templates.lineWrap);
        parent.appendChild($lineWrap);

        self.data.forEach(function (line, lineIndex) {
            if (!line.points || !line.points.length) {
                return;
            }
            // Generate lines
            var $line = compile(templates.line, {
                name: line.name ? line.name.trim().toLowerCase().replace(/\s/g, '-') : 'no'
            });

            // Set `onLineRender` event
            options.onLineRender.call(self.self, $line, line);

            $lineWrap.appendChild($line);

            // Set left position of each line
            if (!lineWidth) {
                lineWidth = window.getComputedStyle($line).width;
            }
            $line.style.left = (options.marginBetweenLines + parseInt(lineWidth, 10)) * lineIndex + 'px';

            // Generate points
            line.points.forEach(function (point) {
                var $point;
                if (point.img) {
                    $point = compile(templates.imagePoint, {
                        tag: point.link ? 'a' : 'div',
                        img: point.img
                    });
                } else {
                    $point = compile(templates.normalPoint, {
                        tag: point.link ? 'a' : 'div'
                    });
                }

                if (point.link) {
                    $point.href = point.link;
                }

                // Set `onPointClicked` event
                $point.addEventListener('click', function (e) {
                    options.onPointClicked.call(this, e, point, line);
                }, false);

                $line.appendChild($point);

                // Set position
                $point.style.top = calcPosition(new Date(point.time), intervalRange, intervalUnit, reverseOrder) - ($point.offsetHeight / 2) + 'px';

                point.elem = $point;

                // Set `onPointRendered` event
                options.onPointRendered.call(self.self, $point, point, line);
            });

            var filledLineList = [];

            // Generate filled lines
            generateFilledRange(line.points, intervalUnit, reverseOrder).forEach(function (filledRange) {
                var $filledLine = toElement(templates.filledLine);
                $line.appendChild($filledLine);
                filledLineList.push($filledLine);

                filledRange.forEach(function (item) {
                    item.top = calcPosition(item.time, intervalRange, intervalUnit, reverseOrder);
                    // Half height of point
                    item.height = item.elem.offsetHeight / 2;
                });
                var lTop = filledRange[0].top + filledRange[0].height;
                var hTop = filledRange[1].top - filledRange[1].height;
                $filledLine.style.top = lTop + 'px';
                $filledLine.style.height = hTop - lTop + 'px';
            });

            // Set `onLineRendered` event
            options.onLineRendered.call(self.self, $line, line, filledLineList);
        });

        // Set `onRenderCompleted` event
        options.onRenderCompleted.call(self.self, parent);
    };

    ////////////
    // Public //
    ////////////

    /**
     * Timelinz constructor
     * @param {Object} data    Timelinz data
     * @param {Object} options User options
     */
    function Timelinz (data, options) {
        // Store data for each instance
        var templatesStore = {};
        var optionsStore = {};

        // Define properties
        Object.defineProperties(this, {
            templates: {
                get: function () {
                    return templatesStore;
                },

                set: function (value) {
                    templatesStore = extend({}, defaultTemplates, value);
                }
            },

            options: {
                get: function () {
                    return optionsStore;
                },

                set: function (value) {
                    optionsStore = extend({}, defaultOptions, value);

                    // If `intervalUnit` value is invalid then set minute as fallback
                    if (UNITS.indexOf(optionsStore.intervalUnit, 1) < 0) {
                        optionsStore.intervalUnit = UNITS[1];
                    }
                }
            }
        });

        // Set templates
        if (options) {
            this.templates = options.templates;
            delete options.templates;
        } else {
            this.templates = {};
        }

        // Set options
        this.options = options || {};

        // Set data
        this.data = data;

        /**
         * Render timelinz element based on `data` and `options`
         * @returns {Element} Timelinz element
         */
        this.render = function (parent) {
            if (!parent) {
                return false;
            }

            var self = this;
            var privateScope = {
                self: self,
                options: self.options,
                templates: self.templates,
                data: self.data
            };

            calcMinAndMaxAndPrepareData.call(privateScope);

            generateAndRenderIntervalRange.call(privateScope, parent);

            generateLinesAndAppendTo.call(privateScope, self.$elem);
        };
    }

    window.TimelinzTest = {
        noop: noop,
        pad: pad,
        extend: extend,
        toElement: toElement,
        tmpl: tmpl,
        compile: compile,

        calcRangeToPercentage: calcRangeToPercentage,
        calcRangeFromPercentage: calcRangeFromPercentage,
        calcUnit: calcUnit,
        calcTime: calcTime,
        generateIntervalRange: generateIntervalRange,
        generateFilledRange: generateFilledRange,
        getKeyFromTime: getKeyFromTime,
        getRangePercentageFromTime: getRangePercentageFromTime,
        calcPosition: calcPosition,
        calcMinAndMaxAndPrepareData: calcMinAndMaxAndPrepareData,
        generateAndRenderIntervalRange: generateAndRenderIntervalRange,
        generateLinesAndAppendTo: generateLinesAndAppendTo
    };
    // Just return a value to define the module export.
    return Timelinz;
});
