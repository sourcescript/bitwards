#migration
php artisan migrate --package="lucadegasperi/oauth2-server-laravel"

# OAUTH
----
## Get Access Token
POST: /api/v1/oauth/access_token
grant_type = facebook 
client_id = bitwards
client_secret = bitwardssecret
fb_id = 1255
scope = user_profile
first_name = qwe
last_name = lastname
email_address = qwewqeq@qweqwe.com

## User Update
PUT: /api/v1/users
GET: /api/v1/users/{id}


## Get Current User Profile
GET: /api/v1/users/profile
