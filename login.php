
<?php
session_start();

if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header('Location: index.html');
    exit;
}

$error = '';

function e($text) {
    return htmlspecialchars((string)$text, ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    // Akun demo tanpa database
    $akun = [
        'guru' => [
            'password' => 'pelangi123',
            'nama' => 'Bu Guru'
        ],
        'admin' => [
            'password' => 'admin123',
            'nama' => 'Administrator'
        ]
    ];

    if (
        isset($akun[$username]) &&
        hash_equals($akun[$username]['password'], $password)
    ) {
        session_regenerate_id(true);

        $_SESSION['login'] = true;
        $_SESSION['username'] = $username;
        $_SESSION['nama_pengguna'] = $akun[$username]['nama'];

        header('Location: index.html');
        exit;
    } else {
        $error = 'Username atau password belum tepat. Coba lagi, ya! 💗';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Pelangi Siswa 🌈</title>
<style>
@import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800;900&display=swap');

* { box-sizing:border-box; }
body {
    margin:0;
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:22px;
    font-family:'Nunito',sans-serif;
    color:#48415f;
    background:linear-gradient(135deg,#fff1f6,#f0eaff,#e8f7ff);
}
.login-wrapper {
    width:100%;
    max-width:900px;
    display:grid;
    grid-template-columns:1fr 1fr;
    background:white;
    border-radius:28px;
    overflow:hidden;
    box-shadow:0 20px 65px #7965a51c;
}
.illustration {
    padding:42px 35px;
    background:linear-gradient(145deg,#e7dcff,#ffdfec);
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    text-align:center;
    position:relative;
    overflow:hidden;
}
.illustration h1 {
    font-size:31px;
    line-height:1.25;
    margin:15px 0 10px;
    font-weight:900;
}
.illustration p {
    font-size:13px;
    color:#756b91;
    line-height:1.8;
    max-width:290px;
}
.mascot {
    font-size:100px;
    line-height:1.3;
    filter:drop-shadow(0 8px 8px #7664a51a);
}
.cloud {
    position:absolute;
    font-size:35px;
    opacity:.7;
}
.login-form {
    padding:45px 40px;
    display:flex;
    flex-direction:column;
    justify-content:center;
}
.logo {
    font-size:40px;
    margin-bottom:7px;
}
h2 {
    font-size:27px;
    margin:0 0 7px;
    font-weight:900;
}
.subtitle {
    font-size:13px;
    color:#9189a4;
    line-height:1.7;
    margin:0 0 25px;
}
label {
    display:block;
    font-size:12px;
    font-weight:900;
    margin:0 0 8px;
}
.input-wrap { margin-bottom:18px; }
.input-box { position:relative; }
.input-box span {
    position:absolute;
    left:14px;
    top:50%;
    transform:translateY(-50%);
    font-size:18px;
}
input {
    width:100%;
    border:1.5px solid #eee7f4;
    background:#fdfbff;
    border-radius:13px;
    padding:14px 14px 14px 44px;
    outline:none;
    font:inherit;
    font-size:13px;
    color:#48415f;
}
input:focus {
    border-color:#a78bfa;
    box-shadow:0 0 0 3px #a78bfa24;
}
button {
    width:100%;
    padding:14px;
    border:0;
    border-radius:13px;
    background:#8b6ce8;
    color:white;
    font:inherit;
    font-weight:900;
    cursor:pointer;
    box-shadow:0 6px 15px #8b6ce833;
    transition:.2s;
}
button:hover { background:#7956d8;transform:translateY(-2px); }
.error {
    background:#fff0f2;
    color:#b83c60;
    border-radius:12px;
    padding:12px;
    margin-bottom:17px;
    font-size:12px;
    font-weight:800;
    line-height:1.6;
}
.demo {
    background:#f5f0ff;
    border-radius:14px;
    padding:14px;
    margin-top:20px;
    font-size:12px;
    line-height:1.9;
}
.demo strong { color:#7956d8; }
.demo code {
    background:white;
    padding:3px 6px;
    border-radius:5px;
    color:#7956d8;
}
.footer {
    font-size:11px;
    color:#aaa2b6;
    text-align:center;
    margin-top:22px;
}
@media(max-width:650px) {
    .login-wrapper { max-width:410px;grid-template-columns:1fr; }
    .illustration { padding:22px 20px; }
    .mascot { font-size:65px; }
    .illustration h1 { font-size:23px;margin:6px 0; }
    .illustration p { margin:4px 0;font-size:12px; }
    .login-form { padding:28px 23px; }
    h2 { font-size:24px; }
}
</style>
</head>
<body>
<div class="login-wrapper">

    <section class="illustration">
        <span class="cloud" style="top:20px;left:20px">☁️</span>
        <span class="cloud" style="right:22px;top:40px">⭐</span>

        <div class="mascot">🦄📚</div>
        <h1>Belajar Jadi<br>Menyenangkan!</h1>
        <p>
            Selamat datang di Pelangi Siswa.
            Yuk, kelola data siswa dengan mudah,
            rapi, dan penuh warna! 🌈
        </p>

        <span class="cloud" style="bottom:20px;left:35px">🌸</span>
        <span class="cloud" style="bottom:18px;right:35px">💖</span>
    </section>

    <section class="login-form">
        <div class="logo">🌈</div>
        <h2>Hai, Sahabat!</h2>
        <p class="subtitle">
            Masuk dulu, yuk! Isi akunmu untuk melanjutkan.
        </p>

        <?php if ($error !== ''): ?>
            <div class="error"><?= e($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
            <div class="input-wrap">
                <label for="username">Username</label>
                <div class="input-box">
                    <span>👤</span>
                    <input
                        type="text"
                        id="username"
                        name="username"
                        placeholder="Masukkan username"
                        autocomplete="username"
                        required
                        value="<?= e($_POST['username'] ?? '') ?>"
                    >
                </div>
            </div>

            <div class="input-wrap">
                <label for="password">Password</label>
                <div class="input-box">
                    <span>🔒</span>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        autocomplete="current-password"
                        required
                    >
                </div>
            </div>

            <button type="submit">Masuk ke Dashboard ✨</button>
        </form>

        <div class="demo">
            <strong>🎀 Akun untuk demonstrasi</strong><br>
            Username: <code>guru</code><br>
            Password: <code>pelangi123</code>
            <hr style="border:0;border-top:1px solid #e5dcfa;margin:10px 0">
            <strong>🛠️ Akun administrator</strong><br>
            Username: <code>admin</code><br>
            Password: <code>admin123</code>
        </div>

        <div class="footer">
            🌷 Pelangi Siswa · Belajar dengan ceria 🌷
        </div>
    </section>

</div>
</body>
</html>
```