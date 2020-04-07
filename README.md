## Installation
Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)

Clone the repository

    git clone https://github.com/devkaren/test-front.git
    
Switch to the repo folder

    cd test-front
    
Install all the dependencies using composer

    composer install
    
Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate
     
Set json rpc server and token. 

    JSON_RPC_SERVER=http://127.0.0.1:4040/api/v1/jsonrpc
    JSON_RPC_SERVER_TOKEN=eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ0ZXN0IjoiYmFjayJ9.9mgvVVKQ0OWLBAMVHb5htcIXF-hWtzfK2O6t2g0wYkg

NOTE: The token need be same as backend


Start the local development server

    php artisan serve

You can now access the server at http://127.0.0.1:8000
