<?php
/**
 * @author          Subigya Jyoti Panta
 * @subpackage      SagePay
 * @copyright (c) 2014, www.eooro.com
 * @version         1.0
 * @modification history original
 * @note            For SagePay, '@' sign should be 'prepended' after encryption
 *                  and 'removed' before decryption.
 */
defined( 'SJP' ) or die;

class Cryptor
{
    /**
     * Encryption code for SagePay
     * @var string 
     */
    protected $encryptionCode;
    
    /**
     * Decryption code to get reply from SagePay.
     * @var string 
     */
    protected $decryptionCode;
    
    /**
     * Contains raw data that is to be encoded.
     * @var string
     */
    protected $cleanData;
    
    /**
     * Contains 128-bit AES encoded string data.
     * @var string
     */
    protected $encryptedData;
    
    /**
     * To encrypt cleand data using AES 128 bit encryption
     * 
     * @return \Cryptor
     */
    public function encrypt()
    {
        $this->cleanData = $this->addPadding( 16 );

        $key = $this->encryptionCode;
        $iv = $key;

        $cipher = mcrypt_module_open(MCRYPT_RIJNDAEL_128, "", MCRYPT_MODE_CBC, "");
        if (mcrypt_generic_init($cipher, $key, $iv) != -1)
        {
                $cipherText = mcrypt_generic($cipher,  $this->cleanData );
                mcrypt_generic_deinit($cipher);

                $this->encryptedData = bin2hex($cipherText);
        }
        return $this;
    }
    
    /**
     * To decrypt 128 bit AES encrypted data.
     *  
     * @return \Cryptor
     */
    public function decrypt()
    {
        $encrypted       = pack( 'H*', $this->encryptedData );
        $this->cleanData = mcrypt_decrypt( MCRYPT_RIJNDAEL_128, $this->decryptionCode, $encrypted, MCRYPT_MODE_CBC, $this->decryptionCode );
        return $this;
    }
    
    /**
     * Apply PKCS#5 padding
     * 
     * @param int $blocksize blocksize of padding
     * @return string
     */
    protected function addPadding( $blocksize )
    {
        $pad = $blocksize - (strlen($this->cleanData) % $blocksize);
        //echo "<br/>Padding:".str_repeat(chr($pad), $pad);
        return $this->cleanData . str_repeat(chr($pad), $pad);
    }
    
    /**
     * To set encryption passphrase
     * 
     * @param string $code
     * @return \Cryptor
     */
    public function setEncryptionCode( $code )
    {
        $this->encryptionCode = $code;
        return $this;
    }
    
    /**
     * To set decryption passphrase
     * 
     * @param type $code
     * @return \Cryptor
     */
    public function setDecryptionCode( $code )
    {
        $this->decryptionCode = $code;
        return $this;
    }
    
    public function getEncryptionCode()
    {
        return $this->encryptionCode;
    }
    
    public function getDecryptionCode()
    {
        return $this->decryptionCode;
    }
    
    /**
     * To set the Raw data that is to be encrypted.
     * 
     * @param string $data
     * @return \Cryptor
     */
    public function setCleanData( $data )
    {
        $this->cleanData = $data;
        return $this;
    }
    
    /**
     * To set the Encrypted data that is to be decrypted.
     * 
     * @param string $data
     * @return \Cryptor
     */
    public function setEncryptedData( $data )
    {
        $this->encryptedData = $data;
        return $this;
    }
    
    public function getCleanData()
    {
        return $this->cleanData;
    }
    
    public function getEncryptedData()
    {
        return $this->encryptedData;
    }
}
