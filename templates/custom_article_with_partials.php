<article>

<?php echo $doc->get('partial1'); ?>

<?php echo $doc->get('partial2'); ?>

<?php if(isset($doc->metadata['Date'][1]) && $doc->metadata['Keywords'][1]  ): ?>
<aside>
Published <?php echo $doc->metadata['Date'][1] ?> tagged with <?php echo $doc->metadata['Keywords'][1] ?>
</aside>
<?php endif; ?>


</article>

