# Website Traffic Tracker

This project implements a simple website traffic tracker that tracks unique visits to web pages. It consists of three main components:

JavaScript Tracker: A JavaScript snippet that clients add to their websites to track visitor activity.
Backend Server: A PHP server-side application built with Laravel that stores visit data in a MySQL database.
Dashboard UI: A user interface that displays the number of unique visits per page over a given time period.

## Setup Instructions

### JavaScript Tracker

Add the tracker.js script to your website's HTML pages.
<script src="path/to/tracker.js"></script>

### Backend Server

1.Install dependencies using Composer.
composer install

2.Set up your database connection in the .env file.
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8000
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password

3.Run database migrations to create the necessary tables.
php artisan migrate

4.Start the Laravel development server.
php artisan serve

### Dashboard UI

1.Navigate to the dashboard directory.
cd tracker

2.Install dependencies using npm.
npm install

3.Start the development server.
npm run dev

## Usage

After completing the setup, visit your website to start tracking unique visits.

The tracker saves the visitor ID and visited pages in local storage. If a page has not been visited yet, the sendVisitData function is called on page load to mark the page as visited and add it to the visited pages in local storage.

Access the dashboard UI to view unique visit counts per page on different time periods.