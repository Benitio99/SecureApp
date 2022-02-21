const { requireOrImport } = require('mocha/lib/nodejs/esm-utils');

const assert = require('chai').assert;
const pC = require('../scripts/passwordComplexity');

const GOODPASSWORD = "Aaaaaa1!";
const BADPASSWORD = "<<>";

describe('Password complexity rules...', function () {
    describe('Password Length', function () {
        it('returns true when password length is > 7', () => {
            assert.equal(pC.checkLength(GOODPASSWORD), true);
        });

        it('returns false when password length is < 8', () => {
            assert.equal(pC.checkLength(BADPASSWORD), false);
        });
    })
    describe('Upper Alphabetic Characters', function () {
        it('returns true when password contains at least 1 * [A-Z]', () => {
            assert.equal(pC.checkAlphaUpper(GOODPASSWORD), true);
        });

        it('returns false when password contains 0 * [A-Z]', () => {
            assert.equal(pC.checkAlphaUpper(BADPASSWORD), false);
        });
    })
    describe('Lower Alphabetic Characters', function () {
        it('returns true when password contains at least 1 * [a-z]', () => {
            assert.equal(pC.checkAlphaLower(GOODPASSWORD), true);
        });

        it('returns false when password contains 0 * [a-z]', () => {
            assert.equal(pC.checkAlphaLower(BADPASSWORD), false);
        });
    })
    describe('Numeric Characters', function () {
        it('returns true when password contains 1 * [0-9]', () => {
            assert.equal(pC.checkNumeric(GOODPASSWORD), true);
        });

        it('returns false when password contains 0 * [0-9]', () => {
            assert.equal(pC.checkNumeric(BADPASSWORD), false);
        });
    })
    describe('Special Characters', function () {
        it('returns true when password contains 1 * [!, ?, @, _, -]', () => {
            assert.equal(pC.checkSpecialChars(GOODPASSWORD), true);
        });

        it('returns false when password contains 0 * [!, ?, @, _, -]', () => {
            assert.equal(pC.checkSpecialChars(BADPASSWORD), false);
        });
    })
    describe('No Bad Characters', function () {
        it('returns false when password contains 0 * []', () => {
            assert.equal(pC.checkBadChars(BADPASSWORD), false);
        });

        it('returns true when password contains 1 * []', () => {
            assert.equal(pC.checkBadChars(GOODPASSWORD), true);
        });
    })
    describe('Password Match', function () {
        it('returns true when second password matches first password', () => {
            assert.equal(pC.checkPasswordMatch(GOODPASSWORD, GOODPASSWORD), true);
        });

        it('returns false when second password does not match first password', () => {
            assert.equal(pC.checkPasswordMatch(GOODPASSWORD, BADPASSWORD), false);
        });
    })
    /*describe('Check Password in full', function () {
        it('returns true if first 6 tests are positive ', () => {
            assert.equal(pC.checkPasswordComplexity(GOODPASSWORD), true);
        });

        it('returns false if any of the 6 tests are positive', () => {
            assert.equal(pC.checkPasswordComplexity(BADPASSWORD), false);
        });
    })*/
})
