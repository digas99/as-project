# GameBET

## Project for Análise de Sistemas (System Analysis)

Departamento de Electrónica, Telecomunicações e Informática - Universidade de Aveiro

## [API Documentation](app/api/README.md)

## Setup
To setup the app, first make sure to have **Docker** [[How to here]](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-on-ubuntu-18-04) and **Docker Compose** [[How to here]](https://www.digitalocean.com/community/tutorials/how-to-install-and-use-docker-compose-on-ubuntu-20-04) running on your machine.


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
| Name | Github | Email |   
|------|--------|-------|
| Diana Rocha | [rochadc00](https://github.com/rochadc00) | rochadc00@ua.pt |
| Diogo Correia | [digas99](https://github.com/digas99) | diogo.correia99@ua.pt |
| Gil Fernandes | [GilFernandes2000](https://github.com/GilFernandes2000) | joaogilfernandes@ua.pt |
| Gonçalo Maranhão | [GoncaloMaranhao](https://github.com/GoncaloMaranhao) | goncalo.rodrigues@ua.pt |
