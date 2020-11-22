<?php

use itstefoneForm\Form;

 $form = Form::begin('post', '/register');
?>
  <div class="container">



  <?php echo $form->createField('email', $model, 'email'); ?>
  <?php echo $form->createField('password', $model, 'password'); ?>
  <?php echo $form->createField('confirmPassword', $model, 'password'); ?>
  <?php echo $form->createField('firstname', $model); ?>
  <?php echo $form->createField('lastname', $model); ?>
  


  <button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
</div>