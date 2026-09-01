<!DOCTYPE html>
    <head>
        <title><?php echo get_settings('system_name');?></title>
		 <link rel="icon"  sizes="16x16" href="<?php echo base_url();?>uploads/logo.png">
        <meta charset="utf-8" />
		<link href="<?php echo base_url(); ?>optimum/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" >
		<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/bootstrap.css"/>
    	<link type="text/css" rel="stylesheet" href="https://source.zoom.us/1.7.7/css/react-select.css"/>

	
        <meta name="format-detection" content="telephone=no">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
		<meta name="description" content="A complete and most powerful school system management system for all. Purchase and enjoy">
		<meta content=" Optimum Linkup - Online Education & Learning Courses HTML CSS Responsive Template" name="description">
		<meta name="author" content="Optimum Linkup Computers">
		<meta name="keywords" content="multi school system, multi branch school, ofine school, super school, html rtl, html dir rtl, 
		rtl website template, bootstrap 4 rtl template, rtl bootstrap template, admin panel template rtl, admin panel rtl, html5 rtl, academy training course css template, 
		classes online training website templates, courses training html5 template design, education training rwd simple template, educational learning management jquery html, 
		elearning bootstrap education template, professional training center bootstrap html, institute coaching mobile responsive template, 
		marketplace html template premium, learning management system jquery html, clean online course teaching directory template, 
		online learning course management system, online course website template css html, premium lms training web template, training course responsive website"/>
	
    </head>
    <body>
        <style type="text/css">
      
            .navbar-inverse {
                background-color: #313131;
                border-color: #404142;
            }
            .navbar-header h4 {
                margin: 0;
                padding: 15px 15px;
                color: #c4c2c2;
            }
            .navbar-right h5 {
                margin: 0;
                padding: 9px 5px;
                color: #c4c2c2;
            }
            .navbar-inverse .navbar-collapse, .navbar-inverse .navbar-form{
                border-color: transparent;
            }
        </style>


                            <?php 
                            $select = $this->db->get_where('jitsi', array('jitsi_id' => $jitsi_id))->result_array();
                            foreach ($select as $key => $row):
							$user = explode('-', $row['user_id']);
							$user_type = $user[0];
							$user_id = $user[1];
							$HostName =  $this->db->get_where($user_type, array($user_type.'_id' => $user_id))->row();
                            $accountType = $this->session->userdata('login_type');
                            ?>  

        <nav id="nav-tool" class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <h4 style="color:white"><i class="fa fa-plus"></i> Meeting Title : <?=$row['title']?></h4>
                </div>
                <div class="navbar-form navbar-right">
                    <h5 style="color:white"> HOST BY : <img src="<?=$this->crud_model->get_image_url($user_type, $user_id)?>" HostImageclass="img-circle" height="30" width="30"/> <?=$HostName->name?> &nbsp;&nbsp;&nbsp;<a href="<?=base_url()?><?=$accountType.'/'.'jitsi'?>" style="color:white"> Back </a></h5>
                </div>
            </div>
        </nav>
		
		
		<div id="container" style="width:100%;height:100vh">

		
<script src="https://meet.jit.si/external_api.js"></script>
<script>
    var domain = "meet.jit.si";
    var options = {
        userInfo : { 
            email : '<?=$HostName->email;?>' , 
            displayName : '<?=$HostName->name;?>',
            moderator: true,
        },
        roomName: "<?php echo $row['room'];?>",
        width: "100%",
        height: "100%",
        parentNode: document.querySelector('#container'),
        configOverwrite: {},
        interfaceConfigOverwrite: {
            // filmStripOnly: true
        }
    }
    var api = new JitsiMeetExternalAPI(domain, options);
        api.executeCommand('subject', '<?php echo $row['title'];?>');
</script>
<?php endforeach;?>

		
    </body>
</html>

    