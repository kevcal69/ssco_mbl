<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('partials/head'); ?>
  <script>

    var DCS = { BASE_URL: '<?= base_url(); ?>' };

  </script>
  <title>{page_title}</title>
</head>

<body class = "<?=body_classes($controller, $action);?>">
  <div id="main-wrapper" class="basic">          
    <div id = "main-header">
      <?php $this->load->view('partials/header',
        array('bc' => 'SSCO MBL</a> > <a > '.$controller.'</a> > '.$action)); ?>
    </div>
    <div id="main-content">
      <div id="body-content">{body_content}</div>
    </div>
  </div>

  <?php $this->load->view('partials/footer'); ?>
</body>
</html>