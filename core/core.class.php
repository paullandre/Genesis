<?php
/**
 * @Core class
 * @Handles request from command.php
 * @Serves as Controller
 */

class core
{   
    private $status = 0;
    private $availability = false;
    private $supportStatus = "";             
            
    /* Returns integer for available agent or TL or call status */
    public function getStatus($min, $max)
    {
        $this->status = mt_rand($min, $max);
        
        return $this->status;
    }
    
    /* Returns boolean (availability to answerd call) */
    public function getStatusValue($result)
    {        
        if($result % 2 == 0)
        {
            $this->availability = true;
        }
        else
        {
            $this->availability = false;
        }
        
        return $this->availability;
    }
    
    /* Returns string (Status of support) */
    public function getCallStatus($result, $employee = null)
    {        
        if($result % 2 == 0)
        {
            $this->supportStatus = array("code" => 2, "message" => "Issue solved. Call ended.\n");
        }
        else
        {
            $this->supportStatus = array("code" => 1, "message" => "Issue unsolved. Escalating to $employee.\n");
        }
        
        return $this->supportStatus;
    }        
}

?>
