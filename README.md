# GameBET

## Project for Análise de Sistemas (System Analysis)

Departamento de Electrónica, Telecomunicações e Informática - Universidade de Aveiro

## [API Documentation](/api/README.md)

## Setup
- Configure the database on **db-config.json** (this file must be present)
```json
{
    "db_credentials": {
        "host": "<host of MySQL>", // (localhost, etc)
        "username": "<MySQL user>", // (root, etc)
        "password": "<password of user>",
        "name": "<name of database to create>" // (gamebet, etc)
    },
    "db_size": "<size of data set>" // (small, medium or large)
}
```

- Initialize database
```
$ sudo chmod +x db-init.sh
$ ./db-init.sh
```
