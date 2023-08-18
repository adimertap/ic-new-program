<div class="modal fade" id="LihatInvoice" tabindex="-1" aria-labelledby="LihatInvoiceLabel" aria-hidden="true"
  style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title h4" id="LihatInvoiceLabel">DETAIL TRANSAKSI</h5>
        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card invoice">
          <div class="card-body">
            <div class="invoice-header">
              <div class="row">
                <div class="col-9">
                  <h3>INVOICE</h3>
                </div>
                <div class="col-3">
                  <span class="invoice-issue-date">Date: 14 January</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <p class="invoice-description">Invoice ID</p>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item">An item</li>
                  <li class="list-group-item">A second item</li>
                  <li class="list-group-item">A third item</li>
                </ul>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="row invoice-summary">
              <div class="col-lg-3">
                <div class="invoice-info">
                  {{-- <p>Subtotal <span>$1700</span></p>
                  <p>Discount <span>$30</span></p>
                  <p>Tax <span>20%</span></p>
                  <p class="bold">Total <span>$1336</span></p> --}}
                  <div class="invoice-info-actions">
                    <button type="submit" class="submit" id="js-contact-btn">
                      Submit
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>