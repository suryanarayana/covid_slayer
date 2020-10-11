Instructions to configure:
-------------------------

1) Setup a php environment by installing php-7.3 or greater than that, mysql, apache or nginix webserver.

2) Copy the folder(covid_slayer) to web root directory(www, htdocs, public_html) of the server.

3) Create a database and import the sql file tables.

4) Configure the database name, host name, database user, database password in (.env file), APP_URL

For testing environment:

If you want to run it for testing in subfolder you can access the app by using below sample url.
http:://host-name/covid_slayer/public

For production environment: (If you want to run it as a main app)
Point the domain root to public folder.
or
Copy the covid_slayer folder contents (except public folder) to outside of webroot directory and copy the public folder directory contents to webroot directory.
Configure the APP_URL constant.

