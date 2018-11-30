<!-- FOOTER-->
<div id="footer">
    <div id="section-footer" class="section">
        <div class="container">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-4 prl col-sm-4">
                        <div class="logo"><a href="http://grupomtc.com.br"><img src="assets/images/logo-footer.png" alt="MTC Log" class="img-responsive"/></a></div>
                        <div class="about-us">
                            <h4>MTC International</h4>
                        </div>
                        <div class="contact-info">
                            <ul class="list-unstyled mbn">
                                <li>
                                    <a href="#">
                                        <i class="fa fa-map-marker fa-fw"></i>End.: Rua Serra da Borborema 168, Jardim Maria Tereza
                                        <br>
                                        São Paulo/SP – CEP: 09930-580
                                    </a>
                                </li>
                                <li><a href="#"><i class="fa fa-phone fa-fw"></i>55 11 4810.1174</a></li>
                                <li><a href="mailto:comercial@mtclog.com.br"><i class="fa fa-envelope fa-fw"></i>comercial@mtclog.com.br</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-4 pll prl col-sm-4">
                        <div class="recent-twitter">
                            <div class="heading">MTC Group</div>
                            <div class="content">
                                <nav class="list-recent-twitter">
                                    <ul class="list-unstyled mbn">
                                        <li>
                                            <a href="http://www.mtcsoft.com.br" target="_blank">
                                                <h5>MTC Soft</h5>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="http://www.mtclog.com.br" target="_blank">
                                                <h5>MTC Log</h5>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="http://www.mtctools.com.br" target="_blank">
                                                <h5>MTC Tools</h5>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="http://www.mtctrat.com.br" target="_blank">
                                                <h5>MTC Trat</h5>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 pll col-sm-4">
                        <div class="newsletter">
                            <div class="heading">COMUNICADOS MTC INTERNATIONAL</div>
                            <div class="content"><p class="mbl">Cadastre seu email no campo abaixo e receba novidades e promoções sobre o mundo logístico.</p>
                                <form action="<?php echo site_url('contato/send_newsletter'); ?>" method="POST" id="form-newsletter">
                                    <div class="input-group input-newsletter">
                                        <input type="email" name="email" placeholder="" class="form-control"/>
                                        <span class="input-group-addon btn-subscribe">
                                            <input type="submit" value="Enviar" class="btn submit-contact-form"/>
                                        </span>
                                    </div>
                                    <div id="message_newsletter" class="input-group"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="section-copyright">
        <div class="container"><p class="text-center mbn">Copright - <?= gmdate("Y") ?> - Todos os Direitos Reservados By <a href="http://vioti.com.br" target="_blank">Vioti</a></p></div>
    </div>
</div>
