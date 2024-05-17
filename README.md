# Installation notes

1. Clone the repository

  After cloning type the next commands:

```cd < Laravel folder >```

2. Configure the Laravel:

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
  Command will generate the application key.*


3. Start with Laravel
    - URL: [localhost:5000](http://localhost:5000)
    - DB: works on  port 8100

4. PhpMyAdmin

To use PhpMyAdmin just go to URL: [localhost:8080](http://localhost:8080)

       user: <DB_USERNAME>
       password: <DB_PASSWORD>


