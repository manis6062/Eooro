<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 */
defined( 'SJP' ) or die;
Class ServerConfig
{
    public static $instance;
    public $config;
    
    /**
     * To get configuration depending on Test Server, Live server or Simulator
     * 
     * @param String $connect_to test, live or simulator
     */
    private function __construct( $connect_to = 'SIMULATOR' )
    {    
        // Set this value to the Vendor Name assigned to you by Sage Pay or chosen when you applied
        $this->config['vendorname'] = ""; 

        // Set this to indicate the currency in which you wish to trade. You will need a merchant number in this currency
        $this->config['currency'] = "GBP";

        // This can be DEFERRED or AUTHENTICATE if your Sage Pay account supports those payment types
        /**	TxType
        ** 
        ** Alphabetic 
        ** Max 15 characters. 
        ** 
        ** PAYMENT, DEFERRED or 
        ** AUTHENTICATE ONLY 
        ** 
        ** See companion document “Server and Direct Shared Protocols” for 
        ** other transaction types (such as Refund, Releases, Aborts and 
        ** Repeats). The value should be in capital letters. */
        $this->config['transactiontype'] = "PAYMENT"; 

        /** Optional setting. If you are a Sage Pay Partner and wish to flag the transactions with your unique partner id set it here. **/
        $this->config['partnerid'] = ""; 

        /** Set to SIMULATOR for the Sage Pay Simulator expert system, TEST for the Test Server **
        *** and LIVE in the live environment **/
        $this->config['connect_to'] = $connect_to; 	
        #$config['connect_to'] = "TEST"; 	
        #$config['connect_to'] = "LIVE"; 	


        /** IMPORTANT.  Set the strYourSiteFQDN value to the Fully Qualified Domain Name of your server. **
        ** This should start http:// or https:// and should be the name by which our servers can call back to yours **
        ** i.e. it MUST be resolvable externally, and have access granted to the Sage Pay servers **
        ** examples would be https://www.mysite.com or http://212.111.32.22/ **
        ** NOTE: You should leave the final / in place. **/
        $this->config['your_site_fqdn']	= "";

        /** At the end of a Sage Pay Server transaction, the customer is redirected back to the completion page **
        ** on your site using a client-side browser redirect. On live systems, this page will always be **
        ** referenced using the strYourSiteFQDN value above.  During development and testing, however, it **
        ** is often the case that the development machine sits behind the same firewall as the server **
        ** hosting the kit, so your browser might not be able resolve external IPs or dns names. **
        ** e.g. Externally your server might have the IP 212.111.32.22, but behind the firewall it **
        ** may have the IP 192.168.0.99.  If your test machine is also on the 192.168.0.n network **
        ** it may not be able to resolve 212.111.32.22. **
        ** Set the strYourSiteInternalFQDN to the internal Fully Qualified Domain Name by which **
        ** your test machine can reach the server (in the example above you'd use http://192.168.0.99/) **
        ** If you are not on the same network as the test server, set this value to the same value **
        ** as strYourSiteFQDN above. **
        ** NOTE: You should leave the final / in place. **/
        $this->config['your_site_internal_fqdn'] = "";

        /**************************************************************************************************
        * Global Definitions for this site
        ***************************************************************************************************/

        $this->config['protocol'] = "2.23";

        if ($this->config['connect_to'] == $connect_to )
        {
          $this->config['aborturl']       = "https://live.sagepay.com/gateway/service/abort.vsp";
          $this->config['authoriseurl']   = "https://live.sagepay.com/gateway/service/authorise.vsp";
          $this->config['cancelurl']      = "https://live.sagepay.com/gateway/service/cancel.vsp";
          $this->config['purchaseurl']    = "https://live.sagepay.com/gateway/service/vspserver-register.vsp";
          $this->config['refundurl']      = "https://live.sagepay.com/gateway/service/refund.vsp";
          $this->config['releaseurl']     = "https://live.sagepay.com/gateway/service/release.vsp";
          $this->config['repeaturl']      = "https://live.sagepay.com/gateway/service/repeat.vsp";
          $this->config['voidurl']        = "https://live.sagepay.com/gateway/service/void.vsp";
        }
        elseif ($this->config['connect_to'] == $connect_to)
        {
          $this->config['aborturl']       = "https://test.sagepay.com/gateway/service/abort.vsp";
          $this->config['authoriseurl']   = "https://test.sagepay.com/gateway/service/authorise.vsp";
          $this->config['cancelurl']      = "https://test.sagepay.com/gateway/service/cancel.vsp";
          $this->config['purchaseurl']    = "https://test.sagepay.com/gateway/service/vspserver-register.vsp";
          $this->config['refundurl']      = "https://test.sagepay.com/gateway/service/refund.vsp";
          $this->config['releaseurl']     = "https://test.sagepay.com/gateway/service/abort.vsp";
          $this->config['repeaturl']      = "https://test.sagepay.com/gateway/service/repeat.vsp";
          $this->config['voidurl']        = "https://test.sagepay.com/gateway/service/void.vsp";
        }
        else // simulator
        {
          $this->config['aborturl']       = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorAbortTx";
          $this->config['authoriseurl']   = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorAuthoriseTx";
          $this->config['cancelurl']      = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorCancelTx";
          $this->config['purchaseurl']    = "https://test.sagepay.com/Simulator/VSPServerGateway.asp?Service=VendorRegisterTx";
          $this->config['refundurl']      = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorRefundTx";
          $this->config['releaseurl']     = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorReleaseTx";
          $this->config['repeaturl']      = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorRepeatTx";
          $this->config['voidurl']        = "https://test.sagepay.com/simulator/VSPServerGateway.asp?Service=VendorVoidTx";
        }
        
        $members_url    = "".DEFAULT_URL."/".MEMBERS_ALIAS;
        $this->config['success_url']      = $members_url."/billing/processpayment.php?payment_method=sagepay";
            
        $this->config['not_authed_url']   = $members_url."/billing/processpayment.php?payment_method=sagepay&cancel=true";
        $this->config['abort_url']        = $members_url."/billing/processpayment.php?payment_method=sagepay&cancel=true";
        $this->config['failure_url']      = $members_url."/billing/processpayment.php?payment_method=sagepay&cancel=true";
        
        /**
         * Connection test urls
         */
        switch ( $connect_to ) {
            
            case 'SIMULATOR':
                $this->config['test'] = 'https://test.sagepay.com/Simulator/VSPDirectGateway.asp';
                break;
            
            case 'LIVE':
                // todo
                break;
            
            case 'TEST':
                // TODO
                break;
            
            default:
                // code for live
                break;
        }
    }
    
    
    private function __clone(){}
    
    /**
     * To get configuration depending on Test Server, Live server or Simulator
     * 
     * @param string $connection_type test, live or simulator
     * @return ServerConfig
     */
    public static function getInstance( $connection_type )
    {
        if ( !isset(static::$instance[$connection_type]) ) {
            static::$instance[ $connection_type ] = new ServerConfig( $connection_type );
        }
        return static::$instance[ $connection_type ];
    }
}