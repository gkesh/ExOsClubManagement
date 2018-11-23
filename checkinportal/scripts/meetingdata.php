<?php
  /**
   * Class for storing meeting data
   */
  class meetingdata
  {
    //private variables for information security
    private $id;
    private $title;
    private $details;
    private $meeting_date;
    private $attendees;
    private $start_time;
    private $end_time;
    private $location;

    function __construct()
    {
      # Default constructor
    }

    // Getters & setters
    function getId(){
      return $this->id;
    }
    function getTitle(){
      return $this->title;
    }
    function getDetails(){
      return $this->details;
    }
    function getLocation(){
      return $this->location;
    }
    function getMeetingDate(){
      return $this->meeting_date;
    }
    function getAttendees(){
      return $this->attendees;
    }
    function getStartTime(){
      return $this->start_time;
    }
    function getEndTime(){
      return $this->end_time;
    }
    function setMeetingDate($meeting_date){
      $this->meeting_date = $meeting_date;
    }
    function setTitle($title){
      $this->title = $title;
    }
    function setDetails($details){
      $this->details = $details;
    }
    function setLocation($location){
      $this->location = $location;
    }
    function setAttendees($attendees){
      $this->attendees = $attendees;
    }
    function setStartTime($start_time){
      $this->start_time = $start_time;
    }
    function setEndTime($end_time){
      $this->end_time = $end_time;
    }
  }

 ?>
