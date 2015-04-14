<?php

    require_once ('swiftmailer/lib/swift_required.php');
    require_once ('swiftmailer/lib/classes/Swift.php');
    require_once ('templates/Template.class.php');
    
    Class SwiftMailer {
        
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
        private $m_sMailBody;
        private $m_aItems;
        
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
            $this->m_aItems = array();
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
                case 'items':
                    $this->m_aItems = $p_vValue;
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
                case 'items':
                    return($this->m_aItems);
                    break;
            }
        }
        
        public function validate($p_nChecked=1) {
            if(empty($this->m_sName)) {
                return "Please enter your name";
            } else if(empty($this->m_sEmail)) {
                return "Please enter your e-mail address";
            } else {
                preg_match("/.*.@.*./", $this->m_sEmail, $l_bChecked);
                
                if(count($l_bChecked)<=0){
                    return "The e-mail you've entered is not a valid e-mail address";
                } else if (empty($this->m_sMessage) && $p_nChecked == 1) {
                    return "Please insert a message to send";
                } else {
                    return 0;
                }
            }
        }
        
        public function order() {
            $l_oTemplate = new Template();
            $l_oTemplate->header($this->m_sSubject);
            $l_oTemplate->info(['Name' => $this->m_sName, 
                                'Email' => $this->m_sEmail,
                                'Phone' => $this->m_iPhone,
                                '' => '',
                                'Company' => $this->m_sCompany,
                                'Address' => $this->m_sAddress,
                                'Country' => $this->m_sCountry,
                                'City' => $this->m_sCity,
                                'Zip' => $this->m_iZip]);
            $l_oTemplate->itemList($this->m_aItems);
            $l_oTemplate->message('Comment', $this->m_sMessage);
            $l_oTemplate->footer();
            
            $this->m_sMailBody = $l_oTemplate->emailTemplate();
            return $this->submit();
        }
        
        public function contact() {
            $l_oTemplate = new Template();
            $l_oTemplate->header($this->m_sSubject);
            $l_oTemplate->info(['Name' => $this->m_sName, 
                                'Email' => $this->m_sEmail]);
            $l_oTemplate->message('Enquiry', $this->m_sMessage);
            $l_oTemplate->footer();
            
            $this->m_sMailBody = $l_oTemplate->emailTemplate();
            return $this->submit();
        }
        
        private function submit() {
            Swift::registerAutoload();
            
            $l_oTransport = \Swift_SmtpTransport::newInstance('flanders01.flanders.local','25')
                ->setUsername('')
                ->setPassword('');
            
            $l_oSwift = \Swift_Mailer::newInstance($l_oTransport);
            
            $l_oMessage = \Swift_Message::newInstance($this->m_sSubject)
                ->setFrom([$this->m_sEmail => $this->m_sName])
                ->setTo(['annick@artaddict.eu' => 'Annick Boghemans'])
                ->setBody($this->m_sMailBody, 'text/html')
                ->addPart(strip_tags($this->m_sMailBody), 'text/plain');
            
            if ($l_oSwift->send($l_oMessage)){
                return 0;
            } else {
                return 1;
            }
        }
    }