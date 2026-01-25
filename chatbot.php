<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Help Assistant</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <script src="assets/js/chatbot.js" defer></script>
</head>
<body>

<div class="dashboard-page">
<div class="form-box chatbot-box">

    <h2>💬 Pension Help Assistant</h2>

    <!-- CHAT AREA -->
    <div id="chat-box" class="chat-box">
        <div class="chat-row bot">
            <div class="bot-message">
                Hello 👋<br>
                I’m your pension assistant.<br>
                Ask me about pension, login, OTP, complaints or certificates.
            </div>
        </div>
    </div>

    <!-- TYPING INDICATOR -->
    <div id="typing-indicator" class="typing-indicator">
        Bot is typing<span>.</span><span>.</span><span>.</span>
    </div>

    <!-- QUICK BUTTONS -->
    <div class="quick-buttons">
        <button type="button" onclick="quickAsk('How to apply pension')">Apply Pension</button>
        <button type="button" onclick="quickAsk('Check status')">Check Status</button>
        <button type="button" onclick="quickAsk('Raise complaint')">Complaint</button>
        <button type="button" onclick="quickAsk('Life certificate')">Life Certificate</button>
    </div>

    <!-- INPUT -->
    <div class="chat-input">
        <input type="text" id="user-input" placeholder="Type your message...">
        <button type="button" onclick="sendMessage()">➤</button>
    </div>

</div>
</div>

</body>
</html>
