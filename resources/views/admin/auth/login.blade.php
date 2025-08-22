<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Login - InventoryPro</title>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
/* Full page gradient background */
body {
    height: 100vh;
    margin: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    background: linear-gradient(-45deg, #6f42c1, #20c997, #ff6b6b, #ffc107);
    background-size: 400% 400%;
    animation: gradientBG 15s ease infinite;
    font-family: 'Segoe UI', sans-serif;
}

/* Gradient animation */
@keyframes gradientBG {
    0% {background-position: 0% 50%;}
    50% {background-position: 100% 50%;}
    100% {background-position: 0% 50%;}
}

/* Glassmorphism login card */
.login-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    border-radius: 20px;
    padding: 40px 30px;
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    border: 1px solid rgba(255,255,255,0.2);
    width: 100%;
    max-width: 400px;
    color: #fff;
    transition: 0.3s;
}

/* Card hover effect */
.login-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 40px rgba(0,0,0,0.4);
}

/* Card header */
.login-card h2 {
    text-align: center;
    margin-bottom: 30px;
    font-weight: 700;
}

/* Input fields */
.login-card .form-control {
    background: rgba(255,255,255,0.2);
    border: none;
    border-radius: 10px;
    color: #fff;
    padding: 12px 15px;
    margin-bottom: 20px;
    transition: 0.3s;
}
.login-card .form-control:focus {
    background: rgba(255,255,255,0.3);
    box-shadow: 0 0 10px rgba(255,255,255,0.4);
    color: #fff;
    outline: none;
}

/* Login button */
.login-card .btn-login {
    background: linear-gradient(135deg, #6f42c1, #20c997);
    border: none;
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    transition: 0.3s;
}
.login-card .btn-login:hover {
    background: linear-gradient(135deg, #20c997, #6f42c1);
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* Forgot password link */
.login-card .forgot-pass {
    display: block;
    text-align: right;
    margin-top: -10px;
    margin-bottom: 20px;
    color: #fff;
    font-size: 0.9rem;
    text-decoration: none;
}
.login-card .forgot-pass:hover {
    text-decoration: underline;
    color: #ffc107;
}

/* Social icons */
.social-login {
    display: flex;
    justify-content: center;
    gap: 15px;
}
.social-login i {
    font-size: 1.5rem;
    cursor: pointer;
    transition: 0.3s;
}
.social-login i:hover {
    color: #ffc107;
    transform: scale(1.2);
}

/* Responsive */
@media(max-width: 500px){
    .login-card { padding: 30px 20px; }
}
</style>
</head>
<body>

<div class="login-card">
    <h2>Admin Login</h2>
    <form id="loginForm">
        <input type="email" class="form-control" placeholder="Email" required>
        <input type="password" class="form-control" placeholder="Password" required>
        <a href="#" class="forgot-pass">Forgot Password?</a>
        <button type="submit" class="btn btn-login">Login</button>
    </form>

    <div class="text-center mt-4">
        <p>Or login with</p>
        <div class="social-login">
            <i class="bi bi-google"></i>
            <i class="bi bi-facebook"></i>
            <i class="bi bi-github"></i>
        </div>
    </div>
</div>

<script>
// Simple form submission simulation
document.getElementById('loginForm').addEventListener('submit', function(e){
    e.preventDefault();
    alert("Login Submitted!");
});
</script>

</body>
</html>
