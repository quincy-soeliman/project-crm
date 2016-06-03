<div class="form-group col-xs-12 col-md-12">
    <label for="first_name">Voornaam:</label>
    <input type="text" class="form-control" autocomplete="off" name="first_name" placeholder="voornaam" value="{{ $profile->first_name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="last_name">Achternaam:</label>
    <input type="text" class="form-control" autocomplete="off" name="last_name" placeholder="Achternaam" value="{{ $profile->last_name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="company_id">Bedrijf:</label>
    <select autocomplete="off" name="company_id" id="company" placeholder="Bedrijf"
            class="form-control">
        @foreach ($companies as $company)
            <option value="{{ $company->id }}">{{ $company->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="telephone_number">Telefoon nummer:</label>
    <input type="text" class="form-control" autocomplete="off" name="telephone_number" placeholder="voornaam" value="{{ $profile->telephone_number }}">
</div>
