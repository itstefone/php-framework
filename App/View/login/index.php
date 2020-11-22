<?php

use itstefone\Form\Form;

 $form = Form::begin('post', '/login');
?>
  <div class="container">



  <?php echo $form->createField('email', $model, 'email'); ?>
  <?php echo $form->createField('password', $model, 'password'); ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
</div>