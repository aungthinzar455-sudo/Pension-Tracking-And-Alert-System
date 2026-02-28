/* ===== ADD MESSAGE FUNCTION ===== */

function addMessage(text, sender="bot") {

    const chatBox = document.getElementById("chat-box");

    const msg = document.createElement("div");
    msg.className = "message " + sender;

    const avatar = document.createElement("div");
    avatar.className = "avatar";
    avatar.innerText = sender === "bot" ? "🤖" : "👤";

    const bubble = document.createElement("div");
    bubble.className = "bubble";
    bubble.innerHTML = text;

    /* ===== TIME ===== */
    const time = document.createElement("div");
    time.style.fontSize = "11px";
    time.style.marginTop = "4px";
    time.style.opacity = "0.6";
    time.innerText = new Date().toLocaleTimeString([], {hour:'2-digit', minute:'2-digit'});

    bubble.appendChild(time);

    /* ===== ORDER FIX ===== */
    if(sender === "user"){
        msg.appendChild(bubble);
        msg.appendChild(avatar);
    }else{
        msg.appendChild(avatar);
        msg.appendChild(bubble);
    }

    chatBox.appendChild(msg);
    chatBox.scrollTop = chatBox.scrollHeight;
}


/* ===== SEND MESSAGE ===== */

function sendMessage() {

    const input = document.getElementById("user-input");
    const text = input.value.trim();

    if(!text) return;

    addMessage(text,"user");
    input.value = "";

    showTyping();

    setTimeout(()=>{

        const reply = getBotReply(text.toLowerCase());
        hideTyping();
        addMessage(reply,"bot");

    },1000);
}


/* ===== QUICK BUTTON ===== */

function quickAsk(q){
    document.getElementById("user-input").value = q;
    sendMessage();
}


/* ===== TYPING ===== */

function showTyping(){
    const el = document.getElementById("typing-indicator");
    if(el) el.style.display = "block";
}

function hideTyping(){
    const el = document.getElementById("typing-indicator");
    if(el) el.style.display = "none";
}


/* ===== ENTER KEY SEND ===== */

document.addEventListener("DOMContentLoaded", function(){
    const input = document.getElementById("user-input");

    if(input){
        input.addEventListener("keypress", function(e){
            if(e.key === "Enter"){
                sendMessage();
            }
        });
    }
});


/* ===== REALISTIC RESPONSES ===== */

function getBotReply(msg){

    if(msg.includes("apply"))
        return "📝 You can apply for pension from <b>Dashboard → Apply for Pension</b>. Upload required documents and submit.";

    if(msg.includes("status"))
        return "📊 Check your application status from <b>Dashboard → My Application Status</b>. It shows approval progress.";

    if(msg.includes("complaint"))
        return "📩 To raise a complaint, go to <b>Dashboard → Raise Complaint</b>. Our team responds within 24–48 hours.";

    if(msg.includes("life"))
        return "📄 Upload Life Certificate yearly from <b>Dashboard → Upload Life Certificate</b> to avoid payment interruption.";

    if(msg.includes("otp"))
        return "🔐 OTP is sent to your registered email. If not received, click Resend OTP or check spam.";

    if(msg.includes("login"))
        return "🔑 Ensure email & password are correct. Use Forgot Password if needed.";

    if(msg.includes("hello") || msg.includes("hi"))
        return "Hello 😊 How can I assist you with pension services today?";

    return "🤖 I can help with pension application, status, complaints, certificates, login issues and OTP.";
}
