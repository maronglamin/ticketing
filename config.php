<?php

use core\Response;

return [

    'database' => [
        'host' => Response::HOSTNAME,
        'port' => Response::PORT,
        'dbname' => Response::DB_NAME,
        'charset' => Response::CHARSET,
    ],

    'live_database' => [
        'host' => Response::LIVE_HOSTNAME,
        'port' => Response::LIVE_PORT,
        'dbname' => Response::LIVE_DB_NAME,
        'charset' => Response::CHARSET,

    ]

];


