<h2>Verify Your Account</h2>
<p>We sent a verification code to your email. Please enter the code below:</p>

<form method="post" action="<?= site_url('auth/verify_code') ?>">
    <input type="number" name="verification_code" placeholder="Enter verification code" required />
    <button type="submit">Verify</button>
</form>
