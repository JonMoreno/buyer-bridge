## Here is what we need to get it running on your environment.

    1. Have docker installed on your machine. Here is the link https://www.docker.com/get-started/ having the dashboard app not only installs docker but it makes it easy to visualize images, containers and so on.
    2. Download attached email File.
    3. Unzip file.
    4. In terminal cd into unzipped folder .
    6. Once in folder run this command: docker compose up --build
     ```sh
        docker compose up --build
    ```
    - Don't run cmds 'npm install or composer install'
    - Make sure the following ports (3306:3306, 9000:9000, 3000:3000) are not being blocked and that mysql is stopped if an instance exists

## Last step's command may take some time as is doing a few things.

    - Installing Mysql with default password and db name
    - Installing Laravel project while migrating db and seeding db with some mockup data.
    - Installing Vue project

## Links:

    UI: http://localhost:3000/
    API: http://localhost:9000/

## Sign Accounts:

    Email: user@example.com Pass: password123
    Email: admin@example.com Pass: password123
    (This account can open capsules ahead of time)

### Lastly, I would like to just point that there are many additional improvements that we can add to this project and with given time they could be done. I just wanted to get a working model working running for now. I did not too many tests but they can be added if needed.

### If you need help getting this running let me know I can help. We can also throw this into AWS and get a live version of the project running too.
