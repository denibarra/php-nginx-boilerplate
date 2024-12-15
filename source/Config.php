<?php

/** BASE URL */
const CONF_URL_BASE = "http://localhost:8080";
const HOST = "172.24.189.113";
const PORT = "3306";
const DB_NAME = "phptips013";
const USER = "root";
const PASSWD = "senha123";

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => HOST,
    "port" => PORT,
    "dbname" => DB_NAME,
    "username" => USER,
    "passwd" => PASSWD,
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

/**
 * @param string $path
 * @return string
 */
function url(string $path): string
{
    if ($path) {
        return CONF_URL_BASE . "{$path}";
    }
    return CONF_URL_BASE;
}

/**
 * @param string $message
 * @param string $type
 * @return string
 */
function message(string $message, string $type): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}
