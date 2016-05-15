<?php
/**
 * tcp_ping.class.php
 * Connectivity Ping, sending NOOP Command to Common TCP Service.
 * 
 * @package TcpPing
 * @author Andronicus Riyono <nick@riyono.com> 
 * @copyright Copyright (c) 2005 Andronicus Riyono <nick@riyono.com>
 * @version 1.0.0
 * @license LGPL
 */

/**
 * TcpPing
 * Connectivity Ping, sending NOOP Command to Common TCP Service. 
 * 
 * This class can be used to check connectivity with TCP service ping. Sending NOOP Command
 * to widely used TCP service (http, telnet, ftp, mail)
 * 
 * @package TcpPing
 * @author Andronicus Riyono <nick@riyono.com> 
 * @copyright Copyright (c) 2005 Andronicus Riyono <nick@riyono.com>
 * @version 1.0.0
 * @access public 
 * @license LGPL
 */
class TcpPing
{
    /**
     * Error Message Container
     * 
     * @var string 
     */
    var $mErrorMessage;

    /**
     * Ping Response Time in seconds
     * 
     * @var float 
     */
    var $mTime;

    /**
     * Ping Start Time in seconds
     * 
     * @var float 
     */
    var $mStartTime;

    /**
     * NOOP command to use
     * 
     * @var string 
     */
    var $mNoopCommand;

    /**
     * Response received from pinged remote host
     * 
     * @var string 
     */
    var $mResponse;

    /**
     * Remote host IP Address
     * 
     * @var float 
     */
    var $mTargetAddr;

    /**
     * Remote host name or IP Address
     * 
     * @var float 
     */
    var $mTargetHost;

    /**
     * Remote host port to ping
     * 
     * @var float 
     */
    var $mTargetPort;

    /**
     * Target TCP Service
     * 
     * @var float 
     */
    var $mTargetService;

    /**
     * Connectivity Ping Timeout in seconds
     * 
     * @var integer 
     */
    var $mTimeout;
    /**
     * SocketPing::_GetMicroTime()
     * 
     * @return float Current microtime in seconds as float
     */
    function _GetMicroTime()
    {
        list($usec, $sec) = explode(" ", microtime());
        return ((float)$usec + (float)$sec);
    } 

    /**
     * SocketPing::TimerStart()
     * Starts the timer
     */
    function TimerStart()
    {
        $this->mStartTime = $this->_GetMicroTime();
    } 

    /**
     * SocketPing::TimerStop()
     * Stop the timer and assign the value to mTime property
     */
    function TimerStop()
    {
        $timer_stop = $this->_GetMicroTime();
        $this->mTime = $timer_stop - $this->mStartTime;
    } 

    /**
     * TcpPing::GetTargetAddress()
     * Get value of mTargetAddr property. mTargetAddr contains target's IP address
     * 
     * @return string target IP address
     */
    function GetTargetAddress()
    {
        return $this->mTargetAddr;
    } 

    /**
     * SocketPing::GetTime()
     * Get the value of mTime property
     * 
     * mTime property contains the ping execution time (set by
     * 
     * @param integer $roundPrecision 
     * @return float Ping Response Time
     */
    function GetTime($roundPrecision = 3)
    {
        $time = round($this->mTime * 1000, $roundPrecision);
        $retval = $time > 1 ? "{$time}ms" : "<1ms";
        return $retval;
    } 

    /**
     * TcpPing::GetErrorMessage()
     * Get the value of mErrorMessage property
     * 
     * mErrorMessage property contains error message if the ping failed 
     * [TcpPing::Ping() returns boolean false]
     * 
     * @return string ErrorMessage
     */
    function GetErrorMessage()
    {
        return $this->mErrorMessage;
    } 

    /**
     * TcpPing::GetResponse()
     * Get the value of mResponse property
     * 
     * mResponse property contains the response from remote host 
     * [ if there are any response of course ;) ]
     * 
     * @return string Tcp Ping Response
     */
    function GetResponse()
    {
        return $this->mResponse;
    } 

