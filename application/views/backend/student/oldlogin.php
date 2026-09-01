<style>
@import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

:root {
  --primary-color: #f5826e;  
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Roboto', sans-serif;
  letter-spacing: 0.5px;
}

body {
  background-color: var(--primary-color);
}

.invoice-card {
  display: flex;
  flex-direction: column;
  position: absolute;
  padding: 10px 2em;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  min-height: 22em;
  width: 26em;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0px 10px 30px 5px rgba(0, 0, 0, 0.15);
}

.invoice-card > div {
  margin: 5px 0;
}

.invoice-title {
  flex: 3;
}

.invoice-title #date {
  display: block;
  margin: 8px 0;
  font-size: 12px;
  
  
}

.invoice-title #main-title {
  display: flex;
  justify-content: space-between;
  margin-top: 1em;
}

.invoice-title #main-title h4 {
  letter-spacing: 2.5px;
}

.invoice-title span {
  color: rgba(0, 0, 0, 0.4);
}

.invoice-details {
  flex: 1;
  border-top: 0.5px dashed grey;
  border-bottom: 0.5px dashed grey;
  display: flex;
  align-items: center;
}

.invoice-table {
  width: 100%;
  border-collapse: collapse;
}

.invoice-table thead tr td {
  font-size: 12px;
  letter-spacing: 1px;
  color: grey;
  padding: 8px 0;
}

.invoice-table thead tr td:nth-last-child(1),
.row-data td:nth-last-child(1),
.calc-row td:nth-last-child(1)
{
  text-align: right;
}

.invoice-table tbody tr td {
    padding: 8px 0;
    letter-spacing: 0;
}

.invoice-table .row-data #unit {
  text-align: center;
}

.invoice-table .row-data span {
  font-size: 13px;
  color: rgba(0, 0, 0, 0.6);
}

.invoice-footer {
  flex: 1;
  display: flex;
  justify-content: flex-end;
  align-items: center;
}

.invoice-footer #later {
  margin-right: 5px;
}

.btn {
  border: none;
  padding: 5px 0px;
  background: none;
  cursor: pointer;
  letter-spacing: 1px;
  outline: none;
}

.btn.btn-secondary {
  color: rgba(0, 0, 0, 0.3);
}

.btn.btn-primary {
  color: var(--primary-color);
}

.btn#later {
  margin-right: 2em;
}


</style>
<div class="invoice-card">
  <div class="invoice-title">
    <div id="main-title">
      <h5>INVOICE FOR ANNUAL MAINTENANCE RENEWAL FEE</h5>
    </div>
    <span id="date"><p align="justify">Thanks for using our software. Inline with our License Agreement <a href="https://optimumlinkupsoftware.com/license agreement">Here</a> that software will be renewed annually for the maintenace of the software. You software expires today <strong><?= date('Y-m-d');?>.</strong>  </p><p align="justify">Upon successfully payment, your software will be activated successfully and you can start enjoying the software as usual.</p><p align="justify" style="color:red">NB: Removing, Deleting or Altering this information renders the sofware ILLEGAL</p></span>
	
  </div>
  
  <div class="invoice-details">
    <table class="invoice-table">
      <thead>
        <tr>
          <td>PRODUCT</td>
          <td>UNIT</td>
          <td>PRICE</td>
        </tr>
      </thead>
      
      <tbody>
        <tr class="row-data">
          <td>School Management System</td>
          <td id="unit">1</td>
          <td>$10</td>
        </tr>
        
        
      </tbody>
    </table>
  </div>
  
  <div class="invoice-footer">
  <form action="<?=base_url();?>payment/renew/paystack" method="post" enctype="multipart/form-data">
  	<input type="hidden" name="amount" value="10">
    	<button type="submit" class="btn btn- btn-primary"><strong>PAY NOW</strong></button>
  </form>
  </div>
</div>
	<script type="text/javascript">
		var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
		(function(){
		var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
		s1.async=true;
		s1.src='https://embed.tawk.to/588e0fa6af9fa11e7aa44047/default';
		s1.charset='UTF-8';
		s1.setAttribute('crossorigin','*');
		s0.parentNode.insertBefore(s1,s0);
		})();
	</script>