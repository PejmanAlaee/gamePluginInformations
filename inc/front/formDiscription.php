

 
 <?php $txt =  get_post_meta($w->ID,'_hmci_discription')  ?>

 <?php  if(!isset($txt[0]))  $txt[0] = "" ?>

<p>
  <label for="discriptionInput"></label>
  <textarea id="discriptionInput" name="discriptionInput" rows="4" cols="50"> <?php echo $txt[0] ?></textarea>
</p>
