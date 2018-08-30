<?php

class Notes{
    //Note Types
    const NOTE_TYPE_NORM = 1;
    const NOTE_TYPE_TD = 2;
    const NOTE_TYPE_REMIND = 3;

    static public $all_note_types = array(
        Notes::NOTE_TYPE_NORM => "Norm",
        Notes::NOTE_TYPE_TD => "TD",
        Notes::NOTE_TYPE_REMIND => "Remind",
    );

    //Variables
    private $_email;
    private $_password;
    public $username;

    public $note_id;
    public $note_type;
    public $note;
    public $note_title;
    public $page_num;
    public $time_created;

    function __construct($data = array()){
        //Ensure the address can be populated

        //If there is at least one value, populate the address with it
        if (count($data)> 0){
            foreach($data as $name =>$value){
                //Special case for protected properties
                if(in_array($name,array(
                    'email',
                    'password',

                ))){
                    $name = '_' . $name;
                }
                $this -> $name = $value;
            }
        }
    }
    function __toString(){
        return $this->display();
    } 
    public function display(){
        $new_note = '<div style="margin-left:2px;">';
        $new_note .= '<h5>' . $this->note_title . '</h5>';
        $new_note .= '<div> <p>' . $this->note . '</p></div><br/>';
        $new_note .= $this->time_created;
        $new_note .= '</div>';
        $new_note .= '<form style="float:right;"method="post">';
        $new_note .= '<input type="submit" class="btn btn-secondary" value="Delete"  name="delete-'. $this->page_num . '"/>';
        $new_note .= '<input type="submit" class="btn btn-secondary" value="Edit"  name="edit-'. $this->page_num . '"/>';
        $new_note .= '</form>';        
        return $new_note;
    }
    public function get($id){
        $db = Database::getInstance();
        $mysqli = $db->getConnection();
        $sql_query = "SELECT * FROM `notes` WHERE note_id = '$id'";
        $result = $mysqli->query($sql_query);
        $row = $result->fetch_assoc();
        //var_dump($row);
        return $row;
    }
    //load method
    public function load($email,$pword){
        //Connection to database
        $db = Database::getInstance();
        //Connects to the database
        $mysqli = $db->getConnection();

        $sql_query = 'SELECT * FROM notes WHERE email = "' . (string) $email . '" && password = "' . (string) $pword . '"';

        $result = $mysqli->query($sql_query);
        $user_notes = array();
        while($row = $result->fetch_assoc()){
            array_push($user_notes, $row);

        }
        return $user_notes;

    }
    public function getInstance($note_type, $data = array()){
        $class_name = "Notes" . self::$all_note_types[$note_type];
        //echo "<p>TEST :" . $class_name($data) . '</p>';
        return new $class_name($data);
    }
}




?>