# GameBET API
API that handles data from GameBET's databases

## API Documentation

1. [Users](#users)
    - 2.1 [Structure](#structure)
    - 2.2 [Get All Users](#get-all-users)
    - 2.2 [Filter Users By Key](#filter-users-by-key)
2. [Games](#games)
    - 2.1 [Structure](#structure)
    - 2.2 [Get All Games](#get-all-games)
    - 2.2 [Filter Games By Key](#filter-games-by-key)
3. [Streams](#streams)
4. [Bets](#bets)
5. [Get Only Specific Keys](#get-only-specific-keys)

## Users

Users contains information about the users of the app

### Structure

Example of the information fetched from /users:
```json
{
    "username": "IdealCobra",
    "email": "idealcobra@fakemail.com",
    "streamer": true,
    "id": "4",
    "games": [
        {
            "name": "League of Legends",
            "cover": "https://static-cdn.jtvnw.net/ttv-boxart/21779-285x380.jpg",
            "id": "2"
        },
        {
            "name": "Leap",
            "cover": "https://static-cdn.jtvnw.net/ttv-boxart/391992674_IGDB-285x380.jpg",
            "id": "34"
        },
        {
            "name": "Chess",
            "cover": "https://static-cdn.jtvnw.net/ttv-boxart/743-285x380.jpg",
            "id": "41"
        }
    ]
}
```

#### **Fields**
| ID | Name | Data Type | Description |
|----|------|-----------|-------------|
| **username** | Username | string | User name identifier | 
| **email** | Email | string | User email | 
| **streamer** | Streamer | boolean | Whether or not the user is partnered with GameBET, therefore being a streamer |
| **id** | User ID | string | User number identifier |
| **games** | Games | Game | Games streamed by the user |

### Get All Users

Fetch all users

**HTTP Request**

``` GET .../api/users```

### Filter Users by Key

Filter the list of users by the keys available. Some keys can be combined.

**Example HTTP Requests**

```
GET .../api/users?id=4
GET .../api/users?username=co&streamer=false
GET .../api/users?streamer=true
```

## Games

Games contains information about the games that contain streams with bets on the app

### Structure

Example of the information fetched from /games:
```json
{
    "name": "SMITE",
    "cover": "https://static-cdn.jtvnw.net/ttv-boxart/32507-285x380.jpg",
    "id": "37",
    "users": [
        {
            "username": "OurVole",
            "email": "ourvole@fakemail.com",
            "pwd": "123456",
            "streamer": "1",
            "id": "7"
        },
        {
            "username": "EvasiveGuillemot",
            "email": "evasiveguillemot@fakemail.com",
            "pwd": "123456",
            "streamer": "1",
            "id": "26"
        }
    ]
}
```

#### **Fields**
| ID | Name | Data Type | Description |
|----|------|-----------|-------------|
| **name** | Name | string | Name of the game | 
| **cover** | Cover | string | Link to the cover picture | 
| **id** | User ID | string | Game number identifier |
| **users** | Users | User | Users streaming the game |

### Get All Games

Fetch all games

**HTTP Request**

``` GET .../api/games```

### Filter Games by Key

Filter the list of games by the keys available.

**Example HTTP Requests**

```
GET .../api/games?id=37
GET .../api/users?name=tr
```

## Get Only Specific Keys

When making any HTTP request, providing the URL Parameter *"keys"* will only show those specific keys (see **Fields** to know which keys are valid).

As an example, the following HTTP Request

``` GET .../api/users?id=4&keys=id,username```

responds with the following data:
```json
{
    "username": "IdealCobra",
    "id": "4"
}
```

Keys that don't exist will be ignored.
