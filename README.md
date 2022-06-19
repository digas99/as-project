# GameBET

## Project for Análise de Sistemas (System Analysis)

Departamento de Electrónica, Telecomunicações e Informática - Universidade de Aveiro

## [API Documentation](app/api/README.md)

## Setup
To setup the app, first make sure to have [Docker](https://www.docker.com/) running on your machine. [[How to here]](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04)


- Configure the database on **db-config.json** (this file must be present)
```json5
{
    "host": "<host of MySQL>", // (localhost, etc)
    "username": "<MySQL user>", // (root, etc)
    "password": "<password of user>",
}
```

- Create **secret.php** file
```bash
$ sudo chmod +x secret.sh
$ ./secret.sh
```

- Assemble and run the necessary containers
```bash
$ docker-compose up --build
```

The server will, then, be running on [localhost:80](http://localhost:80).

## Contributors
| Name | Email |   
|------|-------|
| Diana Rocha | rochadc00@ua.pt |
| Diogo Correia | diogo.correia99@ua.pt |
| Gil Fernandes | email@ua.pt |
| Gonçalo Maranhão | email@ua.pt |