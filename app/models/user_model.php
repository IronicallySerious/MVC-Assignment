<?php

namespace Models;

/* 
    A SESSION VARIABLES array that holds all user specific variables
    'username': string saves the username of current user,
    'password' : string (?) saves NULL for the moment and shall be initialized elsewhere where and when needed,
    'bSignedIn' : bool saves the boolean whether the user is signed in,
    'karma' : Saves the karma points of a user
*/
/*
    OBSOLETE->
        $USER = array(                  
            "username" => NULL,
            "password" => NULL,
            "bSignedIn" => false,
            "karma" => NULL
        ); 
    REPLACEMENT: 
        $_SESSION = array(
            "username" => NULL,
            "password" => NULL,
            "bSignedIn" => false,
            "karma" => NULL
        );
*/

// Deals with signing in, signing up of and acquiring details about users
class UserModel{

//
// ─── MEMBER FUNCTIONS ────────────────────────────────────────────────────────────
//
        
    // Returns a bool for 'if the user is signed in to the website'
    public function isUserSignedIn()
    {
        return $_SESSION["bSignedIn"];
    }

    // Returns the username of the user
    public function getUsername()
    {
        return $_SESSION["username"];
    }


    // Sets the boolean value of isUserLoggedIn
    public function setUserIsSignedIn($bNewValue)
    {
        $_SESSION["bSignedIn"] = $bNewValue;
        return;
    }

    // Inserts a new user to the database table - 'Users'
    public function insertUser($username, $hashedPassword)
    {
        // Initialises a $db that creates a medium to communicate with the database
        $db = \DB::get_instance();

        // INSERTs user details recieved through $_POST through SQL command execution
        $stmt = $db->prepare("INSERT INTO `Users`(`uid`, `username`, `followerids`, `followers`, `followingids`, `following`, `karma`, `password`) 
                                VALUES (DEFAULT, ?, '', 0, '', 0, 0, ?)");
        $stmt->execute([$username, $hashedPassword]);
        $stmt = null;

        return;
    }

    /* 
        Returns the entire result of a SELECT query that matches the
        username and hashed password given to it in as parameters
        *Returns NULL if more than one row is found
     */
    public function find($username, $hashedPassword)
    {
        // Initialise a link with the database
        $db = \DB::get_instance();

        // Prepare a SELECT query
        $stmt = $db->prepare("SELECT `username`,`password`,`karma` FROM `Users` WHERE `username`= ? AND `password`= ? ");
        
        // Execute the query
        $stmt->execute([$username, $hashedPassword]);

        // Acquire the results
        $rows = $stmt->fetchAll( \PDO::FETCH_ASSOC ); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

        // Return the results
        return $rows;            
    }

    /* 
        Returns the entire result of a SELECT query that matches the
        username and DOES NOT MATCH any hashed passwords given to it in as parameters
        *Returns NULL if more than one row is found
     */
    public function findWithoutPassword($username)
    {
        // Initialise a link with the database
        $db = \DB::get_instance();

        // Prepare a SELECT query
        $stmt = $db->prepare("SELECT `username`,`karma` FROM `Users` WHERE `username`= ?");
        
        // Execute the query
        $stmt->execute([$username]);

        // Acquire the results
        $rows = $stmt->fetchAll( \PDO::FETCH_ASSOC ); // fetchAll() does <$stmt = null;> automatically <-- GOOD PRACTICE	

        // Return the results
        return $rows;            
    }
}

?>