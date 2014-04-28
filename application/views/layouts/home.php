<!DOCTYPE html>
<html lang="en">
<head>
  <?php $this->load->view('partials/head'); ?>
  <script>

    var DCS = { BASE_URL: '<?= base_url(); ?>' };

  </script>
  <title>{page_title}</title>
</head>

<body class = "home">
  <div id="main-wrapper" class="default">          
    <?php $this->load->view('partials/header'); ?>
    <div class="wrapper cf">
      <div id="main-content">{body_content}</div>
    </div>
  </div>
  <?php $this->load->view('partials/footer'); ?>
</body>
</html>