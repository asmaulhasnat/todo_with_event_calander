
# todo_with_event_calander
## Installation

Clone the repository

    git clone https://github.com/asmaulhasnat/todo_with_event_calander.git

Switch to the repo folder

    cd todo_with_event_calander

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


