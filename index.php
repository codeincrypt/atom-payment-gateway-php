<form id="" action="<?= base_url(); ?>home/atom_request" method="POST">
    <div class="modal-body">
        <div class="col-md-12">

            <div class="form-group ">
                <label class="control-label">Amount</label>
                <input type="number" name="amount" id="amountonline3" class="form-control" placeholder="Enter Amount" minlength="2" maxlength='10' autocomplete="off" onkeyup="getAmountOnl3(this.value);">
            </div>

        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" disabled id="submitonline3" class="btn btn-success">Add Fund</button>
    </div>
</form>