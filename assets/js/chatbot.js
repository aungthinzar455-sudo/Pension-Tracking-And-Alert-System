const chatBox = document.getElementById("chat-box");
const input = document.getElementById("user-input");
const typing = document.getElementById("typing-indicator");

/* SEND MESSAGE */
function sendMessage() {
    const msg = input.value.trim();
    if (msg === "") return;

    addMessage(msg, "user");
    input.value = "";

    typing.style.display = "block";

    setTimeout(() => {
        typing.style.display = "none";
        const reply = getBotReply(msg);
        addMessage(reply, "bot");
    }, 1200);
}

/* QUICK BUTTON */
function quickAsk(text) {
    input.value = text;
    sendMessage();
}

/* ADD MESSAGE */
function addMessage(message, sender) {
    const row = document.createElement("div");
    row.className = "chat-row " + sender;

    const bubble = document.createElement("div");
    bubble.className = sender === "user" ? "user-message" : "bot-message";
    bubble.innerHTML = message;

    row.appendChild(bubble);
    chatBox.appendChild(row);
    chatBox.scrollTop = chatBox.scrollHeight;
}

/* BOT LOGIC */
function getBotReply(message) {
    const msg = message.toLowerCase();

    if (msg.includes("apply"))
        return "📄 You can apply for pension from Dashboard → Apply for Pension.";

    if (msg.includes("status"))
        return "📊 Check your application status from Dashboard → My Application Status.";

    if (msg.includes("login"))
        return "🔐 Login using email & password. OTP verification is required.";

    if (msg.includes("otp"))
        return "📧 OTP is sent to your registered email for security.";

    if (msg.includes("complaint"))
        return "📝 Raise a complaint from Dashboard → Raise Complaint.";

    if (msg.includes("certificate"))
        return "📤 Upload Life Certificate yearly to avoid pension suspension.";

    if (msg.includes("amount"))
        return "💰 Pension amount depends on type and admin approval.";

    return "❓ Sorry, I didn’t understand that. Try asking about pension, login, OTP, complaint or certificate.";
}
