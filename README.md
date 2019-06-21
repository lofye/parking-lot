# PARKING LOT CHALLENGE

Hi!

Over the past few years, vehikl has built a good name for itself.
As I've talked with Chris, I've only come to respect you even more.
Thanks for the opportunity to do this coding challenge for you.
You are the first dev shop I've come across that is dev-oriented, which is to say, focused on code quality, 
and developer quality, and growing better developers.
Except for my first job, I have always been the most senior developer wherever I've worked.
On the one hand, that's meant I've had a lot of control, which has been fun.
On the other hand, it's meant I haven't learned as much as I would have liked from my peers.
I really see vehikl as a place that I can experience tremendous growth, and do the best work of my life.
I hope I get the chance to do just that.

Sincerely,

Derek Martin

Notes:
- There is no concept of a USER in this application. Ticketing is anonymous.
- The API has not been secured
- I am not using Form Requests or doing any validation

To get this running:
- Ensure you have php >= 7.3
- For curl to https://parking-lot.test to work properly, you may need to adjust your DNS: https://github.com/laravel/valet/issues/736
- create a database called 'parkinglot' with default collation: utf8_general_ci, accessible by root with no password
- composer install
- php artisan migrate
- php artisan db:seed

------------

## Scenario:

A company has hired us to build an application to manage customers using their parking garage. 
The customer must be able to enter the parking garage with their vehicle and be issued a ticket. 
The customer is then charged for parking based on the length of their stay. 
When the customer leaves the parking garage, they must pay their ticket and then exit.

## Back-End

Your Task: ​You will be creating a REST API for the parking garage application. 

### API Request Requirements:

1. POST /tickets will return a ticket number
2. GET /tickets/{ticket#} with that ticket number will give back the total the customer owes
3. POST /payments/{ticket#} with the ticket number and a credit card # will pay the ticket

This API ​must​ have the ability to do the following:
1. A customer arriving in their vehicle is able to request entry to the parking garage
    a. If there is space available, the app issues a ticket to the customer
    b. If the parking garage is full, deny entry to that customer
2. Allow 
    a. Use 1hr, 3hr, 6hr, or ALL DAY for rate levels 
    b. The price increases by 50% for each rate level
    c. The starting rate is $3 for 1hr
3. Allow 
    a. When the ticket is paid, a spot becomes available
    
## Rules:

● Your code must be submitted through source control with descriptive commit messages.
● This exercise is designed to give us context for your technical interview. It is our hope
    that you spend as much time as you feel necessary to showcase your knowledge,
    abilities, and problem solving skills.
● You may use any available resources to help you build this app (online, open source,
    community, etc.) but you must write the actual code yourself.
● Good client work on our team means ongoing communication. You may ask as many questions for guidance or clarification as needed from the contact(s) you have from our team during this exercise. This will not count against you.
● Upon approval of your submission, your code will be reviewed during an in-person technical interview. We want to understand your thought process throughout this assignment, how you went about solving the problems, and we want you to share your thoughts for the implementation details.
● This application may be written using any major programming language (bonus for using the technologies we tend to use at Vehikl).
● Once the API is finished, please submit the completed GitHub repository link.

## Considerations:

Here are some considerations for your submission. It is not expected that you use the technologies listed below, however if you do have experience in any of these feel free to showcase them in the context of this project.
● Front end. It is not required or expected that you finish with any level of front-end polish.
● Dev-ops/deployment containerization
● Unit Testing
● Documentation