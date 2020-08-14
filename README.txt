Download all the files and make it as a single new folder(cms).
Paste it inside the root directory(for xampp xampp/htdocs, for wamp wamp/www, for lamp var/www/html)
Open PHPMyAdmin (http://localhost/phpmyadmin)
Create a database with name cms
under cms database,create the following tables with these names

1)admin_post(user_id int primarykey,post_id int primarykey,foreign key(post_id in post table)
2)categories(cat_id int primarykey, cat_title varchar)
3)comments(comment_id int primarykey, comment_post_id int, comment_author varchar, comment_email varchar, comment_content varchar, comment_status varchar, comment_date date)
4)posts(post_id int primarykey, post_category_id int, post_title varchar, post_author varchar, post_date date, post_image text, post_content text, post_tags varchar, post_comment_count varchar, post_status varchar)
5)users(user_id int primarykey, username varchar, user_password varchar, user_firstname varchar, user_lastname varchar, user_email varchar, user_image text, user_role varchar, randSalt varchar)
6)user_post(user_id int primarykey, post_id int primarykey foreignkey(post_id in post table))

Fill some data in the tables according to the datatype.
Run the script http://localhost/cms (frontend) and enter the already filled credentials.
After that you will enter the index page. From there you can perform all operations.
