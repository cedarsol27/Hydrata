<?php
    echo '
    <div id="bRem">Alerts and Reminders</div>';
    include 'cal-sum.php';
    echo '
    <div class="div-spacing"></div>
    <div class="openBtn">
        <button class="openButton" onclick="openForm()"><strong>Add Reminder</strong></button>
    </div>

    <div class="eventPopup">
        <div class="formPopup" id="popupForm">
            <form method="GET" action="create-reminder.php" class="formContainer">
                <h3>Create New Reminder</h3>
                <label for="date" style="text-align: center;"><strong>Select Date: </strong></label>
                <input type="date" id="available_dates" name="rmdrDate" style="text-align: center;">
                <label for="summary" style="text-align: center;"><Strong>Reminder: </strong></label>
                <input type="text" id="summary" name="summary">
                <label for="description" style="text-align: center;"><Strong>Details: </strong></label>
                <input type="text" id="desc" name="desc">
                <button type="submit" id="submit" class="btnRmdr">Add Reminder</button>
                <button type="button" class="btnRmdr cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
    </div>';