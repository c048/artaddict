                    <tr>
                        <td colspan='3' style='padding: 30px 0 10px 31px;'>
                            <h2 style='font-weight: normal; font-size: 1.05em; color: #ff2500; letter-spacing: 1.2px; margin: 0;'>Personal information</h2>
                            <p style='font-weight: normal; font-size: 0.88em; line-height: 1.35em; margin: 1em 0 1em 0;'>
                                <?php if(isset($m_sInfoName) && !empty($m_sInfoName)) {echo 'Name: $m_sInfoName <br/>';} ?>
                                <?php if(isset($m_sInfoSurName) && !empty($m_sInfoSurName)) {echo 'Surname: $m_sInfoSurName <br/>';} ?>
                                <?php if(isset($m_sInfoCompany) && !empty($m_sInfoCompany)) {echo 'Company: $m_sInfoCompany <br/>';} ?>
                                <?php if(isset($m_sInfoEmail) && !empty($m_sInfoEmail)) {echo 'Email: $m_sInfoEmail <br/>';} ?>
                                <?php if(isset($m_nInfoPhone) && !empty($m_nInfoPhone)) {echo 'Phone: $m_nInfoPhone <br/>';} ?>
                                <br/>
                                <?php if(isset($m_sInfoAddress) && !empty($m_sInfoAddress)) {echo 'Address: $m_sInfoAddress <br/>';} ?>
                                <?php if(isset($m_sInfoZip) && !empty($m_sInfoZip)) {echo 'Zip: $m_sInfoZip <br/>';} ?>
                                <?php if(isset($m_sInfoCity) && !empty($m_sInfoCity)) {echo 'City: $m_sInfoCity <br/>';} ?>
                                <?php if(isset($m_sInfoCountry) && !empty($m_sInfoCountry)) {echo 'Country: $m_sInfoCountry <br/>';} ?>
                            </p>
                        </td>
                    </tr>