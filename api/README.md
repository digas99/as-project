# GameBET API
API that handles data from GameBET's databases

## API Documentation

1. [Users](#users)
    - 2.1 [Structure](#structure)
    - 2.2 [Get All Users](#get-all-users)
    - 2.2 [Filter Users By Key](#filter-users-by-key)
2. [Games](#games)
3. [Streams](#streams)
4. [Bets](#bets)

## Users

Users contains information about the users of the app

### Structure

Example of the information fetched from users:
```json
{
    "username": "IdealCobra",
    "email": "idealcobra@fakemail.com",
    "streamer": false,
    "id": "4"
}
```

#### **Fields**
| ID | Name | Data Type | Description |
|----|------|-----------|-------------|
| **username** | Username | string | User's name identifier | 
| **email** | Email | string | User's email | 
| **streamer** | Streamer | boolean | Whether or not the user is partnered with GameBET, therefore being a streamer |
| **id** | User ID | string | User number identifier |

### Get All Users

Fetch all users

**HTTP Request**

``` GET .../api/users```

### Filter Users by Key

Filter the list of users by the keys available. Some keys can be combined.

**Example HTTP Requests**

```
GET .../api/users?id=1
GET .../api/users?username=co&streamer=false
GET .../api/users?streamer=true
```