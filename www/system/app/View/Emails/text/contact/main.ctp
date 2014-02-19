ユーザーからのお問合せを受け付けました。
<?php if(!empty($client_name)): ?>
<クライアント名> <?php echo $client_name. "\n"; ?>
<?php endif; ?>
<?php if(!empty($user_name)): ?>
<ユーザー名> <?php echo $user_name. "\n"; ?>
<?php endif; ?>
<氏名> <?php echo $name. "\n"; ?>
<メールアドレス> <?php echo $email. "\n"; ?>
<お問合せ種別> <?php echo $type. "\n"; ?>
<お問合せ内容>
<?php echo $message. "\n"; ?>