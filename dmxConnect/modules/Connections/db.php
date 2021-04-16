<?php
// Database Type : "MySQL"
// Database Adapter : "mysql"
$exports = <<<'JSON'
{
    "name": "db",
    "module": "dbconnector",
    "action": "connect",
    "options": {
        "server": "mysql",
        "databaseType": "MySQL",
        "connectionString": "mysql:host=db;sslverify=false;port=3306;dbname=web01;user=db_user;password=eogjvVtB;charset=utf8"
    }
}
JSON;
?>