<!DOCTYPE html>
<htmlx style="background-color: #6c757d">
	<head>
    <title><?php echo $option->opt_name;?></title>
    <?php
    $this->load->view('public/_include/meta');
    $this->load->view('public/_include/css');
    ?>
	</head>
	<body>
		<div class="body">
			<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
        <?php $this->load->view('public/_include/header');?>
			</header>
			<div role="main" class="main">
        <?php $this->load->view($content);?>
			</div>
			<footer id="footer">
        <?php
        $this->load->view('public/_include/footer');
        $this->load->view('public/_include/copyright');
        ?>
			</footer>
		</div>
    <?php $this->load->view('public/_include/js');?>
	</body>
</html>
