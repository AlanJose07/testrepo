<div style="border:1px solid #990000;padding-left:20px;margin:0 0 10px 0;">

<h4><?= function_exists('msg_get_rnw') ? msg_get_rnw(A_PHP_ERROR_WAS_ENCOUNTERED_LBL) : 'A PHP Error was encountered' ?></h4>

<p>Severity: <?php echo $severity; ?></p>
<p>Message:  <?php echo $message; ?></p>
<p>Filename: <?php echo $filepath; ?></p>
<p>Line Number: <?php echo $line; ?></p>

</div>
