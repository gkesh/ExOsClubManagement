
<?php
class attendeeData{
	private $email;
	private $name;
	private $faculty;
	private $level;
	private $college;
	private $events;
	
	//Methods getters and setters
	//Constructor
	function __construct(){
		//Default Constructor
	}
	function getEmail() {
            return $this->email;
        }

        function getName() {
            return $this->name;
        }

        function getFaculty() {
            return $this->faculty;
        }

        function getLevel() {
            return $this->level;
        }

        function getCollege() {
            return $this->college;
        }

        function getEvents() {
            return $this->events;
        }

        function setEmail($email) {
            $this->email = $email;
        }

        function setName($name) {
            $this->name = $name;
        }

        function setFaculty($faculty) {
            $this->faculty = $faculty;
        }

        function setLevel($level) {
            $this->level = $level;
        }

        function setCollege($college) {
            $this->college = $college;
        }

        function setEvents($events) {
            $this->events = $events;
        }


	
}
?>