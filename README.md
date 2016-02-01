# Tasklist is Simple REST API App that built with Slim Framework 3

This application is built using PHP 5.5.9, mysql 5.5.46 and Slim framework 3.

Installation :

1. Put this app to your document root
2. Point your virtual host document root to `public/` directory.
3. Ensure `logs/` is web writeable.
4. Import tasklist.sql in `db/` directory to your MySQL database.
5. Change config database.php in `src/` directory.

Example :

Register

POST /tasklist/public/api/v1/users HTTP/1.1
Host: localhost
content-Type: application/json
Cache-Control: no-cache
Postman-Token: df03ea43-3824-37eb-586c-95cab11fbe87

{
    "email":"bayoe13@gmail.com",
    "password" : "12345"
}


Login

POST /tasklist/public/api/v1/sessions HTTP/1.1
Host: localhost
content-Type: application/json
Cache-Control: no-cache
Postman-Token: 4ac9548b-6a4d-d258-8f0e-85e27a774df7

{
    "email":"bayoe13@gmail.com",
    "password" : "12345"
}


Create Task

POST /tasklist/public/api/v1/tasks HTTP/1.1
Host: localhost
content-Type: application/json
api-key: a22bbcd8c32575afe2f00d6907257703899330ee
Cache-Control: no-cache
Postman-Token: b51a1d57-9735-7ed8-ba69-f20302924951

{
    "name":"first task",
    "description" : "this is first task"
}


Get List Task

GET /tasklist/public/api/v1/tasks HTTP/1.1
Host: localhost
content-Type: application/json
api-key: a22bbcd8c32575afe2f00d6907257703899330ee
Cache-Control: no-cache
Postman-Token: d2b11ba3-ac01-3608-96c2-e239f3f79c5e


Get List Task With Limit

GET /tasklist/public/api/v1/tasks?offset=0&limit=10 HTTP/1.1
Host: localhost
content-Type: application/json
api-key: a22bbcd8c32575afe2f00d6907257703899330ee
Cache-Control: no-cache
Postman-Token: 38a2aefb-e16e-2167-c247-edb203ee05a9


Get Detail Task

GET /tasklist/public/api/v1/tasks/8 HTTP/1.1
Host: localhost
content-Type: application/json
api-key: a22bbcd8c32575afe2f00d6907257703899330ee
Cache-Control: no-cache
Postman-Token: b78aa45d-4074-9710-5a9b-7a29cc8b0755


Update Task

PUT /tasklist/public/api/v1/tasks/8 HTTP/1.1
Host: localhost
content-Type: application/json
api-key: a22bbcd8c32575afe2f00d6907257703899330ee
Cache-Control: no-cache
Postman-Token: 1854a6d4-adc9-d043-fe99-750905e96051

{
    "name":"second task",
    "description" : "this is second task",
    "status":"done" 
}


Delete Task

DELETE /tasklist/public/api/v1/tasks/8 HTTP/1.1
Host: localhost
Content-Type: multipart/form-data; boundary=----WebKitFormBoundary7MA4YWxkTrZu0gW
api-key: a22bbcd8c32575afe2f00d6907257703899330ee
Cache-Control: no-cache
Postman-Token: 4bc040d1-14a5-0ebb-7c08-7f7d17d59e99


That's it! Now happy trying.
