# Installation notes

1. **Clone the repository**

  After cloning type the next commands:

```cd < Laravel folder >```

2. **Configure the Laravel:**

**IMPORTANT:** Copy the `.env.example` file to the `.env` and specify all needed data

Set proper DB user and password in `.env` file and do command

   DB settings for .env:

        DB_CONNECTION=mysql
        DB_HOST=db
        DB_PORT=3306
        DB_DATABASE=random
        DB_USERNAME=<username>
        DB_PASSWORD=<password>
        DB_ROOT_PASSWORD=<root password>


run command:

```sh ./first_start.sh```

  **NOTE:** *The script will ask about user's password because it run sudo for some command.
  Command will generate the application key. Also script do automatic migration with seeder.
  After this the numbers' table will contain 5 randomized numbers.*

  Also, the test user will be created with next credentials:

    user: admin
    email: admin@example.com
    pass: 'password'


3. **Start with Laravel**
    - URL: [localhost:5000](http://localhost:5000)
    - DB: works on  port 8100

4. **PhpMyAdmin**

To use PhpMyAdmin just go to URL: [localhost:8080](http://localhost:8080)

       user: <DB_USERNAME>
       password: <DB_PASSWORD>

5. **Swagger**


   Main Swagger page available on [localhost:5000/api/v1/documentation](http://localhost:5000/api/v1/documentation).
   Or press the button on the homepage.


   Api has two part:

    1. Auth - generate the JWT-token used to work with protected URI
    2. With Authentication - used for generate new number and store it to the database. To use it proper token must be provided.
    3. Without Authentication - get the stored number from database by its ID.

From Swagger page one can check all API's functionality.

6. **To do complex tests do command:**

```docker exec -it app php artisan test```

Test cover as Unit as Feature tests.
