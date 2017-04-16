<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="language" content="en" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/css/bootstrap.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>/bootstrap/css/bootstrap-theme.min.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo base_url(); ?>/css/blog.css" type="text/css" />
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

		<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.1.11.1.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>/bootstrap/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>/js/imagelightbox.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>/js/jquery.form-validator.min.js"></script>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Shopping Cart</title>
<script>
function clear_cart() {
	var result = confirm('Are you sure want to clear all bookings?');
	
	if(result) {
		window.location = "<?php echo base_url(); ?>cart/remove/all";
	}else{
		return false; // cancel button
	}
}
</script>
</head>
	<style>
			/* CSS used here will be applied after bootstrap.css */
			body { 
				background: url('<?php echo base_url(); ?>PT/0003.jpg') no-repeat center center fixed; 
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
			}

			.panel-default {
				opacity: 0.9;
				margin-top:30px;
			}
			.form-group.last {
				margin-bottom:0px;
			}
			h1 {
				color: White;
				}
			h4 {
				color: White;
				}

			#imagelightbox
				{
					position: fixed;
					z-index: 9999;

					-ms-touch-action: none;
					touch-action: none;
				}



	</style>
<body>
	<nav class="navbar navbar-default navbar-inverse" role="navigation">
  <div class="container-fluid">
	<!-- Brand and toggle get grouped for better mobile display -->
	<div class="navbar-header">
	  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	  </button>
	  <a class="navbar-brand" href="<?php echo base_url(); ?>Product/Show">หน้าหลัก</a>
	</div>

	<!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	  <ul class="nav navbar-nav">
		<li><a href="<?php echo base_url(); ?>Product/Show">แพ็คเกจ</a></li>
		<li><a href="<?php echo base_url(); ?>cart">แพ็คเกจที่เลือก</a></li>
		<li><a href="<?php echo base_url(); ?>">วิธีซื้อ</a></li>
		<li><a href="<?php echo base_url(); ?>">เกี่ยวกับเรา</a></li>
		
	  </ul>
	  
	  <ul class="nav navbar-nav navbar-right">
		<li><p class="navbar-text">For Admin</p></li>
		<li class="dropdown">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
			
	  </ul>
	</div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<h1 align="center">Your Packet Tavel </h1>
<div class="panel panel-default">
	<div class="panel-heading">Your Packet</div>
	
<div style="margin:0px auto; width:1200px" >
	<div style="padding-bottom:10px">

		<button type="button" class="btn btn-default btn-lg">  
			
			<a href="<?php echo base_url(); ?>Product/packet">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> เพิ่มแพ็คเกจ
			</a>
		</button>
		
	</div>
	<div style="color:#F00"><?php echo $message?></div>
	<table class="table table-bordered">
		<?php if ($cart = $this->cart->contents()): ?>
		<tr bgcolor="#FFFFFF" style="font-weight:bold">
			<td>Serial</td>
			
			<td>Name</td>
			<td>Price</td>
			<td>Qty</td>
			<td>Amount</td>
			<td>Options</td>
		</tr>
		<?php
		echo form_open('cart/update_cart');
		$grand_total = 0; $i = 1;
		
		foreach ($cart as $item):
			echo form_hidden('cart['. $item['id'] .'][id]', $item['id']);
			echo form_hidden('cart['. $item['id'] .'][rowid]', $item['rowid']);
			echo form_hidden('cart['. $item['id'] .'][name]', $item['name']);
			echo form_hidden('cart['. $item['id'] .'][price]', $item['price']);
			echo form_hidden('cart['. $item['id'] .'][qty]', $item['qty']);
		?>
		<tr bgcolor="#FFFFFF">
			<td>
				<?php echo $i++; ?>
			</td>

			<td>
				<a href="<?php echo base_url(); ?>product/view/<?php echo $item['id']; ?>">
				<?php echo $item['name']; ?>
				</a>
			</td>
			<td>
				$ <?php echo number_format($item['price'],2); ?>
			</td>
			<td>
				<?php echo form_input('cart['. $item['id'] .'][qty]', $item['qty'], 'maxlength="3" size="1" style="text-align: right"'); ?>
			</td>
			<?php $grand_total = $grand_total + $item['subtotal']; ?>
			<td>
				$ <?php echo number_format($item['subtotal'],2) ?>
			</td>
			<td>
				<?php echo anchor('cart/remove/'.$item['rowid'],'ลบ'); ?>
			</td>
			<?php endforeach; ?>
		</tr>
		<tr>
			<td><b>Order Total: $<?php echo number_format($grand_total,2); ?></b></td>
			<td colspan="5" align="right"><input type="button" value="ลบทั้งหมด" onclick="clear_cart()">
					<input type="submit" value="คำนวนใหม่">
					<?php echo form_close(); ?>
					 <button type="button" class="btn btn-default btn-lg">  
			
						<a href="<?php echo base_url(); ?>Billing">
							<span class="glyphicon glyphicon-usd" aria-hidden="true"></span> สั่งจองและชำระเงิน
						</a>

					</button>
		</tr>
		<?php endif; ?>
	</table>
</div>
</div>
</body>
</html>