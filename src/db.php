<?php
try{
	$pdo = new PDO('pgsql:dbname=roary');
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// UNIQUE for the username ensures all entries of it will be unique 
	// NOT NULL is used as the username & password are the minimum of information required for user accounts
	$pdo->exec("CREATE TABLE IF NOT EXISTS userProfiles (
	user_id SERIAL PRIMARY KEY,
		username TEXT UNIQUE Not NULL,
		password TEXT NOT NULL);");

	// SERIAL ensuress that the id is automatically set
	// Timestamps are  automatically set and usefull for sorting later
	$pdo->exec("CREATE TABLE IF NOT EXISTS roars (
	    roar_id      SERIAL PRIMARY KEY,
	    roar_content TEXT NOT NULL,
	    created_at   TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
	);");
	//  used to map between users and roars they post (one user can have multiple roars)
	$pdo->exec("CREATE TABLE IF NOT EXISTS posted (
	    user_id INTEGER NOT NULL REFERENCES userProfiles(user_id) ON DELETE CASCADE,
	    roar_id INTEGER NOT NULL REFERENCES roars(roar_id) ON DELETE CASCADE,
	    PRIMARY KEY (user_id, roar_id)
	);");
	return $pdo;
} catch (PDOException $e){
	error_log('DB connection failed: ' . $e->getMessage());
	
	return null;
}
