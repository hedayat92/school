
<div class="row">
    <div class="col-md-12">

        <!------CONTROL TABS START------>
        <ul class="nav nav-tabs bordered">
            <li class="active">
                <a href="#list" data-toggle="tab"><i class="entypo-menu"></i> 
                    <?php echo get_phrase('manage_payroll'); ?>
                </a></li>
        </ul>
        <!------CONTROL TABS END------>


        <!----TABLE LISTING STARTS-->
        <div class="tab-pane" id="list">
            <center>
                <?php echo form_open(base_url() . 'hrm/employee/get_types'); ?>
                <table border="0" cellspacing="0" cellpadding="0" class="table table-bordered">
                    <tr>
                        <td><?php echo get_phrase('select_department'); ?></td>
                        <td><?php echo get_phrase('select_employee'); ?></td>
                        <td class="month_show"><?php echo get_phrase('month'); ?></td>
                        <td class="year_show"><?php echo get_phrase('year'); ?></td>

                    </tr>
                    <tr>
                        <td>
                            <div class="form-group">
                                <div class="col-sm-8">
                                    <select name="department_id" class="form-control" onchange="show_employee(this.value);" id="department_id">
                                        <option value=""><?php echo get_phrase('select_department'); ?></option>
                                        <?php
                                        $employee =  $this->db->get('department')->result_array();
                                        foreach ($employee as $row2):
                                            ?>
                                            <option value="<?php echo $row2['department_id'] ?>"><?php echo $row2['name']; ?></option>   
                                            <?php
                                        endforeach;
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </td>

                        <td>

                            <div class="form-group" id="employee_holder">
                                <div class="col-sm-8">
                                    <select name="teacher_id" class="form-control "  onchange="show()">
                                        <option value=""><?php echo get_phrase('select_department_first') ?></option>   
                                    </select>
                                </div>
                            </div>

                        </td>
                        <td class="month_show">

                            <select name="month" class="form-control" id="month" onchange="show_year()">
                                <?php
                                for ($i = 1; $i <= 12; $i++):
                                    if ($i == 1)
                                        $m = 'january';
                                    else if ($i == 2)
                                        $m = 'february';
                                    else if ($i == 3)
                                        $m = 'march';
                                    else if ($i == 4)
                                        $m = 'april';
                                    else if ($i == 5)
                                        $m = 'may';
                                    else if ($i == 6)
                                        $m = 'june';
                                    else if ($i == 7)
                                        $m = 'july';
                                    else if ($i == 8)
                                        $m = 'august';
                                    else if ($i == 9)
                                        $m = 'september';
                                    else if ($i == 10)
                                        $m = 'october';
                                    else if ($i == 11)
                                        $m = 'november';
                                    else if ($i == 12)
                                        $m = 'december';
                                    ?>
                                    <option value="<?php echo $i; ?>"
                                            >
                                                <?php echo $m; ?>
                                    </option>
                                    <?php
                                endfor;
                                ?>
                            </select>

                        </td>
                        <td class="year_show">

                            <select name="year" class="form-control" id="year" onchange="show_panels()">
                                <?php for ($i = 2020; $i >= 2010; $i--): ?>
                                    <option value="<?php echo $i; ?>"
                                            >
                                                <?php echo $i; ?>
                                    </option>
                                <?php endfor; ?>
                            </select>

                        </td>

                    </tr>
                </table>
                <div class="row allowence_panel">
                    <!---Allowence-->
                    <div class="col-md-6">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title" >
                                    <i class="entypo-plus-circled"></i>
                                    <?php echo get_phrase('allowences'); ?>
                                </div>
                            </div>
                            <div class="panel-body ">
                                <div id="allowence_body">
                                    <div class="form-group">

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="type[]" value="" placeholder="type"  id="type">
                                        </div> 

                                    </div>
                                    <div class="form-group ">

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="amount[]" value="" placeholder="amount"  id="amount">
                                        </div> 

                                    </div>
                                </div>
                                <div id="allowence_body_appened"></div>
                                <br><br>
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-info btn-sm" onclick="append_allowence()">
                                            <i class="entypo-plus"></i> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!---Deduction--->
                    <div class="col-md-6">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title" >
                                    <i class="entypo-plus-circled"></i>
                                    <?php echo get_phrase('deduction'); ?>
                                </div>
                            </div>
                            <div class="panel-body ">
                                <div id="deduction_body">
                                    <div class="form-group">

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="type[]" value="" placeholder="type"  id="type">
                                        </div> 

                                    </div>
                                    <div class="form-group ">

                                        <div class="col-sm-6">
                                            <input type="text" class="form-control" name="amount[]" value="" placeholder="amount"  id="amount">
                                        </div> 

                                    </div>
                                </div>
                                <div id="deduction_body_appened"></div>
                                <br><br>
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-3">
                                        <button type="button" class="btn btn-info btn-sm" onclick="append_deduction()">
                                            <i class="entypo-plus"></i> 
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!----SUMMARY---->

                    <div class="col-md-offset-1 col-md-10 col-md-offset-1">
                        <div class="panel panel-primary" data-collapsed="0">
                            <div class="panel-heading">
                                <div class="panel-title" >
                                    <i class="entypo-plus-circled"></i>
                                    <?php echo get_phrase('summary'); ?>
                                </div>
                            </div>
                            <div class="panel-body ">

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('basic'); ?></label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="basic"   value="" readonly>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_allowence'); ?></label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="alowence"   value="" >
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('total_deduction'); ?></label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="deduction"   value="" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="field-1" class="col-sm-3 control-label"><?php echo get_phrase('net_salary'); ?></label>

                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="salary"   value="" >
                                    </div>
                                </div>
                                <br>

                                <div class="form-group">
                                        <button type="submit" class="btn btn-rounded btn-sm btn-block btn-info"><?php echo get_phrase('create_payment'); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
        <?php echo form_close(); ?>
        </center>

    </div>
</div>
</div>
<script type="text/javascript">
    blank_allowence_body = $('#allowence_body').html();
    blank_deduction_body = $('#deduction_body').html();
    $(".year_show").hide();
    $(".allowence_panel").hide();
    $(document).ready(function () {

        // SelectBoxIt Dropdown replacement
        if ($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function (i, el)
            {
                var $this = $(el),
                        opts = {
                            showFirstOption: attrDefault($this, 'first-option', true),
                            'native': attrDefault($this, 'native', false),
                            defaultText: attrDefault($this, 'text', ''),
                        };

                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }

    });

</script>
<script type="text/javascript">
    function show_employee(department_id) {

        $.ajax({
            url: '<?php echo base_url(); ?>admin/get_employee/' + department_id,
            success: function (response)
            {

                jQuery('#employee_holder').html(response);
            }
        });
    }
</script>
<script type="text/javascript">
    function show_year() {
        $(".year_show").show();
    }
    function show_panels() {
        $(".allowence_panel").show();
    }
    function append_allowence()
    {
        $('#allowence_body_appened').append(blank_allowence_body);
    }
    function append_deduction()
    {
        $('#deduction_body_appened').append(blank_deduction_body);
    }
    
</script>
