// Countdown logic
let seconds = 30;
const countdownElement = document.getElementById('countdown');

function updateCountdown() {
    countdownElement.innerText = seconds;
    seconds--;

    if (seconds < 0) {
        // Enable resend button or trigger resend logic
        countdownElement.innerHTML = '<a href="#">Resend verification code</a>';
    } else {
        setTimeout(updateCountdown, 1000);
    }
}

updateCountdown();
