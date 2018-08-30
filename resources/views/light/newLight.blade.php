<!-- The Modal -->
<div class="modal fade" id="light">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Light Info</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
               <form action="newLight" method="post" id="frmLight">
                   <div class="row">



                        <div class="col-lg-4 col-sm-4">
                            <div class="form-group">
                            <input type="text" name="light"  id="light" placeholder="Light Value" class="form-control">
                               <!-- <input type="text" name="light"  id="idlight" placeholder="Light Value" class="form-control">-->
                            </div>


            </div>
                   </div>

            </div>
            <input type="hidden" name="id" id="id" value="">
            <!-- Modal footer -->
            <div class="modal-footer">
                <input type="submit" value="Save" id="save" class="btn btn-primary">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>