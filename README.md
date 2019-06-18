# PARKING LOT TEST

Hi!

Thanks for the opportunity to do this for you.
I was very short on time, and in a bit of a rush, and didn't notice the bit about descriptive commit messages :(
Altogether, I spent about 2 hours on it.
Tihs README.md is my documentation. I didn't comment the code too much, and instead tried to make it descriptive.
The code is essentially fancy pseudo-code, though. Not executable.
Hope that's alright.

Derek Martin

------------
To get this running:
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