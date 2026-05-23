<?php
/**
 * Ballonsport Krohmer — Datenbank-Schema
 *
 * Idempotent: kann beliebig oft aufgerufen werden.
 */
function run_migrations(PDO $pdo): void
{
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS content (
            key        TEXT    PRIMARY KEY,
            value      TEXT    NOT NULL,
            updated_at INTEGER NOT NULL
        );
    ");

    $pdo->exec("
        CREATE TABLE IF NOT EXISTS images (
            key        TEXT    PRIMARY KEY,
            filename   TEXT    NOT NULL,
            alt        TEXT    NOT NULL DEFAULT '',
            updated_at INTEGER NOT NULL
        );
    ");
}
