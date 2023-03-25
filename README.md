# A Basic Vanilla PHP CMS

Backend: This repository is a simple PHP CMS meant to be used as a starting point. The code consists of a simple login process, a dashboard, a place to view/add/edit/delete users, and a place to view/add/edit/delete projects. In an effort to keep the PHP code focused and basic, only the absolute basics have been included. The whole CMS only consists of HTML, PHP, and SQL.

A few notes regarding the CMS:

- There is no form validation
- Security is very basic
- Image and uploading is done through a separate page using a basic servers-side script
- Images and video are stored in the database as a base64 string
- Image resizing is done through [WideImage](http://wideimage.sourceforge.net/)

Frontend:
- Responsive website that displays event categories and details dynamically.
- We took an intuitive approach to organizing our product data by using multiple tables and strategic categorization, resulting in a well-organized and efficient website for our users.
- At home page onclick of any event it take Name of the event with javascript and filter that name from event_details table and shows the result(SELECT * FROM event_details WHERE category_id=( SELECT category_id FROM categories WHERE name = '$eventName')).
- If you only event from nav it shows all the events details(SELECT * FROM event_details)

Live Website: http://manalipatel.infinityfreeapp.com/php-cms/
Source Code: https://github.com/Manali1321/php-cms/