    /**
     * TcpPing::_SetNoopCommand()
     * Setting NOOP Command to use
     * the NOOP Command list should be written as an array
     * even when it only contains single NOOP Command.
     * 
     * @access private 
     */
    function _SetNoopCommand()
    {
        switch ($this->mTargetPort)
        {
            case 21:
                $this->mNoopCommand = array("", "NOOP\r\n", "QUIT\r\n");
                break;
            case 25:
                $this->mNoopCommand = array("", "EHLO\r\n", "NOOP\r\n", "QUIT\r\n");
                break;
            case 80:
                $this->mNoopCommand = array("HEAD / HTTP/1.0\r\nConnection: Close\r\n\r\n");
                break;
            case 110:
                $this->mNoopCommand = array("", "QUIT\r\n");
                break;
            default:
                $this->mNoopCommand = array("NOOP\r\n\r\n");
        } // switch
    } 

    /**
     * TcpPing::TcpPing()
     * Constructor of TcpPing class
     * 
     * @param string $host target hostname or ip address
     * @param string $service tcp service to ping (http, ftp, etc.)
     * @param integer $timeout in seconds
     * @access public 
     */
    function TcpPing($host, $service = 'http', $timeout = 30)
    {
        $this->mTargetHost = trim($host);
        $this->mTargetService = trim($service);
        $this->mTimeout = ($timeout > 0) ? $timeout : 30;
    } 

    /**
     * TcpPing::Ping()
     * Do the ping
     * 
     * @return boolean true on successful ping, and false on failed ping.
     */
    function Ping()
    {
        /**
         * Disabling script timeout
         */
        set_time_limit(0);

        /**
         * Setting target port
         */
        if (!($this->mTargetPort = getservbyname($this->mTargetService, 'tcp')))
        {
            $this->mErrorMessage = "No port number associated with the specified Internet service '{$this->mTargetService}'.";
            return false;
        } 

        /**
         * Setting target IP address
         */
        if (preg_match('/^(?:[0-9]{1,3}.){3}[0-9]{1,3}$/', $this->mTargetHost))
        {
            $this->mTargetAddr = $this->mTargetHost;
        } 
        else
        {
            $this->mTargetAddr = gethostbyname($this->mTargetHost);
            /**
             * gethostbyname() returns a string containing the unmodified hostname on failure
             */
            if ($this->mTargetAddr == $this->mTargetHost)
            {
                $this->mErrorMessage = "Could not find host {$this->mTargetHost}.";
                return false;
            } 
        } 

        /**
         * Setting no op command
         * 
         * @see TcpPing::_SetNoopCommand()
         */
        $this->_SetNoopCommand();

        /**
         * Create a TCP/IP socket.
         */
        $socket = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        if (false === $socket)
        {
            $this->mErrorMessage = "Could not open socket, reason: " . socket_strerror(socket_last_error());
            return false;
        } 

        /**
         * Setting timeout
         */
        socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array('sec' => $this->mTimeout, 'usec' => 0));

        /**
         * Try to connect to the specified TCP Service
         */
        $result = @socket_connect($socket, $this->mTargetAddr, $this->mTargetPort);
        if (false === $result)
        {
		    $this->mErrorMessage = trim(socket_strerror(socket_last_error()));
            return false;
        } 

        /**
         * When the script reach this point, it means the connection is already established. 
         * Preparing $reply to receive any reply from the TCP Service and starting the timer.
         */
        $reply = '';
        $this->TimerStart();

        foreach($this->mNoopCommand as $command)
        {
            socket_write($socket, $command, strlen($command));
            $buffer = @socket_read($socket, 2048);
            if (false !== $buffer)
            {
                $reply .= $buffer;
            } 
            else
            {
                $this->mErrorMessage = trim(socket_strerror(socket_last_error()));
                return false;
            } 
        } 
        /**
         * When the script reach this point, it means the TCP Service is responding to the NOOP Command
         * Stopping the timer, closing the connection, setting the mResponse property, returning true.
         */
        $this->TimerStop();
        socket_close($socket);
        $this->mResponse = $reply;
        return true;
    } 
}
?>