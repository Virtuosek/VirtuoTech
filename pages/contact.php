<?php
?>

<!-- Modal de contact -->
<form action="" method="post" class="inline">
    <div class="modal fade" id="contact">
        <div class="modal-dialog">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="panel-title" id="contactLabel">Une question ? Contactez-nous</h4>
                </div>
                <form action="#" method="post" accept-charset="utf-8">
                <div class="modal-body">
                    <div class="row">
                        <div class="pad-bot col-lg-6 col-md-6 col-sm-6">
                            <input class="form-control" name="firstname" placeholder="Prénom" type="text" required autofocus />
                        </div>
                        <div class="pad-bot col-lg-6 col-md-6 col-sm-6">
                            <input class="form-control" name="lastname" placeholder="Nom" type="text" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="pad-bot col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" name="email" placeholder="E-mail" type="text" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class=" pad-bot col-lg-12 col-md-12 col-sm-12">
                            <input class="form-control" name="subject" placeholder="Sujet" type="text" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <textarea  class="form-control" placeholder="Message..." rows="6" name="comment" required></textarea>
                        </div>
                    </div>
                </div>
                <div class="pad-bot panel-footer">
                    <input type="submit" class="btn btn-primary" value="Envoyer"/>
                    <input type="reset" class="btn btn-default" value="Vider" />
                    <button class="right-float btn btn-default btn-close" data-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
</form>
