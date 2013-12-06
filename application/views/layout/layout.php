<html>
<head>
    <title>
        <?php echo $title; ?>
    </title>
</head>
<body>
<div class="page">
    <div class="top">
        <?php
        $this->load->view("layout/top");
        ?>
    </div>
    <div class="left">
        <?php
        $this->load->view("layout/left");
        ?>
    </div>
    <div class="content">
        <?php
        $this->load->view($template, $data);
        ?>
    </div>
    <div class="footer">
        <?php
        $this->load->view("layout/footer");
        ?>
    </div>
</div>
</body>
</html>