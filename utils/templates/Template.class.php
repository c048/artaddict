<?php

    class Template {
        
        private $m_sHTML;
        
        public function __construct() {
            $this->m_sHTML = '';
        }
        
        public function header ($p_sHeaderTitle='Contact Form') {
            $l_sMail = "<!DOCTYPE HTML PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
                        <html style='margin: 0; padding: 0; height: 100%;'>
                        <head>
                            <meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
                            <title>"; 
            $l_sMail .= $p_sHeaderTitle;
            $l_sMail .= "</title>
                            <style type='text/css'></style>
                        </head>
                        <body style='margin: 0; background-color:#eee; padding: 0; width=100%; font-family: Arial; color: #777; font-size: 16px;'>
                            <div border='0' cellpadding='0' cellspacing='0' width='100%' style='background-color: #eee; margin: 0; padding: 0;'>
                                <div style='background-color: #fff; width: 600px; margin: 0 auto 0 auto; padding: 0 0 0 0;'>
                                    <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                                        <tr style='height: 135px;'>
                                            <td colspan='3' style='width: 100%;' >
                                                <p style='color: #FFF; text-transform:uppercase; margin: 85px 0 0 31px; letter-spacing: 2px; font-size: 1.00em; position: absolute; z-index: 2;'>
                                                    <span style='color: #ff2500;'>"; 
            $l_sMail .= $p_sHeaderTitle;
            $l_sMail .= "                           </span> Enquiry</p>
                                                <img style='width: 600px; padding: 0 0 0 0; border: 0px; z-index: 0;' src='http://www.artaddict.eu/public/assets/siteart/email_header.jpg' alt='artaddict logo' id='image_n4'/>
                                            </td>
                                        </tr>";
            $this->m_sHTML .= $l_sMail;
        }
        
        public function info ($p_aInfo=array()) {
            $l_sMail = "                <tr>
                                            <td colspan='3' style='padding: 30px 0 10px 31px;'>
                                                <h2 style='font-weight: normal; font-size: 1.05em; color: #ff2500; letter-spacing: 1.2px; margin: 0;'>Personal information</h2>
                                                <p style='font-weight: normal; font-size: 0.88em; line-height: 1.35em; margin: 1em 0 1em 0;'>";
            
            foreach ($p_aInfo as $l_sKey => $l_sValue) {
                if(!empty($l_sKey) xor empty($l_sValue))
                $l_sMail .= $l_sKey . ': ' . $l_sValue . '<br/>';
            }
            
            $l_sMail .= "                       </p>
                                            </td>
                                        </tr>";
            
            $this->m_sHTML .= $l_sMail;
        }
        
        public function itemList ($p_aItems = array()){
            $l_nTotal = 0;
            
            $l_sMail = "        <tr>
                                    <td colspan='3' style='padding: 0 0 5px 31px;'>
                                        <h2 style='font-weight: normal; font-size: 1.05em; color: #ff2500; letter-spacing: 1.2px; margin: 0;'>Orders</h2>
                                    </td>
                                </tr>";
            
            foreach ($p_aItems as $key => $value) {
                $l_sMail .= "        <tr style='font-weight: normal; font-size: 0.88em; line-height: 1.35em;'>
                                        <td style='width: 300px; padding: 0 0 0 31px;'>";
                $l_sMail .= $value['name'] . " x " . $value['quantity'];
                $l_sMail .= "            </td>
                                        <td style='width: 50px; padding: 0 10px 0 15px; text-align:right;'>";
                $l_sMail .= $value['price'];
                $l_sMail .= "            </td>
                                        <td style='width: 50px; padding: 0 30px 0 0px; text-align:right;'>";
                $l_sMail .= $value['price'] * $value['quantity'];
                $l_sMail .= "            </td>
                                    </tr>";
                $l_nTotal = $l_nTotal + $value['price'] * $value['quantity'];
            }
            
            $l_sMail .= "        <tr style='font-weight: normal; font-size: 0.88em; line-height: 1.35em;'>
                                    <td style='width: 300px; padding: 5px 0 5px 31px;'></td>
                                    <td style='width: 60px; padding: 5px 10px 5px 15px; color: #ff2500; text-align: right;'>
                                        Total 
                                    </td>
                                    <td style='width: 50px; padding: 5px 30px 5px 0px; background-color: #ff2500; color: #FFF; text-align:right;'>";
            $l_sMail .= $l_nTotal;
            $l_sMail .= "            </td>
                                </tr>";
            
            $this->m_sHTML .= $l_sMail;
        }
        
        public function message ($p_sMessageTitle = '', $p_sMessageContent = '') {
            $l_sMail = "<tr>
                            <td colspan='3' style='padding: 0 0 0 31px;'>
                                <h2 style='font-weight: normal; font-size: 1.05em; color: #ff2500; letter-spacing: 1.2px; margin: 0;'>";
            
            $l_sMail .= $p_sMessageTitle;
            
            $l_sMail .= "       </h2><p style='font-weight: normal; font-size: 0.88em; line-height: 1.35em; padding: 0 25px 10px 0; margin: 1em 0 1em 0;'>";
                                
            $l_sMail .= $p_sMessageContent;
            
            $l_sMail .= "        </p>
                            </td>
                        </tr>";
            
            $this->m_sHTML .= $l_sMail;
        }
        
        public function footer () {
            $l_sMail = "                    <tr>
                                                <td colspan='3' style='padding: 40px 0 0 0'>
                                                    <p style='color:#FFF; margin: 65px 0 0 250px; letter-spacing: 2px; font-size: 0.75em; position: absolute; z-index: 2;'><span style='color:#ff2500;'>art</span>addict © 2014</p>
                                                    <img src='http://www.artaddict.eu/public/assets/siteart/email_footer.jpg' alt='Artaddict footer' />
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </body>
                        </html>";
            
            $this->m_sHTML .= $l_sMail;
        }
        
        public function emailTemplate() {
            return $this->m_sHTML;
        }
    }

?>