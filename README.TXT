#############################################################
#                                                           #
#            SELF INITIALISING NANO FRAMEWORK               # 
#                                                           #
#             PETER D JONES 9/7/14                         #
#                                                           #
#############################################################

This application will need some configuration.

Only the file app/config.php need be altered.

1. The following directives will need to be set:-

	define('DBHOST', 'localhost');
	define('DBUSER', 'root');
	define('DBPASSWORD', '23skidoo');
	define('DBNAME', 'avesta');

2. The application assumes an address of localhost/studentroom. If this
is not the case, the following functions will need to be amended.

	function subdomain()
	{
		return 'avesta';
	}

	function base_url()
	{
		$subdomain = subdomain();
		return 'http://localhost/'.$subdomain.'/';
	}


3. The application is designed to initialise its own data. The list of tables supplied to the constructor for Controller 

	$controller = new Controller($tables);

...will be used ot search for .sql files to initialise the database. For instance, if for a database containing a single table called testdata, the following files will be found and run


	create_database.sql
	create_TestData.sql





