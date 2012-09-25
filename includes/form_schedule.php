<form action="pdf.php" method="post"  target="_blank">
          <p>
            <label for="message"></label>
            <input type="hidden" value="<?php echo date('d-m-y', $date); ?>" name="date1"/>
            <input type="hidden" value="<?php echo date('d-m-y', $date2);?>" name="date2"/>
            <input type="hidden" value="<?php echo date('d-m-y', $date3); ?>" name="date3"/>
            <input type="hidden" value="<?php echo date('d-m-y', $date4); ?>" name="date4"/>
          </p>
          <p>
            <input type="submit" value="Download schedule as a PDF" class="text_button notbut">
          </p>
        </form>
        
                <form action="addEmail.php" method="post"  target="_blank">
          <p>
          <div>If you would like to recieve email reminders of your schedule, please submit your email address:</div>
            <label for="message"></label>
            <input type="text" value="" name="email" placeholder="name@mail.com" class="acinput">
            <input type="hidden" value="<?php echo date('d-m-y', $date); ?>" name="date1"/>
            <input type="hidden" value="<?php echo date('d-m-y', $date2);?>" name="date2"/>
            <input type="hidden" value="<?php echo date('d-m-y', $date3); ?>" name="date3"/>
            <input type="hidden" value="<?php echo date('d-m-y', $date4); ?>" name="date4"/>
        <input type="hidden" value="<?php echo date('d-m-y', $date5); ?>" name="date5"/>
          
            <input type="submit" value="Please send me email reminders" class="text_button notbut notbutb">
          </p>
          <div class="newbut"><a href="test.php">Create another schedule</a></div>
        </form>
        </div>