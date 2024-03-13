const labels = document.querySelectorAll('.form-control label')

labels.forEach(label => {
    label.innerHTML = label.innerText
        .split('')
        .map((letter, idx) => `<span style="transition-delay:${idx * 50}ms;">${letter}</span>`)
        .join('')
})

document.getElementById("loginForm").addEventListener("submit", function (event) {

    event.preventDefault();

    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if(username === "admin@admin.com" && password === "admin") {
        window.location.href = "pages/dashboard.html";
    }
    else{
        alert("Incorrect username or password. Try again.");
    }
})