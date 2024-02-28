<div style="display: inline">
    <button class="btn btn-success " onclick="showModal('addNewDiscipline')"><i class="bi bi-plus-circle"></i> DISCIPLINE</button>

    <!-- Modal -->
    <div class="modal" id="addNewDiscipline" style="display: none">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Dodavanje nove discipline</h5>
            </div>
            <div class="modal-body">
                <form  id="addNewDisciplineForm" method="POST" action="{{ route('addNewDiscipline') }}">
                    @csrf
                    @method('POST')
                    <div class="form-group mb-2">
                      <label for="car_plates">Disciplina:</label>
                      <input type="text" class="form-control @error('firstName')is-invalid @enderror" id="firstName" name="name" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal('addNewDiscipline')">ZATVORI</button>
                <button type="button" class="btn btn-primary" onclick="submitForm('addNewDisciplineForm')">SPREMI</button>
            </div>
            </div>
        </div>
    </div>
</div>