<div class="check-available-dates">
    <div class="wrapper">
        <div>
            <div class="form-group-container">
                <?php
                    if($notVerified){
                ?>
                 <button onclick="checkIfAccountIsVerified()" class="submit-btn">Check Available Dates</button>
                <?php
                    }else{
                ?>
                <button id="check-dates-btn" class="submit-btn">Check Available Dates</button>
                <?php
                    }
                ?>
            </div>
        </div>
    </div>
</div>