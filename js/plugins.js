// Avoid `console` errors in browsers that lack a console.
(function () {
    "use strict";
    var method, noop, methods, length, console;
    noop = function noop() {};
    methods = [
        'assert', 'clear', 'count', 'debug', 'dir', 'dirxml', 'error',
        'exception', 'group', 'groupCollapsed', 'groupEnd', 'info', 'log',
        'markTimeline', 'profile', 'profileEnd', 'table', 'time', 'timeEnd',
        'timeStamp', 'trace', 'warn'
    ];
    length = methods.length;
    console = (window.console = window.console || {});

    while (length--) {
        method = methods[length];

        // Only stub undefined methods.
        if (!console[method]) {
            console[method] = noop;
        }
    }
}());

// Place any jQuery/helper plugins in here.// usage: log('inside coolFunc', this, arguments);

/*
jQuery Credit Card Validator

Copyright 2012 Pawel Decowski

This work is licensed under the Creative Commons Attribution-ShareAlike 3.0
Unported License. To view a copy of this license, visit:

http://creativecommons.org/licenses/by-sa/3.0/

or send a letter to:

Creative Commons, 444 Castro Street, Suite 900,
Mountain View, California, 94041, USA.
*/


(function () {
    "use strict";
    var $,
        __indexOf = [].indexOf || function (item) { for (var i = 0, l = this.length; i < l; i++) { if (i in this && this[i] === item) return i; } return -1; };

        $ = jQuery;

        $.fn.validateCreditCard = function (callback) {
        var card_types, get_card_type, is_valid_length, is_valid_luhn, normalize, validate, validate_number;
        card_types = [
          {
            name: 'amex',
            pattern: /^3[47]/,
            valid_length: [15]
          }, {
            name: 'diners_club_carte_blanche',
            pattern: /^30[0-5]/,
            valid_length: [14]
          }, {
            name: 'diners_club_international',
            pattern: /^36/,
            valid_length: [14]
          }, {
            name: 'jcb',
            pattern: /^35(2[89]|[3-8][0-9])/,
            valid_length: [16]
          }, {
            name: 'laser',
            pattern: /^(6304|670[69]|6771)/,
            valid_length: [16, 17, 18, 19]
          }, {
            name: 'visa_electron',
            pattern: /^(4026|417500|4508|4844|491(3|7))/,
            valid_length: [16]
          }, {
            name: 'visa',
            pattern: /^4/,
            valid_length: [16]
          }, {
            name: 'mastercard',
            pattern: /^5[1-5]/,
            valid_length: [16]
          }, {
            name: 'maestro',
            pattern: /^(5018|5020|5038|6304|6759|676[1-3])/,
            valid_length: [12, 13, 14, 15, 16, 17, 18, 19]
          }, {
            name: 'discover',
            pattern: /^(6011|622(12[6-9]|1[3-9][0-9]|[2-8][0-9]{2}|9[0-1][0-9]|92[0-5]|64[4-9])|65)/,
            valid_length: [16]
          }
        ];
        get_card_type = function (number) {
          var card_type, _i, _len;
          for (_i = 0, _len = card_types.length; _i < _len; _i++) {
            card_type = card_types[_i];
            if (number.match(card_type.pattern)) {
              return card_type;
            }
          }
          return null;
        };
        is_valid_luhn = function (number) {
          var digit, n, sum, _i, _len, _ref;
          sum = 0;
          _ref = number.split('').reverse();
          for (n = _i = 0, _len = _ref.length; _i < _len; n = ++_i) {
            digit = _ref[n];
            digit = +digit;
            if (n % 2) {
              digit *= 2;
              if (digit < 10) {
                sum += digit;
              } else {
                sum += digit - 9;
              }
            } else {
              sum += digit;
            }
          }
          return sum % 10 === 0;
        };
        is_valid_length = function (number, card_type) {
          var _ref;
          return _ref = number.length, __indexOf.call(card_type.valid_length, _ref) >= 0;
        };
        validate_number = function (number) {
          var card_type, length_valid, luhn_valid;
          card_type = get_card_type(number);
          luhn_valid = false;
          length_valid = false;
          if (card_type != null) {
            luhn_valid = is_valid_luhn(number);
            length_valid = is_valid_length(number, card_type);
          }
          return callback({
            card_type: card_type,
            luhn_valid: luhn_valid,
            length_valid: length_valid
          });
        };
        validate = function () {
          var number;
          number = normalize($(this).val());
          return validate_number(number);
        };
        normalize = function (number) {
          return number.replace(/[ -]/g, '');
        };
        this.bind('input', function () {
          $(this).unbind('keyup');
          return validate.call(this);
        });
        this.bind('keyup', function () {
          return validate.call(this);
        });
        if (this.length !== 0) {
          validate.call(this);
        }
        return this;
        };

}).call(this);
