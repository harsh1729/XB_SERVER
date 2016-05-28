<html>
  <head>
 
  </head>
  <body onload="submitPayuForm()">
    
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $key ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
     
        <tr>
          
          <td><input type="hidden" name="amount" value="<?php echo $amount ?>" /></td>
          
          <td><input type="hidden" name="firstname" id="firstname" value="<?php echo $firstname ?>" /></td>
        </tr>
        <tr>
          
          <td><input type="hidden" name="email" id="email" value="<?php echo $email ?>" /></td>
          
          <td><input type="hidden" name="phone" value="<?php echo $phone ?>" /></td>
        </tr>
        <tr>
          
          <td colspan="3"><input type="hidden"  name="productinfo" value="<?php echo $product_info ?>"></td>
        </tr>
        <tr>
          
          <td colspan="3"><input type="hidden" name="surl" value="<?php echo $surl ?>" size="64" /></td>
        </tr>
        <tr>
          
          <td colspan="3"><input type="hidden" name="furl" value="<?php echo $furl ?>" size="64" /></td>
        </tr>

        <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="<?php echo $service_provider ?>" size="64" /></td>
        </tr>

      </table>
    </form>

    <script>
    
    function submitPayuForm() {
      
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  </body>
</html>