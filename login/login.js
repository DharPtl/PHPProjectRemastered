const onSubmit = (event, form) => {
    event.preventDefault();
    const data = new FormData(form);
    const xhr = new XMLHttpRequest();

    xhr.open("POST", "login.php"); 
    xhr.onload = () => onResultReturned(xhr);
    xhr.send(data);
};


const onResultReturned = (xhr) => {
    const errorDiv = document.getElementById("error-message");
    if (xhr.status !== 200) {
        errorDiv.innerHTML = "<h3 style='color: red;'>Connection failed!</h3>";
        return;
    }

    //print error message saying the login failed
    console.log(xhr.responseText);
    if (xhr.responseText === "Login failed") {
        errorDiv.innerHTML = "<h3 style='color: red;'>Login failed!</h3>";
        return;
    }

    // Reload the current page after successful login
    location.reload();
};

document.addEventListener("DOMContentLoaded", () => {
    const loginForm = document.getElementById("login-form");
    loginForm.addEventListener("submit", (event) => onSubmit(event, loginForm));
});