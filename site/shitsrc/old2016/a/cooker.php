<?php

// Include the EasyPHP file.

include "EasyPHPTest.php";

// Create a new easyphp instance.

$php = new EasyPHP();

// Call the instance to connect to the database. (important for sql queries)
// You have 4 things to write
// First one is the host
// Second is the database name
// Third is the username
// And finally last one is the password, put NULL in case its empty.

$php->ConnectDatabase("localhost", "test", "root", NULL);

// Call the instance and do an SQL query. (requires to have connected to database.)
// Again there are 4 things to write
// First one is the sql
// Second is an boolean for does it fetch (single fetch)
// Third is a boolean for does it fetch (fetch all rows)
// And lastly is the args, if you have args do [] and then do like this:

/*
Args are just like the execute(); function from php,
do "[]" and then write the args.
*/

$php->SqlQuery("SELECT * FROM games", false, true, NULL);
?>