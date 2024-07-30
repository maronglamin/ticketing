<?php

namespace core;

class Response {

    const PROOT = '/ticketing';
    const COMPANY_NAME = 'IMS Ticketing';

    const NOT_FOUND = 404;
    const FORBIDEN = 403;

    const HOSTNAME = '127.0.0.1';
    const PORT = '3306';
    const DB_NAME = 'mobifin_dataset';
    const DB_PASSWORD = 'Apsw321';
    const DB_USER = 'root';
    const CHARSET = 'utf8';

    const LIVE_HOSTNAME = 'sql203.infinityfree.com';
    const LIVE_PORT = '3306';
    const LIVE_DB_NAME = 'if0_35289337_agrobusiness';
    const LIVE_DB_PASSWORD = 'nfQpv5W1CsU';
    const LIVE_DB_USER = 'if0_35289337';

    const DEFAULT_VALIDATION_ERRORS = [
        'required' => '%s is required',
        'email' => '%s is not a valid email address',
        'min' => 'The %s must have at least %s characters',
        'max' => 'The %s must have at most %s characters',
        'between' => 'The %s must have between %d and %d characters',
        'confirmed' => 'The %s must match with %s',
        'alphanumeric' => 'The %s should have only letters and numbers',
        'secure' => 'The %s must have between 8 and 64 characters and contain at least one number, one upper case letter, one lower case letter and one special character',
        'unique' => 'The %s already exists',
    ];

    const SOFT_DELETED = 'SFDEL';
    const NOT_SOFT_DELETED = 'NTDEL';
    const AUTHORISD = 'CONF';
    const UNAUTHORISD = 'UNCONF';

    const STATUS_CHANGE_CLOSED = 'STCHCL';
    const STATUS_CHANGE_OPENED = 'STCHOP';

    const MALE_GENDER = 'MALE';
    const FEMALE_GENDER = 'FEMALE';
    const NOT_DISCLOSED = 'pref_n_dis';

    const PAGE_RECORD = 10;
    const DEFAULT_PAGE = 1;

    const STATUS_NEW_USER = 0;
    const STATUS_ENABLED = 1;
    const STATUS_HOLD = 2;
    const STATUS_DISABLED = 3;
    const STATUS_LOCKED = 4;


    const STATUS_ASSIGED = ASSIGNED;
    const STATUS_IN_PROGRESS = WORK-IN-PROGRESS;
    const STATUS_RESOLVED = RESOLVED;
    const STATUS_CLOSED = CLOSED;


}
