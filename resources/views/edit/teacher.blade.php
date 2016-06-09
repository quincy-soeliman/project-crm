<div class="form-group col-xs-12 col-md-12">
    <label for="first_name">Voornaam:</label>
    <input type="text" class="form-control" autocomplete="off" name="first_name" placeholder="Voornaam" value="{{ $profile->first_name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="last_name">Achternaam:</label>
    <input type="text" class="form-control" autocomplete="off" name="last_name" placeholder="Achternaam" value="{{ $profile->last_name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="college_id">School:</label>
    <select autocomplete="off" name="college_id" id="college" placeholder="School"
            class="form-control">
        @foreach ($colleges as $college)
            <option value="{{ $college->id }}">{{ $college->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="telephone_number">Telefoon nummer:</label>
    <input type="number" class="form-control" autocomplete="off" name="telephone_number" placeholder="Telefoon nummer" value="{{ $profile->telephone_number }}">
</div>
