<head>
    <?php if (!empty($title)): ?>
        <title><?php echo $title; ?></title>
    <?php else: ?>
        <title>MTC TRAT</title>
    <?php endif; ?>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="yandex-verification" content="d2a44d502509289c" />
    
    <?php if (isset($title_meta) && $title_meta != ''): ?>
        <meta name="title" content="<?php echo $title_meta; ?>">
    <?php else: ?>
        <meta name="title" content="LOGÍSTICA PARA E-COMMERCE - Operações Logísticas Internas e externas.">
    <?php endif ?>

    <?php if (isset($description) && $description != ''): ?>
        <meta name="description" content="<?= $description ?>">
    <?php else: ?>
        <meta name="description" content="MTC LOG - Logística Reversa, implementação de WMS, transporte, serviços técnicos, reengenharia de embalagens de exportação e muito mais.">
    <?php endif ?>
    
    <meta name="keywords" content="operações, logísticas, internas, externas, armazéns, reversa, wms, transporte, serviços, técnicos, reengenharia, embalagens, sub-montagem, consultoria, locação, e-commerce, outbound, armazenagem.">
    
    <base href="<?= base_url() ?>">
    
    <link type="text/css" rel="stylesheet" href="http://fonts.googleapis.com/css?family=Raleway:700,600,400,300,200">
    <link type="text/css" rel="stylesheet" href="assets/libs/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/ionicons/css/ionicons.min.css">
    <link type="text/css" rel="stylesheet" href="assets/vendors/medical-icons/style.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/bootstrap/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/libs/animate.css/animate.css">
    <link type="text/css" rel="stylesheet" href="assets/css/core.css">
    <link type="text/css" rel="stylesheet" href="assets/css/vendor.css">
    <?php if ($active == 'home' || $active == 'operacoes'): ?>
        <link type="text/css" rel="stylesheet" href="assets/css/pages/index.css">
        <link type="text/css" rel="stylesheet" href="assets/css/pages/services.css">
    <?php endif ?>
    <?php if ($active == 'contato' || $active == 'areas-de-atuacao' || $active == 'solucoes-integradas' || $active == 'cases' || $active == 'trabalhe-conosco'): ?>
        <link type="text/css" rel="stylesheet" href="assets/css/pages/contact.css">
    <?php endif ?>
    <?php if ($active == 'noticias' || $active == 'noticia' || $active == 'servico' || $active == 'servicos' || $active == 'landing-pages'|| $active == 'operacoes'): ?>
        <link type="text/css" rel="stylesheet" href="assets/css/pages/news.css">
    <?php endif ?>
    <link type="text/css" rel="stylesheet" href="assets/css/layout.css">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
</head>
