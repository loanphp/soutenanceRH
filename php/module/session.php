<?php 
 
class Session{
    private $session = [] ;
    private $session_name;
    public function __construct(string $session_name){
        $this->session_name = $session_name;
    }
    public function create_session(array $data){
        foreach($data as $key => $value){
            $this->session[$key] = $value ;
        }
        return $_SESSION[$this->session_name] = $this->session;
    }
} 