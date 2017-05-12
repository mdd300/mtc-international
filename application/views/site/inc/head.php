<head>
    <title>MTC Log</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php if (isset($description)): ?>
        <meta name="description" content="<?= $description ?>">
    <?php else: ?>
        <meta name="description" content="Um grupo empresarial com 20 anos de atuação no mercado nacional. Grupo MTC uma organização solida, reconhecida pela qualidade.">
    <?php endif ?>
    <meta name="keywords" content="">
    <base href="<?= base_url() ?>">
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:700,600,400,300,200">
    <link type="text/css" rel="stylesheet" href="assets/libs/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/ionicons/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/medical-icons/style.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="assets/css/core.css">
    <link type="text/css" rel="stylesheet" href="assets/css/layout.css">
    <link type="text/css" rel="stylesheet" href="assets/css/vendor.css">
    <?php if ($active == 'home'): ?>
        <link type="text/css" rel="stylesheet" href="assets/css/pages/index.css">
        <link type="text/css" rel="stylesheet" href="assets/css/pages/services.css">
    <?php endif ?>
    <?php if ($active == 'contato' || $active == 'areas-de-atuacao' || $active == 'solucoes-integradas' || $active == 'cases'): ?>
        <link type="text/css" rel="stylesheet" href="assets/css/pages/contact.css">
    <?php endif ?>
    <?php if ($active == 'noticias' || $active == 'noticia'): ?>
        <link type="text/css" rel="stylesheet" href="assets/css/pages/news.css">
    <?php endif ?>
    <!--if lt IE 9-->
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
</head>