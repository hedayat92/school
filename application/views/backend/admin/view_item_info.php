<?php 
	$edit_data = $this->db->get_where('item' , array('item_id' => $param2))->result_array();
	foreach ($edit_data as $row):
?>

<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-print"></i>&nbsp;&nbsp;<?php echo get_phrase('view_item');?>
            </div>


            <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body table-responsive">

                    <div id="invoice_print">
                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('item_name');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name"
                                    value="<?php echo $this->db->get_where('supplier' , array('supplier_id' => $row['supplier_id']))->row()->name; ?>"
                                    readonly="true">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('item_name');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="name" value="<?php echo $row ['name']; ?>"
                                    readonly="true">

                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('quantity');?></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="quantity"
                                    value="<?php echo $row ['quantity']; ?>" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"
                                for="example-text"><?php echo get_phrase('purchase_price');?></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="purchase_price"
                                    value="<?php echo $row ['purchase_price']; ?>" readonly="true">
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('sales_price');?></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="sales_price"
                                    value="<?php echo $row ['sales_price']; ?>" readonly="true">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('date_added');?></label>
                            <div class="col-sm-12">
                                <input class="form-control m-r-10" name="date" type="date"
                                    value="<?php echo date('Y-m-d');?>" id="example-date-input" readonly="true">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-12"
                                for="example-text"><?php echo get_phrase('alert_quantity');?></label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" name="alert_quantity"
                                    value="<?php echo $row ['alert_quantity']; ?>" readonly="true">
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
                            <div class="col-sm-12">
                                <textarea rows="5" class="form-control" name="description"
                                    readonly="true"><?php echo $row ['description']; ?></textarea>
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