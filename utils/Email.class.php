<?php

    require_once ('phpmailer/class.phpmailer.php');
    require_once ('phpmailer/mail_template.php');
    
    Class Email {
        
        private $m_sSubject;
        private $m_sName;
        private $m_sCompany;
        private $m_sAddress;
        private $m_iZip;
        private $m_sCity;
        private $m_sCountry;
        private $m_sEmail;
        private $m_iPhone;
        private $m_sMessage;
        private $m_oMailer;
        
        function __construct() {
            $this->m_sSubject = 'Contact Request';
            $this->m_sName = '';
            $this->m_sCompany = ''; 
            $this->m_sAddress = ''; 
            $this->m_iZip = ''; 
            $this->m_sCity = '';
            $this->m_sCountry = ''; 
            $this->m_sEmail = ''; 
            $this->m_iPhone = '';
            $this->m_sMessage = '';
        }
        
        public function __set($p_sProperty, $p_vValue) {
            switch ($p_sProperty) {
                case 'subject':
                    $this->m_sSubject = htmlspecialchars($p_vValue);
                    break;
                case 'name':
                    $this->m_sName = htmlspecialchars($p_vValue);
                    break;
                case 'company':
                    $this->m_sCompany = htmlspecialchars($p_vValue);
                    break;
                case 'address':
                    $this->m_sAddress = htmlspecialchars($p_vValue);
                    break;
                case 'zip':
                    $this->m_iZip = htmlspecialchars($p_vValue);
                    break;
                case 'city':
                    $this->m_sCity = htmlspecialchars($p_vValue);
                    break;
                case 'country':
                    $this->m_sCountry= htmlspecialchars($p_vValue);
                    break;
                case 'email':
                    $this->m_sEmail = htmlspecialchars($p_vValue);
                    break;
                case 'phone':
                    $this->m_iPhone = htmlspecialchars($p_vValue);
                    break;
                case 'message':
                    $this->m_sMessage = nl2br(htmlspecialchars($p_vValue));
                    break;
            }
        }
        
        public function __get($p_sProperty) {
            switch ($p_sProperty) {
                case 'subject':
                    return($this->m_sSubject);
                    break;
                case 'name':
                    return($this->m_sName);
                    break;
                case 'company':
                    return($this->m_sCompany);
                    break;
                case 'address':
                    return($this->m_sAddress);
                    break;
                case 'zip':
                    return($this->m_iZip);
                    break;
                case 'city':
                    return($this->m_sCity);
                    break;
                case 'country':
                    return($this->m_sCountry);
                    break;
                case 'email':
                    return($this->m_sEmail);
                    break;
                case 'phone':
                    return($this->m_iPhone);
                    break;
                case 'message':
                    return($this->m_sMessage);
                    break;
            }
        }
        
        public function validate () {
            if(empty($this->m_sName)) {
                return "Please enter your name";
            } else if(empty($this->m_sEmail)) {
                return "Please enter your e-mail address";
            } else {
                preg_match("/.*.@.*./", $this->m_sEmail, $l_bChecked);
                
                if(count($l_bChecked)<=0){
                    return "The e-mail you've entered is not a valid e-mail address";
                } else if (empty($this->m_sMessage)) {
                    return "Please insert a message to send";
                } else {
                    return 0;
                }
            }
        }
        
        public function submit () {
            $l_oTemplate = new Template();
            $l_oTemplate->subject = $this->m_sSubject; 
            $l_oTemplate->name = $this->m_sName;
            $l_oTemplate->company = $this->m_sCompany;
            $l_oTemplate->address = $this->m_sAddress;
            $l_oTemplate->zip = $this->m_iZip;
            $l_oTemplate->city = $this->m_sCity;
            $l_oTemplate->country = $this->m_sCountry; 
            $l_oTemplate->email = $this->m_sEmail; 
            $l_oTemplate->phone = $this->m_iPhone; 
            $l_oTemplate->message = $this->m_sMessage;
            
            $l_oMailer = new PHPMailer;
            $l_oMailer->Host = 'localhost';
            $l_oMailer->Port = 25;
            
            $l_oMailer->From = $this->m_sEmail;
            $l_oMailer->FromName = $this->m_sName;
            $l_oMailer->addAddress('jorik.janssens@telenet.be', 'Jorik Janssens');
            $l_oMailer->addReplyTo($this->m_sEmail);

            $l_oMailer->isHTML(true);
            $l_oMailer->Subject = $this->m_sSubject;
            $l_oMailer->Body = $l_oTemplate->emailTemplate();
            $l_oMailer->AltBody = $l_oTemplate->emailTemplate();
            
            if (!$l_oMailer->Send()) {
                //return 'We appologise, but we were unable to connect to our mail server. Please contact us directly at info@artaddict.eu';
                return $l_oMailer->ErrorInfo;
            } else {
                return 'Message successfully submitted';
            }
        }
    }