<?php
                if ($this->session->flashdata('success')) :
                    ?>
                <div class="alert alert-success" role="alert">
                    <?php
                        echo $this->session->flashdata('success');
                        ?>
                </div>
                <?php
                elseif(validation_errors()):
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $this->session->flashdata('error');
                    echo validation_errors();
                    ?>
                </div>
                <?php
                elseif($this->session->flashdata('error')):
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php
                    echo $this->session->flashdata('error');
                    ?>
                </div>
                <?php
                endif;
                ?>