<?php 
	$edit_data = $this->db->get_where('supplier' , array('supplier_id' => $param2))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-link"></i>&nbsp;&nbsp;<?php echo get_phrase('view_supplier');?>
            </div>
            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">

                    <div id="invoice_print">
                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" value="<?php echo $row['name'];?>"
                                    readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('email');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="email" value="<?php echo $row['email'];?>"
                                    readonly="true">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('phone');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="phone" value="<?php echo $row['phone'];?>"
                                    readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('city');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="city" value="<?php echo $row['city'];?>"
                                    readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('state');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="state" value="<?php echo $row['state'];?>"
                                    readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('state');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="country"
                                    value="<?php echo $row['country'];?>" readonly="true">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
                            <div class="col-sm-12">
                                <textarea rows="5" name="address" class="form-control"
                                    readonly="true"><?php echo $row['address'];?></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('company_name');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="company_name"
                                    value="<?php echo $row['company_name'];?>" readonly="true">
                            </div>
                        </div>

                    </div>

                    <div class="form-group">
                        <button onClick="PrintElem('#invoice_print')"
                            class="btn btn-rounded btn-success btn-block btn-sm"><i
                                class="fa fa-print"></i>&nbsp;print</button>
                        <hr>
                    </div>
                </div>
            </div>
            <?php endforeach;?>



            <script type="text/javascript">
            // print invoice function
            function PrintElem(elem) {
                Popup($(elem).html());
            }

            function Popup(data) {
                var mywindow = window.open('', 'invoice', 'height=400,width=600');
                mywindow.document.write('<html><head><title>Invoice</title>');
                mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
                mywindow.document.write(
                    '<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />'
                    );
                mywindow.document.write('</head><body >');
                mywindow.document.write(data);
                mywindow.document.write('</body></html>');

                mywindow.print();
                mywindow.close();

                return true;
            }
            </script>