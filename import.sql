CREATE TABLE IF NOT EXISTS logs (
    id serial,
    ip VARCHAR(45) NOT NULL,
    browser VARCHAR(255) NOT NULL DEFAULT '',
    os VARCHAR(255) NOT NULL  DEFAULT '',
    url_from VARCHAR (2048) NOT NULL DEFAULT '',
    url_to VARCHAR (2048) NOT NULL DEFAULT '',
    log_date TIMESTAMP NULL
);
CREATE TABLE IF NOT EXISTS users (
    id serial,
    ip VARCHAR(45) NOT NULL,
    browser VARCHAR(255) NOT NULL DEFAULT '',
    os VARCHAR(255) NOT NULL  DEFAULT '',
    PRIMARY KEY(ip, browser, os)
);