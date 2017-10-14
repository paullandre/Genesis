<?php

/**
 * Description of message
 *
 * @author Paul Andre Francisco
 */

class message 
{
    /* Get message to display. Returns string */
    public function getMessage($employee, $is_available, $agent = null)
    {
        $this->message = "";
        if($employee == "Agent")
        {
            if($is_available == true)
            {
                $this->message = "Agent $agent is available. Taking the call...\n";
            }
            else
            {
                $this->message = "No Agent available, Escalating to TL. Please wait...\n";
            }
        }
        else if($employee == "TL")
        {
            if($is_available == true)
            {
                $this->message = "TL is available. Taking the call...\n";
            }
            else
            {
                $this->message = "TL not available... Escalating to PM. Please wait...\n";                                
            }
        }
        
        return $this->message;
    }
}

?>
