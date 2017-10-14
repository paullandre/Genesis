#command.php is the main file. 
#execute php command.php in CLI to see output

Assume that a call is initialized by a client
1. Script will check if there is available agent
   In this sample the range is 1-20, program will get 1 from randomize code.
   Script will check the number for availability of agents, if it is modular by 2 then it is available
   * If an agent is available it will try to solve the issue of the caller
        * If the issue is solved then it is the end of the call already, no more escalation
        * If the issue is unsolved then it will be escalated to TL
   * If no agent is available the program will escalate automatically to TL

2. Script will check if the TL is available or not
   * If the TL is available, it will try to solve the issue of the caller
        * If the issue is solved then it is the end of the call already, no more escalation
        * If the issue is unsolved then it will be escalated to PM
   * If TL is not available the program will escalate automatically to PM

3. Script automatically puts the PM into call since it is the last level of escalation
   Issue automatically Solved and call will be ended
   This executes when a TL is not available or if the TL didn't solve the issue of the caller

command.php - main command to execute
core.class.php - contains the functions for the status of call, pick the number for agent and availability of Agent or TL
message.class.php - contains the message to be printed in every script