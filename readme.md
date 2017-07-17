# iSCHED Web Application (Completed)

iSCHED (Thesis Project)
Centralized Scheduler App for students, teachers and employees of iACADEMY.

# Motivation
We created this application to provide the students and teachers of iACADEMY 
an easy way in organizing their make-up classes, class events, and school events. 

# Installation
##### Software Requirements
1. Install [Composer](https://getcomposer.org/)
2. Install [XAMPP](https://www.apachefriends.org/index.html)
3. Clone this Github Repository on the HTDOCS folder of your XAMPP.

###### Using SSH
```javascript
git clone git@github.com:nwesber/web-thesis.git
```
###### Using HTTPS
```javascript
git clone https://github.com/nwesber/web-thesis.git
```

# Database Migration

Once you successfully clone the repository

Step 1. Open a terminal

Step 2. Update Dependecies by

```javascript
composer install
```

Step 3. Create a database called "isched"

Step 4. Database Migration by

```javascript
php artisan migrate
```

# Running the Application

###### Via XAMPP

  1. Open XAMPP
  2. Open Browser and Type
  
  ```javascript
  localhost/web-thesis/public
  ```
  
###### Via Laravel Framework

  1. Open Terminal that points to the application
  2. Type in your terminal
```javascript
php artisan serve
```
  3. Open a browser and type 
```javascript
localhost:8000
```
  
