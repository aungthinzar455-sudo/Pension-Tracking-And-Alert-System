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
</head>
<body>

<div class="chatbot-page">

    <div class="chatbot-container">

        <div class="chatbot-header">
            💬 Pension Help Assistant
        </div>

        <div id="chat-box" class="chat-box">

            <div class="message bot">
                <div class="avatar">🤖</div>
                <div class="bubble">
                    Hello 👋 I’m your Pension Assistant.<br>
                    How can I help you today?
                </div>
            </div>

        </div>

        <div class="quick-buttons">
            <button type="button" onclick="quickAsk('apply pension')">Apply Pension</button>
            <button type="button" onclick="quickAsk('status')">Check Status</button>
            <button type="button" onclick="quickAsk('complaint')">Complaint</button>
            <button type="button" onclick="quickAsk('life certificate')">Life Certificate</button>
        </div>

        <div class="chat-input">
            <input type="text" id="user-input" placeholder="Type your message...">
            <button type="button" onclick="sendMessage()">Send</button>
        </div>

        <div id="typing-indicator" style="display:none;padding:10px;color:#64748b;">
            Bot is typing...
        </div>

    </div>

</div>

<script src="assets/js/chatbot.js"></script>

</body>
</html>
