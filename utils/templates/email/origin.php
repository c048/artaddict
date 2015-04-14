

        function emailTemplate() {

            $l_sHTML =  '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html style="margin: 0; padding: 0; height: 100%;"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /><title>';
            if(!empty($this->m_sSubject)) {$l_sHTML .= $this->m_sSubject;} else {$l_sHTML .= 'Contact Form';}
            $l_sHTML .='</title><style type="text/css"></style></head><body style="margin: 0; background-color:#eee; padding: 0; width=100%; font-family: Arial; color: #777; font-size: 16px;"><div border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #eee; margin: 0; padding: 0;"><div style="background-color: #fff; width: 600px; margin: 0 auto 0 auto; padding: 0 0 0 0;"><table border="0" cellpadding="0" cellspacing="0" width="100%"><tr style="height: 135px;"><td colspan="3" style="width: 100%;" ><p style="color: #FFF; text-transform:uppercase; margin: 85px 0 0 31px; letter-spacing: 2px; font-size: 1.00em; position: absolute; z-index: 2;"><span style="color: #ff2500;">Contact</span> Form Enquiry</p><img style="width: 600px; padding: 0 0 0 0; border: 0px; z-index: 0;" src="http://www.artaddict.eu/public/assets/siteart/email_header.jpg" alt="artaddict logo" id="image_n4"/></td></tr><tr><td colspan="3" style="padding: 30px 0 10px 31px;"><h2 style="font-weight: normal; font-size: 1.05em; color: #ff2500; letter-spacing: 1.2px; margin: 0;">';
            if(!empty($this->m_sSubject)) {$l_sHTML .= $this->m_sSubject;} else {$l_sHTML .= 'Contact Form';}
            $l_sHTML .= '</h2><p style="font-weight: normal; font-size: 0.88em; line-height: 1.35em; margin: 1em 0 1em 0;">';
            if(!empty($this->m_sName)) {$l_sHTML .= "Name: $this->m_sName <br/>";}
            if(!empty($this->m_sSurName)) {$l_sHTML .= "Surname: $this->m_sSurName <br/>";}
            if(!empty($this->m_sCompany)) {$l_sHTML .= "Company: $this->m_sCompany <br/>";}
            if(!empty($this->m_sEmail)) {$l_sHTML .= "Email: $this->m_sEmail <br/>";}
            if(!empty($this->m_nPhone)) {$l_sHTML .= "Phone: $this->m_nPhone <br/>";}
            
            $l_sHTML .= '<br/>';
            
            if(!empty($this->m_sAddress)) {$l_sHTML .= "Address: $this->m_sAddress <br/>";}
            if(!empty($this->m_sZip)) {$l_sHTML .= "Zip: $this->m_sZip <br/>";}
            if(!empty($this->m_sCity)) {$l_sHTML .= "City: $this->m_sCity <br/>";}
            if(!empty($this->m_sCountry)) {$l_sHTML .= "Country: $this->m_sCountry <br/>";}
            
            $l_sHTML .= '</p></td></tr>';
            
            if(!empty($this->m_sMessage)) {
                $l_sHTML .= "<tr>
                        <td colspan='3' style='padding: 0 0 0 31px;'>
                            <h2 style='font-weight: normal; font-size: 1.05em; color: #ff2500; letter-spacing: 1.2px; margin: 0;'>Message</h2>
                            <p style='font-weight: normal; font-size: 0.88em; line-height: 1.35em; padding: 0 25px 10px 0; margin: 1em 0 1em 0;'>$this->m_sMessage<br/></p>
                        </td>
                    </tr>";
            }
            $l_sHTML .=' <tr><td colspan="3" style="padding: 40px 0 0 0"><p style="color:#FFF; margin: 65px 0 0 250px; letter-spacing: 2px; font-size: 0.75em; position: absolute; z-index: 2;"><span style="color:#ff2500;">art</span>addict © 2014</p><img src="http://www.artaddict.eu/public/assets/siteart/email_footer.jpg" alt="Artaddict footer" /></td></tr></table></div></div></body></html>';
            return($l_sHTML);
        }