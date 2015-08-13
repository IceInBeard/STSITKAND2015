# Mongo Worker Example

This is the example of connection worker to mongo database. Worker connects to mongo database, exec query and logs some output to the worker log.

1. Be sure you've done your one time configuration
2. Set database connection credentials in config.ini
3. install https://github.com/iron-io/iron_worker_php step 4 requires it.
4. Run `php upload.php`
5. Run `php enqueue.php`
6. Look at [HUD](https://hud.iron.io) to view your tasks running, check logs, etc.
