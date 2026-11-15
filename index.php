<?php
include 'connection.php';

// جلب البيانات 
$result_info = $conn->query("SELECT * FROM personal_info LIMIT 1");
$user = $result_info->fetch_assoc();

// جلب  skills
$user_id = $user['id'] ?? 1;
$result_skills = $conn->query("SELECT * FROM skills WHERE personal_id = $user_id");
?>






<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($user['full_name']); ?> | Software Engineer</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>



<div class="container">




    <!-- زر تبديل المظهر -->
    <button class="theme-toggle" id="themeToggleBtn" title="تغيير المظهر">
        <i class="fas fa-moon" id="themeIcon"></i>
    </button>


       <!--الصوره الشخصيه-->
    <header class="profile-header">

        <div class="profile-img-container">
            <img src="profile.png" alt="صورة الشخصية">
        </div>


        <h1><?php echo htmlspecialchars($user['full_name']); ?></h1>
        <div class="typing-text">Software Engineering Student</div>

    </header>






    <!-- قسم  skills -->
    <section class="skills-section">

        <h2><i class="fas fa-code"></i> Technical Skills</h2>

        <ul class="skills-list">
            <?php while($skill = $result_skills->fetch_assoc()): ?>
                <li>
                    <span><?php echo htmlspecialchars($skill['skill_name']); ?></span>
                    <?php if (!empty($skill['skill_category'])): ?>
                        <small><?php echo htmlspecialchars($skill['skill_category']); ?></small>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>

    </section>






    <!-- قسم التواصل -->
    <section class="contact-section">
        <h2><i class="fas fa-address-card"></i> My information</h2>
        <div class="social-links">
            <a href="tel:<?php echo htmlspecialchars($user['phone']); ?>" class="btn call-btn">
                <i class="fas fa-phone-alt"></i> Call me
            </a>
            <button type="button" class="btn copy-btn" id="copyBtn" data-phone="<?php echo htmlspecialchars($user['phone']); ?>">
                <i class="fas fa-copy"></i> Copy my number
            </button>
            <a href="<?php echo htmlspecialchars($user['linkedin_url']); ?>" target="_blank" class="btn linkedin">
                <i class="fab fa-linkedin-in"></i> linkedin
            </a>
            <a href="<?php echo htmlspecialchars($user['github_url']); ?>" target="_blank" class="btn github">
                <i class="fab fa-github"></i> github
            </a>
        </div>
        <div id="copy-toast" class="toast">تم نسخ رقم الهاتف بنجاح!</div>
    </section>



</div>









<script>
    // تبديل الثيم(أسود أبيض)
    const themeToggleBtn = document.getElementById('themeToggleBtn');
    const themeIcon = document.getElementById('themeIcon');
    const htmlElement = document.documentElement;

    themeToggleBtn.addEventListener('click', () => {
        if (htmlElement.getAttribute('data-theme') === 'light') {
            htmlElement.removeAttribute('data-theme');
            themeIcon.classList.replace('fa-sun', 'fa-moon');
        } else {
            htmlElement.setAttribute('data-theme', 'light');
            themeIcon.classList.replace('fa-moon', 'fa-sun');
        }
    });





    // نسخ الرقم 
    const copyBtn = document.getElementById('copyBtn');
    const toast = document.getElementById('copy-toast');
    
    copyBtn.addEventListener('click', () => {
        const phone = copyBtn.getAttribute('data-phone');
        navigator.clipboard.writeText(phone).then(() => {
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        });
    });


    
</script>
</body>
</html>