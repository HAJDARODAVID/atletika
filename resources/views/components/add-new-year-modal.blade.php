<div style="display: inline">
    <button class="btn btn-success " onclick="showModal('addNewYear')"><i class="bi bi-plus-circle"></i> GODINE</button>

    <!-- Modal -->
    <div class="modal" id="addNewYear" style="display: none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodavanje nove godine</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewYearForm" method="POST" action="{{ route('addNewYear') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Godina:</label>
                      <input type="number" class="form-control @error('firstName')is-invalid @enderror" id="firstName" name="year" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewYear')">ZATVORI</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('addNewYearForm')">SPREMI</button>
            </div>
            </div>
        </div>
    </div>
</div>