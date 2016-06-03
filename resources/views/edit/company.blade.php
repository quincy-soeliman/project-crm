<div class="form-group col-xs-12 col-md-12">
    <label for="name">Naam:</label>
    <input type="text" class="form-control" autocomplete="off" name="name" placeholder="Naam" value="{{ $profile->name }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="address">Adres:</label>
    <input type="text" class="form-control" autocomplete="off" name="address" placeholder="Naam" value="{{ $profile->address }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="zip_code">Postcode:</label>
    <input type="text" class="form-control" autocomplete="off" name="zip_code" placeholder="Naam" value="{{ $profile->zip_code }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="iso_number">ISO nummer:</label>
    <input type="text" class="form-control" autocomplete="off" name="iso_number" placeholder="voornaam" value="{{ $profile->iso_number }}">
</div>

<div class="form-group col-xs-12 col-md-12">
    <label for="telephone_number">Telefoon nummer:</label>
    <input type="text" class="form-control" autocomplete="off" name="telephone_number" placeholder="voornaam" value="{{ $profile->telephone_number }}">
</div>