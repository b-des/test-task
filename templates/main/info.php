<?php $message = $this->display('message', false) ?>
<?php if(!empty($message)): ?>
    <div class="alert alert-<?php echo $message['type'] ?> ">
        <strong><?php echo $message['title'] ?></strong> <?php echo $message['text'] ?>
    </div>
<?php endif; ?>

