## Blog Project

This is a simple blog system for square1 interviwe


### Step to Setup project:

- composer Install
- copy env.example and rename to .env
- configure database settings in .env
- change APP_URL to the App url(for this project i use valet eg. http://blog.test)
- php artisan key:generate
- php artisan migrate
- php artisan test (this to run all the test)
- php artisan migrate:fresh
- php artisan db:seed (this is to seed the admin)
- php artisan schedule:work (this is to call customer other blog platform)
- npm install
- npm run dev

You are all set.

#### Note : The first time you visit the web app you might not see any post, wait 1 minute for the schedule to run or create and account and create a post

#THANKS

