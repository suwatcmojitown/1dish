<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$active_group = 'default';
$query_builder = TRUE;

// ถ้าอยู่บน Railway ให้ใช้ env vars, ถ้าอยู่ local ใช้ค่าเดิม
$db['default'] = array(
    'dsn'      => '',
    'hostname' => getenv('MYSQLHOST')     ?: 'localhost',
    'username' => getenv('MYSQLUSER')     ?: 'root',
    'password' => getenv('MYSQLPASSWORD') ?: 'root',
    'database' => getenv('MYSQLDATABASE') ?: '1dish',
    'port'     => getenv('MYSQLPORT')     ?: 3306,
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8mb4',
    'dbcollat' => 'utf8mb4_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE,
);
