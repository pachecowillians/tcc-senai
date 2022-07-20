<?php  
  session_start();

  if (isset($_SESSION['msg'])) {
    ?>

    <!-- Modal -->
    <div class="modal fade" id="modalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle"><?= $_SESSION['msg']; ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>
          </div>
        </div>
      </div>
    </div>
    <script type="text/javascript">$('#modalInfo').modal('show');</script>
    <?php
  }

  ?>


  <?php

  unset($_SESSION['msg']); 

  ?> 