<!-- Contact Form -->
<section id="contact">
    <div class="col-lg-8">
        <div class="form-wrap">
            <h1>Contact Us</h1>
            <?php 
                if(isset($_POST['submit_contact'])) {

                    $to = "dlacroix101@gmail.com";
                    $email = $_POST['email'];
                    $subject = wordwrap($_POST['subject'], 70);
                    $message = wordwrap($_POST['message'], 70);

                    if(!empty($email) && !empty($subject) && !empty($message)) {

                        // $headers = "MIME-Version: 1.0" . "\r\n";
                        // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                        // $headers .= "From: " . $email . "\r\n";
                        $headers = "From: " . $email;
                        
                        mail($to, $subject, $message, $headers);

                        echo "<p class='bg-success'> Your message is on its way! </p>";

                    } else {

                        echo "<p class='bg-danger'> Fields cannot be empty </p>";
                    }
                }
            ?>
            <form role="form" action="" method="post" id="login-form" autocomplete="off">
                <div class="form-group">
                    <label for="email" class="sr-only"> Email </label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email">
                </div>
                    <div class="form-group">
                    <label for="subject" class="sr-only"> Subject </label>
                    <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter your subject">
                </div>
                <div class="form-group">
                    <label for="message" class="sr-only"> Subject </label>
                    <textarea name="message" id="message" class="form-control" placeholder="Type your message" rows="10"></textarea>
                </div>
                <input type="submit" name="submit_contact" id="btn-contact" class="btn btn-primary btn-lg btn-block" value="Send">
            </form>
        </div> <!-- /.form-wrap -->
    </div> <!-- /.col-xs-12 -->
</section>
