<?php
require('../../../dmxConnectLib/dmxConnect.php');


$app = new \lib\App();

$app->define(<<<'JSON'
{
  "meta": {
    "$_GET": [
      {
        "type": "text",
        "name": "sort"
      },
      {
        "type": "text",
        "name": "dir"
      }
    ]
  },
  "exec": {
    "steps": {
      "name": "query",
      "module": "dbconnector",
      "action": "select",
      "options": {
        "connection": "db",
        "sql": {
          "type": "SELECT",
          "columns": [],
          "table": {
            "name": "users"
          },
          "joins": [],
          "query": "SELECT *\nFROM users",
          "params": []
        }
      },
      "output": true,
      "meta": [
        {
          "name": "id",
          "type": "text"
        },
        {
          "name": "first_name",
          "type": "text"
        },
        {
          "name": "last_name",
          "type": "text"
        },
        {
          "name": "gender",
          "type": "text"
        },
        {
          "name": "email",
          "type": "text"
        },
        {
          "name": "company",
          "type": "text"
        },
        {
          "name": "avatar",
          "type": "text"
        }
      ],
      "outputType": "array"
    }
  }
}
JSON
);
?>