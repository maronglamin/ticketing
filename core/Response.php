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

    const LIVE_HOSTNAME = '127.0.0.1';
    const LIVE_PORT = '3306';
    const LIVE_DB_NAME = 'uat_ticketing';
    const LIVE_DB_PASSWORD = '';
    const LIVE_DB_USER = 'root';

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

    # email status
    const UNSENT_EMAIL = 0;
    const SENT_EMAIL = 1;

    # Email config
    const EMAIL_HOST = 'apswallet.gm';
    const EMAIL_USERNAME = 'request@apswallet.gm';
    const EMAIL_PASSWORD = 'Allah@123';
    const EMAIL_PORT = 465;

    const EMAIL_FROM_USERNAME = 'APSW IT HELPDESK';
    const DEFUALT_COPIED_USER = 'modoulamin.marong@apswallet.gm';

    const STATUS_ASSIGED = 'ASSIGNED';
    const STATUS_IN_PROGRESS = 'WORK-IN-PROGRESS';
    const STATUS_RESOLVED = 'RESOLVED';
    const STATUS_CLOSED = 'CLOSED';
    const STATUS_NEW = 'NEW';
    const STATUS_ESCALATE = 'ESCALATE';
    const STATUS_ONHOLD = 'ON HOLD';
    const STATUS_REOPENED = 'REOPENED';
    const STATUS_CANCELLED = 'CANCELLED';

    const PARENT_ID = '0';

    const REJECT = 'REJECTED';
    const REVIEW = 'REVIEWED';
    const APPROVE = 'APPROVED';
    const PENDING = 'PENDING';

    const SENT_FOR_SIGNATURE = 'PENDING_SIGNATURE';

    const REV = 'AUTO_REV';
    const AUTH = 'AUTO_AUTH';
    const INPUTTER = 'AUTH';

    // bank notes user
    const IMF_BANK_USER = 'IMF_BANK_PAYER';
    const BANK_USER = 'OTHER_BANK_USER';
    const ACCOUNT_SIGNATORY = 'ACCOUNT_SIGNATORY';
}
