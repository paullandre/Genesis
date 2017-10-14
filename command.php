<?php

define('ROOT', __DIR__);

require_once ROOT . '/core/core.class.php';
require_once ROOT . '/core/message.class.php';

$core = new core();
/* Checking for agents available */
print "\nChecking available agent...\n";
sleep(3);
$agent = $core->getStatus(1, 20);
print $agent . "\n";
sleep(1);

$message = new message();

$isAgentAvailable = $core->getStatusValue($agent);
if($isAgentAvailable == true)
{
    /* If an agent is available */
    $displayMessage = $message->getMessage("Agent", true, $agent);
    print $displayMessage;
    sleep(3);
    
    $call = $core->getStatus(1,2);
    print "Call # $call \n"; sleep(1);
    
    $callStatus = $core->getCallStatus($call, "TL");
    $code = $callStatus['code'];
    $msg  = $callStatus['message'];
    print $msg;
    sleep(2);
    
    if($code == 1)
    {
        /* If issue is unsolved by agent, escalate to TL */
        $tl = $core->getStatus(1, 2);
        $isTLAvailable = $core->getStatusValue($tl);  
        
        if($isTLAvailable == true)
        {
            /* TL to take the call */
            $displayMessage = $message->getMessage("TL", true, null);
            print $displayMessage;
            sleep(2);

            /* GET STATUS OF CALL */
            $call = $core->getStatus(1,2);
            print "TL Call # $call \n"; sleep(1);

            $callStatus = $core->getCallStatus($call, "PM");
            $code = $callStatus['code'];
            $msg  = $callStatus['message'];
            print $msg;
            sleep(2);
            
            /* If TL not able to solve issue */
            if($code == 1)
            {                
                print "PM is taking the call...\n";
                sleep(3);
                print "Call ended. Issue solved \n";
                sleep(1);
            }            
        }
        else
        {            
            /* TL not available and escalating to PM */
            $displayMessage = $message->getMessage("TL", false, null);
            print $displayMessage;
            sleep(2);
            print "PM is taking the call...\n";
            sleep(3);
            print "Call ended. Issue solved \n";
            sleep(1);
        }
    }
}
else
{    
    /* If an agent is not available escalte to TL */
    $displayMessage = $message->getMessage("Agent", false, null);
    print $displayMessage;
    sleep(3);
        
    /* Checking for TL available */
    $tl = $core->getStatus(1, 2);
    $isTLAvailable = $core->getStatusValue($tl);
    
    if($isTLAvailable == true)
    {
        /* TL to take the call */
        $displayMessage = $message->getMessage("TL", true, null);
        print $displayMessage;
        sleep(2);
        
        //GET STATUS OF CALL
        $call = $core->getStatus(1,2);
        print "TL Call # $call \n"; sleep(1);

        $callStatus = $core->getCallStatus($call, "PM");
        $code = $callStatus['code'];
        $msg  = $callStatus['message'];
        print $msg;
        sleep(2);
        
        /* If TL not able to solve issue */
        if($code == 1)
        {            
            print "PM is taking the call...\n";
            sleep(3);
            print "Call ended. Issue solved \n";
            sleep(1);
        }
    }   
    else
    {
        /* TL not available and escalating to PM */
        $displayMessage = $message->getMessage("TL", false, null);
        print $displayMessage;
        sleep(2);
        print "PM is taking the call...\n";
        sleep(3);
        print "Call ended. Issue solved \n";
        sleep(1);
    }
}

?>