<!DOCTYPE html>
<html lang="en">
<head>
 <script>

    var DCS = { BASE_URL: '<?= base_url(); ?>',BODY_CLSS: '<?=body_classes($controller, $action)?>' };

  </script>
  <?php $this->load->view('partials/head'); ?>
  <title>{page_title}</title>
</head>

<body class = "<?=body_classes($controller, $action);?>">
  <div id="main-wrapper" class="logged_in">          
    <div id = "main-header">
      <?php $this->load->view('partials/header',
        array('bc' => 'SSCO MBL</a> > <a > '.$controller.'</a> > '.$action)); ?>
    </div>
    <div id="main-content">
      <div id="sidebar-content">{sidebar}</div>
      <div id="body-content">{body_content}</div>
    </div>
  </div>

  <?php $this->load->view('partials/footer'); ?>
</body>
</html>