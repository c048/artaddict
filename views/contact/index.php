<section id="cSingleColumn">
    <div id="cSingleColumnArticles">
        <article class='bSingleColumnArticle'>
            <div class='eContentText'>
                <h4>Contact</h4>
                <h3>Fill in the form below to send me an email.</h3>
                <?php if (isset($this->errorMail)) { echo "<h2>" . $this->errorMail . "</h2>"; } else if (isset($this->successMail)) { echo '<h2 class="resultSuccess">' . $this->successMail . '</h2>'; }?>
                <form id="eFormContact" action="contact" method="post" enctype="multipart/form-data">
                    <label>Your Name:</label> *<br />
                    <input class="form-input-field" type="text" value="<?php if(isset($this->formName)){ echo $this->formName; }  ?>" name="form_name" size="40"/><br /><br />

                    <label>Your Email:</label> *<br />
                    <input class="form-input-field" type="text" value="<?php if(isset($this->formEmail)){ echo $this->formEmail; }  ?>" name="form_email" size="40"/><br /><br />

                    <label>Message:</label> *<br />
                    <textarea class="form-input-field" name="form_msg" rows="8" cols="38"><?php if(isset($this->formMsg)){ echo $this->formMsg; }  ?></textarea><br /><br />

                    <div style="display: none;">
                        <label>Spam Protection: Please don't fill this in</label>
                        <textarea name="comment" rows="1" cols="1"></textarea>
                    </div>

                    <input type="hidden" name="form_token" value="<?php //echo ("security_token");  ?>" />
                    <input class="eButtonForm" type="reset" name="resetButton" value="Reset" />
                    <input class="eButtonForm" type="submit" name="submitButton" value="Submit" />
                </form>
            </div>
        </article>
    </div>
</section>